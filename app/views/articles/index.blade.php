@extends('layout.default')
@section('content')
@include ('elements.search')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/wookmark/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/wookmark/css/overview.css') }}">
    <div id="container">
        <ul id="tiles-wrap">
    @foreach($info as $article)
        <a href="/view/{{ $article->id }}" class="link">
            <li>
                <?php $photo = explode('+',$article->photos);?>
                <img src="images/{{$article->user_id}}/{{ $photo[0] }}" width="200" height="283">
                <p>{{ $article->title }}</p>
                <p>{{ $article->subtitle }}</p>
            </li>
        </a>
    @endforeach
        </ul>
    </div>
    <script src="{{ asset('packages/bower_components/imagesloaded/imagesloaded.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/wookmark/wookmark.min.js') }}" defer="defer"></script>
    <script type="text/javascript">$('#tiles-wrap .link').wookmark();</script>
@stop

