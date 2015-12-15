<?php

use Illuminate\Support\Facades\Validator;
use Model\validate;

class ArticleController extends BaseController{
    public function __construct(Article $article)
    {
        $this->article = $article;
// beforeフィルタをインストールする
        $this->beforeFilter(
            '@existsFilter',
            ['on' => ['post', 'put']]
        );
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
//            Log::debug('Exists!');
        }
        else {
            Log::debug('url was not contained $id.');
        }
    }

//トップページのためのデータを3種類*100件取る todo
//  view数が多いもの
//  お気に入りが多いもの
//  新しいもの
    public function index()
    {
        return View::make('articles.index',['info'=>$this->article->get_index_data()])->with('message', 'これはメッセージです。');
    }

    public function api_index()
    {
        return Response::json(
            Article::get_index_data()
            );
    }
//    詳細ページを読む todo ムダな変数消す!!
    public function view($id)
    {
        $result = $this->article->fetch_view_data($id);
        Log::debug($result);
        return View::make('articles.view',[
            'result'=>$this->article->fetch_view_data($id)
        ])->with('title','つくたび会員登録');
    }
    public function get_save(){
        $tag_info = DB::table('tags')->select(['id','name'])->get();
        return View::make('articles.save',[
            'tags'=>$tag_info,
        ]);
    }

//    記事の保存用
    public function post_save()
    {
        Log::debug(Input::all());
        $rules = [
            'MainTitle'=>'required|min:3|max:255',
            'SubTitle'=>'required|min:3|max:255',
            'user_id'=>'required',
//            'tags'=>'',
//            'departure_at' =>'required',
//            'return_at' =>'required',
            'photos'=>'required',
//            'photo_comments'=>'',
        ];
        $input = Input::only(array_keys($rules));
        $validator = Validator::make($input,$rules);
        if($validator->fails()){
//             return Redirect::to('save')->withErrors($validator)->withInput();
            return Response::json(400,'error');
        }
            return Response::json($this->article->save_article($input));
    }
    public function get_edit(){

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
//        TODO::本人確認
        $inputs = Input::only(array_keys($validation));
        $validator = Validator::make($inputs,$validation);
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
    public function spam($id = null)
    {
//        $this->article->post_spam($id);
        return Response::json(['message'=>'成功',200]);
    }

    public function tags_json(){
        return Response::json(Tag::all()->toJson());
    }

    public function api_view($id = null)
    {
        $result = Article::fetch_view_data($id);
        Log::info($result);
        return Response::json('articles.view',[
            'articles'=>$result['articles'],
            'photos'=>$result['photos'],
            'comment_data'=>$result['comment_data'],
            'fav_data'=>$result['fav_data']
        ]);
    }

    public function count_view($id){
       return Response::json($this->article->count_views($id));
    }
}