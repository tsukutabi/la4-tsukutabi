<?php


class FavController extends BaseController{

    public function __construct(Fav $fav){

        $this->fav = $fav;
//        ログインの確認

        if(Auth::check()){

        }else{
            return Response::json(['message'=>'ユーザー登録を行って下さい',500]);
        }
    }
    public function post()
    {
        $rules =[
            'user_id'=>'required',
            'article_id'=>'required'
        ];
        $input = Input::only(array_keys($rules));
        $validator = Validator::make($input,$rules);
        if($validator->fails()){
            return Response::json(['message'=>'validation'],500);
        }

        $success = Fav::input_fav($input);
        if ( $success ) {
            return Response::json(200);
        } else {
            return Response::json(['message' => 'exist'] , 500);
        }
    }

}

