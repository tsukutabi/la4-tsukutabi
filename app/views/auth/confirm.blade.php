@extends('layout.users')

@section('content')
    {{ Form::open(['url' => 'confirm']) }}
    {{ Form::email('email','', ['class' => 'form-control','placeholder'=>'email']) }}
    {{ Form::hidden('key',$_GET['key']) }}
    <div class="btn-group">
        {{ Form::submit('送信',['class'=>'btn btn-primary btn-lg btn-block']) }}
    </div>
    {{ Form::close() }}
@stop