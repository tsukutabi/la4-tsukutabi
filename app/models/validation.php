<?php

namespace Model\Validate;


trait validation{


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


}
