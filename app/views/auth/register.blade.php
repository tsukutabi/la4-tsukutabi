@extends('layout.users')
@section('content')
    <div id="content">
    <h2>つくたび 会員登録(無料)</h2>
    {{ Form::open(['url' => 'register']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::text('username','', ['class' => 'form-control','placeholder'=>'ユーザー名']) }}
    {{ Form::password('password',['class' => 'form-control','placeholder'=>'password']) }}
    {{ Form::submit('送信',['class'=> 'btn-primary btn-block']) }}
    {{ Form::close() }}

    <a href="login">ログインはこちらから</a>
        <link rel="stylesheet" href="{{ asset('/html5up-eventually/assets/css/main.css') }}">
        <script src="{{ asset('html5up-eventually/assets/js/main.js') }}" defer="defer"></script>
    </div>
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

    <script>
        $(function(){
            $.pjax({
                area : '#content',
                link : 'a:not([target])',
                ajax: { timeout: 2500},
                wait: 500
            });
            $(document).bind('pjax:fetch', function(){
                $('body').css('overflow', 'hidden');
                $('#content').attr({'class': 'fadeOut'});
            });
            $(document).bind('pjax:render', function(){
                $('#content').attr({'class': 'fadeIn'});
                $('body').css('overflow', '');
            });
        });
    </script>

@stop
