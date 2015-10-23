<?php

use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController {

     public function __construct(){
//         postされた値と本人が一致しているか確認する。
     }

     public function post(){
         $input = Input::only(['comments','user_id','article_id']);
         var_dump($input);
         Log::info($input);
         $rules = [
             'comments'=>'required',
             'user_id'=>'required',
             'article_id'=>'required',
         ];
         $validator = Validator::make($input,$rules);

         if($validator->fails()){
             return Redirect::route('error')->withErrors($validator)->withInput();
//             return Redirect::route('todos.index')->withErrors($validator)->withInput();
         }
//       保存するよ!!
         $comment_bool = Comment::input_comment($input);
         if($comment_bool){
             return Response::json(['messages'=>'ok',200]);
         }


     }

     public function delete(){

     }

     public function edit(){
         $input = Input::only(['comments','user_id','article_id']);
         var_dump($input);
         Log::info($input);
         $rules = [
             'comments'=>'required',
             'user_id'=>'required',
             'article_id'=>'required',
         ];
         $validator = Validator::make($input,$rules);

         if($validator->fails()){
             return Redirect::route('error')->withErrors($validator)->withInput();
//             return Redirect::route('todos.index')->withErrors($validator)->withInput();
         }
//       保存するよ!!
         $comment_bool = Comment::input_comment($input);
         if($comment_bool){
             return Response::json(['messages'=>'ok',200]);
         }

     }

     public function spam(){

     }


}