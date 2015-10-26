<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeles;


class Fav extends Model{

    protected $table = 'favs';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = ['user_id','article_id','departure_at','return_at'];
    public function articles() {
        return $this->belongsto(Article::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public static function input_fav($input){
        Log::info($input);
        $fav = new Fav();
        $fav->user_id = $input['user_id'];
        $fav->article_id = $input['article_id'];

//        すでにあるか確認
        $exist= Fav::find($input['user_id'])->count();
        Log::info($exist);
        if($exist == 1 ){
//          すでにあれば 削除する。
            try{
//                削除実行 + ハードデリート
            }catch (Exception $e){
//                dbエラー検出
                Log::info($e);
                return false;
            }
            return true;
        }
        Log::info($fav);
        try{
            $fav->save();
        }catch ( Exception $e){
            Log::info($e);
            return false;
        }
        return true;
    }
}