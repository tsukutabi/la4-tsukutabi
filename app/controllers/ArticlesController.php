<?php

class ArticlesController extends BaseController{
//ユーザーにログインさせる。
    public function __construct()
    {
//   ログインさせる。
        if (Auth::check())
        {
            echo "ログインしています。";
        }else{
            echo "ログインしていません";
            Log::info('ログインしていません。');
        }
// beforeフィルタをインストールする
//        $this->beforeFilter(
//            '@existsFilter',
//            ['on' => ['post', 'put']]
//        );
    }
//    リレーションシップ
    public function article(){
//        belongsto Auth
//        hasmany_belongsto tags
//        hasmany comments
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
        $data = Article::get_index_data();
//        Log::$data;
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
        $articles = Article::find($id);
        $user_data = User::find($articles->user_id);
//        try{
            $comment_data = Comment::where(['article_id'=>$id])->get()->toArray();
//            $fav_data = Fav::count()->where('article_id',=,$id);
            Log::info($comment_data);
//            Log::info($fav_data);

//        }catch ( Exception $e){
//            Log::info($e);
//        }


        $fav_data = Fav::find($id);
        Log::info($fav_data);
//        $fav_num = array_count_values($fav_data);
//        Log::info($fav_num);
        var_dump($user_data->username);
        $photos = explode('+', $articles['photos']);
        return View::make('articles.view' ,[
            'articles'=>$articles,
            'photos'=>$photos,
            'comment_data'=>$comment_data
//            'fav_num'=>$fav_num,
//             'photo_comments'=>$photo_comments,
//             'articles_data' =>$articles_data,
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
//      tokenはいるか確認
        '_token' => 'required',
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

    public function delete($id)
    {
//        論理削除する


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
