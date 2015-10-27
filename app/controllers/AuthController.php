<?php

use Carbon\Carbon;
use app\models\User;

class AuthController extends BaseController
{
    public function __construct(){
//        ログインしていたら、ユーザーにメッセージをだして、ユーザーページにredirectさせる。
    }

    // 今回のコードでは、フォームの出力は
    // show....Formというアクション名を付けています。
    public function showRegisterForm()
    {
        return View::make( 'auth.register' );
    }

    // フォームの処理はhandle...という名前を付けています。
    public function handleRegister()
    {
        $rules = [
            'username' => [ 'required' ], //　日本語の場合、漢字一文字があるため
            'email'    => [ 'required', 'email', 'unique:users' ],
            'password' => [ 'required', 'min:6' ],  // 長さはリマインダーと合わせてある
        ];

        $inputs = Input::only( ['username', 'email', 'password' ] );

        $val = Validator::make( $inputs, $rules );
        if( $val->fails() )
        {

            return Redirect::route( 'register-form' )
                ->withErrors( $val )
                ->withInput();
        }

        // トランザクションの開始、usersテーブルと、紐ついたconfirmsテーブルを
        // 同時に更新するため。
        // また、エラー発生時に500にするため、DB::transaction()を使用していない。
        DB::beginTransaction();

        try
        {
            $user = User::create( $inputs );

            // Str::random()の実装は調べていない。
            // 乱数生成のアルゴリズムに問題がないか、要チェック
            // 実用にするなら、16ではなく、もっと増やしたほうが良い
            $confirmKey = Str::random( 16 );

            $user->confirm()->create( ['key' => $confirmKey ] );
            Log::info($user);

        }
        catch( Exception $e )
        {
            DB::rollBack();

            return App::abort( '500', 'データベースが不調です。確認キーの生成に失敗しました。' );
        }
        DB::commit();

        // メールは基本queue()で送信する。デフォルトのsyncドライバーだと、
        // send()コマンドとほぼ同じ。（結果が取れないのが弱点か。）
        // 本格的にキューが使用したくなったら、設定ファイルを変更して
        // 対応できる。
        Mail::queue( 'emails.auth.confirm',
            [ 'username' => $inputs['username'], 'key' => $confirmKey ],
            function($message) use($inputs)
            {
                $message->subject( 'つくたび登録確認' );
                $message->to( $inputs['email'] );
            } );

        // 'home'と名前を付けたルートへリダイレクトする
        // 今回は'/'へリダイレクト。
        return Redirect::home()
            ->withMessage( '登録確認メールを送信しました。２４時間以内に、中の確認リンクをクリックしてください。' );
    }

    public function showConfirmForm()
    {
        return View::make( 'auth.confirm' );
    }

    public function handleConfirm()
    {
        // メールアドレスは、usersテーブルに登録されていることをバリデートする。
        $rules = [
            'email' => [ 'required', 'email', 'exists:users' ],
            'key'   => [ 'required', 'size:16' ],
        ];

        $inputs = Input::only( ['email', 'key' ] );
        Log::info($inputs);
//        $val = Validator::make( $inputs, $rules );
//        Log::info($val);
//
//
//        if( $val->fail() )
//        {
//            return Redirect::route( 'confirm-form' )
//                ->withInput()
//                ->withErrors( $val );
//        }

        // バリデーションで、メールアドレスは存在していることを確認済み
        // そのため、必ずヒットするので、クエリー後のチェックは省略している。
        // ただ、バッチ処理の削除とバッティングする可能性があるので、
        // より良い方法としては、共有でレコードロックをかけ、
        // バッチ処理は専有でテーブルロックをかける方が良いだろう。
        $user = User::whereEmail( $inputs['email'] )->first();

        // 確認済みのチェック
        if( $user->active == 1 )
        {
            return Redirect::home()
                ->withMessage( '既に有効になっています。ログインしてご利用ください。' );
        }

        // 認証キーの有効期限チェック。本来はconfirmsテーブルのレコードで調べるが、
        // ユーザーと同時に作成されるので、ユーザー作成日付を代用している。
        // （アクセスが増えるので、遅らせたい。）
        // Carbonを利用し、２４時間後のインスタンスを生成している。
        // withはLaravelのヘルパー、生成したインスタンスにメソッドチェーンを
        // 繋げたい場合に利用する。
        // テーブルのタイムスタンプの値は、直接Carbonに渡して、その日時の
        // インスタンスが生成できます。
        $expired_at = with( new Carbon( $user->created_at ) )->addHours( 24 );

        //  $expired_at < Carbon::now() をチェック
        if( $expired_at->lt( Carbon::now() ) )
        {
            // 本当は失敗時は500にしたほうが良い :D
            // 今回は手抜きでtransaction()を使用。
            DB::transaction( function() use($user)
            {
                // 外部キーで指定しているため、
                // 対応するconfirmsのレコードも同時削除
                $user->forceDelete();
            } );

            return Redirect::route( 'register-form' )
                ->withWarning( '仮登録から２４時間過ぎています。恐れ入りますが、再度ユーザー登録し直してください。' );
        }

        // 関連付けから、対応するconfirmsレコードを取得
        // 事前にEagerロードする手もあるが、ユーザーが有効でない場合、
        // そのクエリーが一回分無駄になるため、ここまで遅らせた。
        $confirm = $user->confirm()->first();

        if( $confirm->key != $inputs['key'] )
        {
            return Redirect::route( 'confirm-form' )
                ->withInput()
                ->withWarning( '入力されたキーが一致しません。' );
        }

        // ユーザーを有効(active=1)にし、同時に
        // 対応するconfirmsレコードを削除
        DB::beginTransaction();

        try
        {
            $user->active = 1;
            $user->save();

            $confirm->delete();
        }
        catch( Exception $e )
        {
            DB::rollBack();

            return App::abort( '500', 'データベースが不調です。本登録に失敗しました。' );
        }

        DB::commit();

        return Redirect::home()
            ->withMessage( '登録を確認しました。ログインいただけます。' );
    }

    public function showLoginForm()
    {
        return View::make('auth.login');
    }

    public function handleLogin()
    {
        // 登録時にパスワード長はエラーメッセージで表示されるが、
        // ヒントになるため、ここでは積極的に出さない。

        $rules = [
            'email'    => [ 'required', 'email' ],
            'password' => [ 'required' ],
        ];


        $inputs = Input::only( ['email', 'password' ] );

        $val = Validator::make( $inputs, $rules );

        if( $val->fails() )
        {
            return Redirect::route( 'login-form' )
                ->withInput()
                ->withErrors( $val );
        }

        // 未有効（active=0）と、アカウント停止(suspended=1)を
        // この認証の時点で弾くこともできるが、エラーメッセージを分けて表示するため、
        // メールアドレスとパスワードだけで認証する。
        // ログインページのremembeチェックボックスにチェックが付けられたら(1)、
        // Remember Me（オートログイン）を有効にする
        $input_all = Input::all();
        Log::info($input_all);
        if( !Auth::attempt( $inputs, (Input::get( 'remember', '0' ) == '1' ) ) )
        {
            return Redirect::route( 'login-form' )
                ->withInput()
                ->withWarning( 'メールアドレス／パスワードが一致しません。' );
        }

        // ユーザー登録の確認が済んでいるかチェック
        if( Auth::user()->active == 0 )
        {
            Auth::logout();

            return Redirect::home()
                ->withWarning( 'ユーザー登録が終了していません。登録確認メール中のリンクをクリックし、確認作業を初めてください。' );
        }

        // ユーザーの利用資格が停止されていないかチェック
        if( Auth::user()->suspended == 1 )
        {
            Auth::logout();

            return Redirect::home()
                ->withDanger( 'このユーザーの利用資格は停止されています。' );
        }

        // 認証成功！
        // ログインページを表示されたきっかけが、'auth'フィルターに
        // 引っかかった場合のときは、そのURIにログイン後にアクセス可能であれば、
        // もとのアクセスURIへリダイレクトされる。それ以外の場合、
        // 通常ユーザー(roll=0)はルート(/)、管理者(roll=100)は
        // 管理者パネルへリダイレクトする。
        return Redirect::intended( Auth::user()->role == 100 ? route( 'admin-panel' ) : '/'  )
            ->withMessage( 'ログインしました。' );
    }

    public function handleLogout()
    {
        Auth::logout();

        return Redirect::home()
            ->withMessage( 'ログアウトしました。' );
    }

 //   public function make_profile($id){
//        本人確認
//        $inputs = input::only(['user_id','face_photo','about_me']);
//        Log::info($inputs);
//        $honninn = true;
//        if($honninn){
//            $profile
//                try{
//                    DB実行!!
//                }catch ($e){
//                    return view::json(['message'=>'データベースエラー'],500);
//                }
//            return View::json(200);
//        }else{
//            return '本人ではありませんね 401';
//        }

//    }

//    public function view_user_data($id){
//        共通処理

//        $profile = User::find($id);
//        本人かどうかの確認
//        $bool_who = $this->bool_you($id,$user_id);
//        return View::make('auth.view',[
//            'profile' => $profile,
//        ]);
//    }

    private function bool_you($user_id,$id){
        if($user_id === $id){
            return true;
        }else{
            return false;
        }
    }


}