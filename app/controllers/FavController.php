<?php


class Favcontroller extends BaseController{

    public function __construct(){
//        ログインの確認

        if(Auth::check()){

        }else{
            return Response::json(['message'=>'ユーザー登録を行って下さい',500]);
        }
    }
    public function post()
    {
        $input = Input::only(['user_id','article_id']);
        $success = Fav::input_fav($input);
        if ( $success ) {
            return Response::json(200);
        } else {
            return Response::json(['message' => 'すでに登録してあります'] , 500);
        }
    }

}

