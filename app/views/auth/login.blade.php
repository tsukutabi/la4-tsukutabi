@extends('layout.users')

@section('content')
    <link rel="stylesheet" href="{{ asset('/html5up-eventually/assets/css/main.css') }}">
    {{ Form::open(['url' => 'login']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::password('password',['class' => 'form-control','placeholder'=>'password']) }}
    {{ Form::label('label','ログイン用データを記憶する') }}
    {{ Form::checkbox('remember',1,['class'=>'メールアドレスとパスワードを記憶する。'])}}
    {{ Form::submit('送信',['class'=>'btn btn-primary btn-block']) }}
    {{ Form::close() }}

    <script src="{{ asset('html5up-eventually/assets/js/main.js') }}" defer="defer"></script>
    <style>
        form input {
            margin-top: 15px;
        }
    </style>
@stop