@extends('layout.default')
@section('content')
    <h2>お問い合わせページ</h2>
    {{Form::open(['url'=>'contact'])}}
    {{Form::text('contact')}}
    {{Form::submit('送信',['class'=>'btn'])}}
    {{Form::close()}}
@stop