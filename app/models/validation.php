<?php

namespace Model\Validate;

trait validation{

//本人確認関数
    public function confirm_user($user_id){
        if(Auth::user()->id === $user_id){
            return true;
        }else{
            return false;
        }
    }

    public $userValidateRules = [
        'username' => 'required|uniqueUser',
        'password' => 'required',
        'email' => 'required|email'
    ];
    //
    public $userValidateMessages = [
        'username.required' => 'アカウント名を入力してください',
        'username.unique_user' => '入力したアカウント名は使用できません',
        'password.required' => 'パスワードを入力してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレス正しく入力してください'
    ];

    public $articleValidateRules =[
        'MainTitle'=>'required|min:3|max:255',
        'SubTitle'=>'required|min:3|max:255',
        'user_id'=>'required',
//            'tags'=>'',
//            'departure_at' =>'required',
//            'return_at' =>'required',
        'photos'=>'required',
//            'photo_comments'=>'',
    ];

    public $requiredMessage = "入力して下さい";
    private $min_message ="3文字以上の入力をお願いします";

    public $articleValidationMessage = [
        'MainTitle.required'=>'タイトルを入力して下さい',
        'SubTitle.min:3'=>"",

    ];
}