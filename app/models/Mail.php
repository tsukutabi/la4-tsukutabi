<?php

//メールガン 送信用のクラス


class Mail {

    public $username = "tsukutabiinc";

    public $password = "HelloNewW0rld";

//   共通部分
    public  function send_mail_basic(){



    }


    public  function send_faved($faved_username , $to_mail_adress ,$title){
        $subject = "あなたの投稿した記事".$title."がお気に入りされました。";



        $message['status_code'] = $this->send_mail_basic($subject);
        return $message;
    }

    public  function commented(){

    }



}


