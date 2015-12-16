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
    public function input_fav($input){
        $fav = new Fav();
        $fav->article_id = $input['article_id'];
        $fav->user_id = $input['user_id'];
//        すでにお気に入り登録しているのか確認
        $exist = DB::table('favs')->select('id')->where('user_id','=',$input['user_id'])->where('article_id','=',$input['article_id'],'and')->get();
        if(!empty($exist['0']->id)){
//          すでにあれば 削除する。
            try{
                Fav::destroy($exist['0']->id);
                Log::info($fav);
            }catch (Exception $e){
                Log::info($e);
                return false;
            }
            return true;
        }
            try{
                $fav->save();
            }catch ( Exception $e){
                Log::info($e);
            return false;
            }
        return true;
    }

}