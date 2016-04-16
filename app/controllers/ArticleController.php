<?php

use Illuminate\Support\Facades\Validator;
use Model\validate;

class ArticleController extends BaseController{
    public function __construct(Article $article,Fav $fav)
    {
        $this->article = $article;
        $this->fav = $fav;
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
        return Response::json($this->article->get_index_data());
    }

    public function view($id)
    {
        $result = $this->article->fetch_view_data($id);
        $has_fav = $this->fav->bool_user_fav($result['fav_data']);
        Log::debug($has_fav);
        return View::make('articles.view',[
            'result'=>$result,
            'has_fav'=>$has_fav
        ])->with('title',$result['articles']->title);
    }

    public function api_view($id){
        $result = $this->article->fetch_view_data($id);
//        $has_fav = $this->fav->bool_user_fav($result['fav_data']);
        return Response::json(
            $result
        );

    }

    public function get_save(){
        return View::make('articles.save')->with('title','投稿ページ');
    }

//    記事の保存用
    public function post_save()
    {
        Log::debug(Input::all());
        $rules = [
            'MainTitle'=>'required|min:3|max:255',
            'SubTitle'=>'required|max:255',
            'budgets'=>'required',
            'departure_at' =>'required',
            'night'=>'required',
            'days'=>'required',
            'photos'=>'required',
        ];
        $input = Input::only(array_keys($rules));
        $validator = Validator::make($input,$rules);
        if($validator->fails()){
//             return Redirect::to('save')->withErrors($validator)->withInput();
            Log::debug('バリデーション失敗');
            $messages = $validator->messages();
            Log::info($messages);
            return Response::json(400,'error');
        }
            $info_input = $this->article->save_article($input);
            return View::make('article.edit',['result'=>$info_input]);
    }
    public function get_edit($id){

//        本人確認
        return View::make('article.edit');
    }

    public function post_edit($id)
    {  
			if($this->article->edit_first($id)){
				Session::put('message','投稿が完了しました');
			}
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
//        $validator = Validator::make($inputs,$validation);
//        if($validator->fails()){
//            return Response::json(['message'=>'バリデーションエラーです。'],500);
//        }
//        論理削除する
        Article::delete_article();
        return View::make('users.view');
    }
//todo validation
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


    public function count_view($id){
       return Response::json($this->article->count_views($id));
    }
}
