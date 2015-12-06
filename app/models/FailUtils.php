<?php


//画像ファイスをアップロードする時のクラス
// 必要機能 s3へのアップロード 画像ファイルの確認 ファイルサイズの確認 
class FileUtils extends Aws{
    public function  __constructer(Aws $aws){
        $this->aws = $aws;
    }



}