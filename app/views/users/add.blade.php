@extends('layout.users')

@section('content')
    {{ Form::open(['url' => 'user/add']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::text('username','', ['class' => 'form-control','placeholder'=>'ユーザー名']) }}
    {{ Form::password('password',['class' => 'form-control','placeholder'=>'password']) }}
    <input type="password" placeholder="password確認用" class="form-control">

    {{ Form::submit('送信') }}
    {{ Form::close() }}
@stop