@extends('layout.users')

@section('content')
    {{ Form::open(['url' => 'login']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::password('password',['class' => 'form-control','placeholder'=>'password']) }}
    {{ Form::label('label','ログイン用データを記憶する') }}
    {{ Form::checkbox('remember',1,['class'=>'メールアドレスとパスワードを記憶する。'])}}
    {{ Form::submit('送信',['class'=>'btn btn-primary btn-block']) }}
    {{ Form::close() }}
@stop