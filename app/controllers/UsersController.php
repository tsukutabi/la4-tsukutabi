<?php


class UsersController extends BaseController{

    public function __construct()
    {

//        強制的にログインさせる。
//        ログインしていたら
//            if($rogind == true){
//                return View::make('user');
//    }

    }

    public function add(){
        $input = Input::all();
        Log::info($input);

//        if(Mail::send('emails.welcome',['user'=>$input] , function($message)
//        {
//            $message->to($user['email'],'tanihata')->subject('Welcome!');
//        })) {
//        Log::info('成功');
//        }else{
//            Log::info('メールエラー');
//        }
            try
            {
                $hashed_password = Hash::make($input['password']);
                // ユーザーの作成
                $user = Sentry::getUserProvider()->create(array(
                    'email' => 'nakada@gmail.com',
                    'password' => $hashed_password,
                    'username'=>$input['username'],
                    'activated' => 1,
                ));
//グループIDを使用してグループを検索
                $adminGroup = Sentry::getGroupProvider()->findById(1);
// ユーザーにグループを割り当てる
                $user->addGroup($adminGroup);
            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                echo 'ログインフィールドは必須です。';
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                echo 'パスワードフィールドは必須です。';
            }
            catch (Cartalyst\Sentry\Users\UserExistsException $e)
            {
                echo 'このログインユーザーは存在します。';
            }
//            catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
//            {
//                echo 'グループは見つかりません。';
//            }

    }
    public function login(){
        $input = Input::all();
        Log::info($input);


    }
    public function find($id){

    }

    public function view($id){


    }

    public function admin_view($id){

    }
    public function logout(){

    }

}
