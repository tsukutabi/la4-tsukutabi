<?php

use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController {

     public function __construct(Comment $comment){

         $this->comment = $comment;

     }

     public function post(){
         $rules = [
             'comment'=>'required',
             'user_id'=>'required',
             'article_id'=>'required',
         ];
         $input = Input::only(array_keys($rules));
         $validator = Validator::make($input,$rules);
         if($validator->fails()){
             Log::info('validation error');
             return Redirect::route('error')->withErrors($validator)->withInput();
//             return Redirect::route('todos.index')->withErrors($validator)->withInput();
         }
//       保存するよ!!
         $comment_bool = Comment::input_comment($input);
         if($comment_bool){
             return Response::json(['messages'=>'ok',200]);
         }
     }

     public function delete($id){
         $rules = [
             'user_id'=>'required',
         ];
         $input = Input::only(array_keys($rules));
         $validator = Validator::make($input,$rules);
         if($validator->fails()){
             return Redirect::route('error')->withErrors($validator)->withInput();
//             return Redirect::route('todos.index')->withErrors($validator)->withInput();
         }
//         削除する。
         try {
             Log::info('b');
             Comment::destroy($id);
             Log::info('c');

         }catch (Exception $e){
             Log::info($e);
         }

         return Response::json('200');
     }

     public function edit($id){
         $rules = [
             'comments'=>'required',
             'user_id'=>'required',
             'comment_id'=>'required',
         ];
         $input = Input::only(array_keys($rules));
         Log::info($input);
         $validator = Validator::make($input,$rules);

         if($validator->fails()){
             return Redirect::route('error')->withErrors($validator)->withInput();
//             return Redirect::route('todos.index')->withErrors($validator)->withInput();
         }
        //編集する
         $comment_bool = Comment::input_comment($input);
         if($comment_bool){
             return Response::json(['messages'=>'ok',200]);
         }

     }

     public function spam(){

     }


}