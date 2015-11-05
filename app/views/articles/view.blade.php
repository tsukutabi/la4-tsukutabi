@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">
    <header class="view_header">
        <img src="" alt="ロゴ" class="header-img">
        <h1>{{{$articles->title }}}</h1>
        <h2>{{{$articles->subtitle}}}</h2>
        <p>written by {{{$articles->username}}}</p>
    </header>
    <div class="comment">
        {{--{{var_dump($comment_data)}}--}}
        @foreach($comment_data as $comments)
            {{$comments->comment}}
            by {{$comments->username}}
            {{$comments->created_at}}
        {{--ログインしている人と投稿した人が一致したら--}}
            @if(Auth::user()->id == $comments->user_id)
                <a href="/edit_comment/{{$comments->id}}">編集する</a>
                {{Form::open(['url'=>'delete_comment/'.$comments->id])}}
                {{Form::hidden('user_id',Auth::user()->id)}}
                {{Form::submit('削除する')}}
                {{Form::close()}}
                @else
                <a href="/spam_comment/{{$comments->id}}">
                <p>スパムを報告する。</p>
                </a>
            @endif
        @endforeach
    </div>
    <div>
        <p>お気に入り数</p>
        {{ var_dump($fav_data)}}
        {{Form::open(['url'=>'/fav'])}}
        {{Form::hidden('user_id',Auth::user()->id)}}
        {{Form::hidden('article_id',$articles->id)}}
        {{Form::submit('お気に入り')}}
        {{Form::close()}}
    </div>

    <div class="wrap">
        {{--スクロールバー--}}
        <div class="scrollbar">
            <div class="handle"></div>
            <div class="mousearea"></div>
        </div>

        <div class="frame effects" id="effects" >
            <ul class="clearfix">
                @foreach ($photos as $photo)
                    <li class="panel">
                        <img src="/images/{{$articles->user_id}}/{{ $photo }}">
                    </li>
                @endforeach
            </ul>

            <button class="prev uk-botton"><i class="icon-chevron-left"></i> prev</button>
            <button class="next uk-botton">next <i class="icon-chevron-right"></i></button>
        </div>{{-- frameの閉じタグ --}}
    </div>
    <script src="{{ asset('packages/bower_components/sly/dist/sly.js') }}" defer="defer"></script>
    <script src="{{ asset('js/hor.js') }}" defer="defer"></script>
    <script>
        jQuery(function($){
            'use strict';
            // -------------------------------------------------------------
            //   Effects
            // -------------------------------------------------------------
            (function () {
                var $frame = $('#effects');
                var $wrap  = $frame.parent();
                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'forceCentered',
                    smart: 1,
                    activateMiddle: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 0,
                    scrollBar: $wrap.find('.scrollbar'),
                    scrollBy: 1,
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'swing',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1,
                    frameSize: 1140,
                    // Buttons
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next')
                });
            }());
        });
    </script>

    <script type="text/javascript" src="{{ asset('packages/bower_components/angular.js/angular.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/angular_app.js') }}"></script>
@stop
