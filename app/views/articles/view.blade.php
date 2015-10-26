@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">
    <style>

    </style>
    <h1>{{{$articles['0']->title }}}</h1><h2>{{{$articles['0']->subtitle}}}</h2>
    <div>
        {{Form::open(['url'=>'/comment'])}}
        {{Form::text('comments')}}
        {{Form::hidden('user_id',6)}}
        {{Form::hidden('article_id',3)}}
        {{Form::submit('送信')}}
        {{Form::close()}}
        <li class="clear">
            @foreach ($comment_data as $comment)
                <p class="comment">{{{ $comment->comment }}}</p>
                <p class="commenter_name">by {{{$comment->username}}}</p>
                <p class="created_at">{{$comment->created_at}}</p>
            @endforeach
        </li>
    </div>

    <div>
        <p>お気に入り数</p>
        {{ $fav_data }}
        {{Form::open(['url'=>'/fav'])}}
        {{Form::hidden('user_id',6)}}
        {{Form::hidden('article_id',3)}}
        {{Form::submit('お気に入り')}}
        {{Form::close()}}
    </div>

    <div class="wrap">
        <div class="scrollbar">
            <div class="handle"></div>
            <div class="mousearea"></div>
        </div>

        <div class="frame effects" id="effects" >
            <ul class="clearfix">
    @foreach ($photos as $photo)
    <li><img src="/images/eeee/{{ $photo }}"></li>
    @endforeach
            <li>コメント</li>
        </ul>
        <button class=" prev uk-botton"><i class="icon-chevron-left"></i> prev</button>
        <button class=" next uk-botton">next <i class="icon-chevron-right"></i></button>
        </div>
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

                    // Buttons
                    prev: $wrap.find('.prev'),
                    next: $wrap.find('.next')
                });
            }());
        });
    </script>
@stop