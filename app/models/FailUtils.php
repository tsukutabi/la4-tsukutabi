<?php

use Illuminate\Database\Eloquent\Model;

//画像ファイスをアップロードする時のクラス
// 必要機能 s3へのアップロード 画像ファイルの確認 ファイルサイズの確認 
class FileUtils extends Model {
    public function  __constructer(Aws $aws){
        $this->aws = $aws;
    }

//    アップロードされるexifファイルの削除
    public function delete_exif($imgae){

    }

//    アップロードされるexifの読み込み

//    画像の削除
    public function delete_file($delete_img){
        try{
            File::delete($delete_img);
        }catch (Exception $e){
            Log::info($e);
            return false;
        }
        return true;
    }

    public function make_dri($user_id){
        $set_path = public_path('images/'.$user_id);
        if(!File::exists($set_path))
        {
            File::makeDirectory($set_path);
        }
    }




}