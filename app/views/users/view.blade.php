@extends('layout.users')

@section('content')
<p>投稿記事</p>
    {{var_dump($articles)}}
<p>お気に入り記事</p>
    {{var_dump($favs)}}
@stop