@extends('layout.users')
@section('content')
    <link rel="stylesheet" href="{{ asset('/html5up-eventually/assets/css/main.css') }}">
    <h2>つくたび 会員登録(無料)</h2>
    {{ Form::open(['url' => 'register']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::text('username','', ['class' => 'form-control','placeholder'=>'ユーザー名']) }}
    {{ Form::password('password',['class' => 'form-control','placeholder'=>'password']) }}
    {{ Form::submit('送信',['class'=> 'btn-primary btn-block']) }}
    {{ Form::close() }}

    <style>
        form input{
            margin-top: 15px;
        }
        footer p{
            text-align: center;
            margin: auto;
        }
        footer {
            margin-bottom: 20px;
            position: absolute;
            margin: auto;
            bottom:0;
            width: 100%;

        }
        html,body{
            height:100%;
        }
    </style>
    <script src="{{ asset('html5up-eventually/assets/js/main.js') }}" defer="defer"></script>
@stop
