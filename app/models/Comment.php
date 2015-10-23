<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeles;


 class Comment extends Model{

     protected $table = 'comments';
     protected $guarded = ['id'];
     public $timestamps = true;

     protected $fillable = ['user_id','comments','article_id','departure_at','return_at'];
     public function articles() {
         return $this->belongsto('articles');
     }

     public function users(){
         return $this->belongsTo('users');
     }

     public static function input_comment($input){

         Log::info($input);
         $comment = new Comment();
         $comment->user_id = $input['user_id'];
         $comment->comment = $input['comments'];
         $comment->article_id = $input['article_id'];
         Log::info($comment);
         try{
         $comment->save();
         }catch ( Exception $e){
             Log::info($e);
             return false;
         }
         return true;
     }
 }