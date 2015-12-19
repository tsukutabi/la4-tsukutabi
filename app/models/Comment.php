<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Comment extends Model{
    use SoftDeletingTrait;

     protected $table = 'comments';
     protected $guarded = ['id'];
     protected $fillable = ['user_id','comments','article_id'];
     public $timestamps = true;
     public function articles() {
         return $this->belongsTo(Article::class);
     }

     public function users(){
         return $this->belongsTo(User::class);
     }

     public static function input_comment($input){

         Log::info($input);
         $comment = new Comment();
         $comment->user_id = $input['user_id'];
         $comment->comment = $input['comment'];
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