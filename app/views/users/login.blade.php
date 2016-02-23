@extends('layout.users')
@section('content')
    {{ Form::open(['url' => 'users/login']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::password('password',['class' => 'form-control','palaceholder'=>'password']) }}
    {{ Form::close() }}
@stop