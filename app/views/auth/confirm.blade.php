@extends('layout.users')

@section('content')
    <link rel="stylesheet" href="{{ asset('/html5up-eventually/assets/css/main.css') }}">
    <h2>ユーザー認証</h2>
    {{ Form::open(['url' => 'confirm']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::hidden('key',$_GET['key']) }}
    <div class="btn-group">
        {{ Form::submit('送信',['class'=>'btn btn-primary btn-lg btn-block']) }}
    </div>
    {{ Form::close() }}

    <script src="{{ asset('html5up-eventually/assets/js/main.js') }}" defer="defer"></script>
@stop