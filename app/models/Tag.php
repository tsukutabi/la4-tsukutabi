<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeles;

class Tag extends Model{

    protected $guarded = ['id'];
    protected $hidden = ['id','created_at','updated_at','modified_at','deleted_at'];
    protected $fillable = ['name'];
    public $timestamps = true;

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function get_tags(){
        try{
            $tag = DB::table('tags')->select(['id','name'])->get();
        }catch(Exception $e){
            Log::info($e);
            return Response::json(['message'=>'データベースエラー'],'500');
        }

        return $tag;

    }



}