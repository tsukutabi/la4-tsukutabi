<?php

class ArticlesController extends BaseController{
//ユーザーにログインさせる。
    public function __construct()
    {
//   ログインさせる。
        if (Auth::check())
        {
            $user_login = true;
            echo "ログインしています。";
        }else{
            $user_login = false;
            echo "ログインしていません";
            Log::info('ログインしていません。');
        }
// beforeフィルタをインストールする
//        $this->beforeFilter(
//            '@existsFilter',
//            ['on' => ['post', 'put']]
//        );
    }
    public function existsFilter()
    {
        Log::info(__METHOD__.' called.');
        // URLにパラメータ'id'が存在したら
        $id = Route::input('id');
        if ($id) {
            Log::debug("todo id(${id}) checking...");

            // 指定のIDがtodosテーブルに存在しなかったら
            if (! Todo::exists($id)) {
                Log::debug('Nothing!');

                // Webブラウザに404 Not Foundを返す
                App::abort(404);
            }
            Log::debug('Exists!');
        }
        else {
            Log::debug('url was not contained $id.');
        }
    }

//トップページのためのデータを3種類*100件取る
//  view数が多いもの
//  お気に入りが多いもの
//  新しいもの
    public function index()
    {
        try{
            $data = Article::get_index_data();
        }catch (Exception $e){
            Log::info($e);
            $data = null;
        }
        return View::make('articles.index',[
            'info'=>$data
//        'new'=>$data['new'],
//        'view' =>$data['view'],
//        'fav'=>$data['fav']
        ]);
    }

//    詳細ページを読む
    public function view($id)
    {
        try{
            $articles = DB::table('articles')->select('users.username','title','subtitle','photos','photo_comments')->leftJoin('users','users.id', '=', 'articles.user_id')->get();
            $comment_data = DB::table('comments')->leftJoin('users','users.id', '=', 'comments.user_id')->get();
            $fav_data = DB::table('favs')->where('article_id','=',$id)->count();
        }catch (Exception $e){
            Log::info($e);
            return Route::view('error');
        }
        Log::info($articles);
        $photos = explode('+',$articles['0']->photos);
        return View::make('articles.view' ,[
            'articles'=>$articles,
            'photos'=>$photos,
            'comment_data'=>$comment_data,
            'fav_data'=>$fav_data
        ]);
    }
    public function get_save(){
        $tag_info = DB::table('tags')->select(['id','name'])->get();
        $user = Auth::user();
        return View::make('articles.save',[
            'tags'=>$tag_info,
            'user_id'=>$user->id,
        ]);
    }

//    記事の保存用
    public function post_save(){
        $rules = [
        'title'=>'requiresd|min:3|max:255',
        'subtitle'=>'required|min:3|max:255',
        'departure_at' =>'',
        'return_at' =>'',
        'photos'=>'required',
//        'photo_comments'=>'',
        ];
        $input = Input::only(array_keys($rules));
        $validator = Validator::make($input,$rules);
        if($validator->fails){
          return View::make(articles.save)->withErrors($validator)->withInput();
        }
        if(Article::save_article($input)){
            return Response::json(200);
        }
    }

    public function edit($id)
    {
        Article::edit_article($id);
        return Response::json(['result' => '更新完了しました'], 200);
    }

    public function delete()
    {
        $validation =[
            'user_id'=> 'require',
            'article_id'=>'require',
        ];
//        本人確認
        $inputs = Input::only(array_keys($validation));
        log::info($inputs);
        $validator = Validator::make($inputs,$validation);
        Log::info($validator);
        if($validator->fails()){
            return Response::json(['message'=>'バリデーションエラーです。'],500);
        }
//        論理削除する
        Article::delete_article();
        return View::make('users.view');

    }

    public function find()
    {
        $search_word = $_GET['word'];
        $search_articles = Article::where('title','like','%'.$search_word.'%')->get();
        return View::make('articles.index',[
            'info'=>$search_articles
        ]);
    }
//    迷惑・スパム報告
    public function spam($id)
    {

    }
}
