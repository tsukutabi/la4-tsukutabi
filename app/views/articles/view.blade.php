@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">
    <script src="{{ asset('packages/bower_components/sly/dist/sly.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/jquery-easing/jquery.easing.js') }}" defer="defer"></script>
    {{--<script src="{{ asset('packages/bower_components/angular.js/angular.min.js') }}" defer="defer"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js"></script>--}}
    {{--<script src="{{ asset('js/controllers/mainCtrl.js') }}" defer="defer"></script>--}}
    {{--<script src="{{ asset('js/services/commentService.js') }}" defer="defer"></script>--}}
    {{--<script src="{{ asset('js/app.js') }}" defer="defer"></script>--}}
    {{--<script src="{{ asset('js/test.js') }}" defer="defer"></script>--}}
    <script src="{{ asset('js/hor.js') }}" defer="defer"></script>
    <header class="view_header" >
        <a href="/">
        <img src="" alt="エゴだよ" id="test">
        </a>

        <h1>{{{ $result['articles']->title  }}}</h1>
        <h2>{{{$result['articles']->subtitle}}}</h2>
        @include ('elements.search')
        @if(!Auth::check())
        <div class="ui buttons" id="modal_lgon">
            <button class="ui button">会員登録</button>
            <div class="or"></div>
            <button class="ui positive button">ログイン</button>
        </div>
        @endif
        <div class="flt_right">
            <button class="ui facebook button">
                <i class="facebook icon"></i>
                Facebook
            </button>
            <button class="ui twitter button" href="http://twitter.com/share?url=[共有したいURL]&text=[任意のテキスト]&via=[ツイート内に含まれるユーザー名]&related=[関連アカウント]">
                <i class="twitter icon"></i>
                Twitter
            </button>
        </div>
    </header>
    <div class="pagespan container" >
        <div class="wrap">
            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea yellow"></div>
                </div>
            </div>
            <div class="frame" id="basic">
                <ul class="clearfix">
                    @foreach ($result['photos'] as $photo)
                        <li class="panel">
                            <img src="/images/{{$result['articles']->user_id}}/{{ $photo }}">
                        </li>
                    @endforeach
                    <li class="panel">
                        <h2 class="comment_title">コメント</h2>
                        <div class="scroll">
                        @foreach($result['comment_data'] as $comments)
                            <div class="hidden">
                                <p class="comment_data flt_left">{{$comments->comment}}
                                    <a href="/user/{{{ $comments->user_id }}}" target="_blank">
                                    <img class="uk-border-circle user-face" width="30" height="30"
src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTIwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjAgMTIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGRkZGRkYiIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNMTA5LjM1NCw5OS40NzhjLTAuNTAyLTIuODA2LTEuMTM4LTUuNDA0LTEuOTAzLTcuODAxYy0wLjc2Ny0yLjM5Ny0xLjc5Ny00LjczMi0zLjA5My03LjAxMQ0KCQljLTEuMjk0LTIuMjc2LTIuNzc4LTQuMjE3LTQuNDU1LTUuODIzYy0xLjY4MS0xLjYwNC0zLjcyOS0yLjg4Ny02LjE0OC0zLjg0NmMtMi40MjEtMC45NTgtNS4wOTQtMS40MzgtOC4wMTctMS40MzgNCgkJYy0wLjQzMSwwLTEuNDM3LDAuNTE2LTMuMDIsMS41NDVjLTEuNTgxLDEuMDMyLTMuMzY3LDIuMTgyLTUuMzU1LDMuNDVjLTEuOTksMS4yNzEtNC41NzgsMi40MjEtNy43NjUsMy40NTENCgkJQzY2LjQxLDgzLjAzNyw2My4yMSw4My41NTIsNjAsODMuNTUyYy0zLjIxMSwwLTYuNDEtMC41MTUtOS41OTgtMS41NDZjLTMuMTg4LTEuMDMtNS43NzctMi4xODEtNy43NjUtMy40NTENCgkJYy0xLjk5MS0xLjI2OS0zLjc3NC0yLjQxOC01LjM1NS0zLjQ1Yy0xLjU4Mi0xLjAyOS0yLjU4OC0xLjU0NS0zLjAyLTEuNTQ1Yy0yLjkyNiwwLTUuNTk4LDAuNDc5LTguMDE3LDEuNDM4DQoJCWMtMi40MiwwLjk1OS00LjQ3MSwyLjI0MS02LjE0NiwzLjg0NmMtMS42ODEsMS42MDYtMy4xNjQsMy41NDctNC40NTgsNS44MjNjLTEuMjk0LDIuMjc4LTIuMzI2LDQuNjEzLTMuMDkyLDcuMDExDQoJCWMtMC43NjcsMi4zOTYtMS40MDIsNC45OTUtMS45MDYsNy44MDFjLTAuNTAyLDIuODAzLTAuODM5LDUuNDE1LTEuMDA2LDcuODM1Yy0wLjE2OCwyLjQyMS0wLjI1Miw0LjkwMi0wLjI1Miw3LjQ0DQoJCWMwLDEuODg0LDAuMjA3LDMuNjI0LDAuNTgyLDUuMjQ3aDEwMC4wNjNjMC4zNzUtMS42MjMsMC41ODItMy4zNjMsMC41ODItNS4yNDdjMC0yLjUzOC0wLjA4NC01LjAyLTAuMjUzLTcuNDQNCgkJQzExMC4xOTIsMTA0Ljg5MywxMDkuODU3LDEwMi4yOCwxMDkuMzU0LDk5LjQ3OHoiLz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNNjAsNzguMTZjNy42MiwwLDE0LjEyNi0yLjY5NiwxOS41Mi04LjA4OGM1LjM5Mi01LjM5Myw4LjA4OC0xMS44OTgsOC4wODgtMTkuNTE5DQoJCXMtMi42OTYtMTQuMTI2LTguMDg4LTE5LjUxOUM3NC4xMjYsMjUuNjQzLDY3LjYyLDIyLjk0Niw2MCwyMi45NDZzLTE0LjEyOCwyLjY5Ny0xOS41MTksOC4wODkNCgkJYy01LjM5NCw1LjM5Mi04LjA4OSwxMS44OTctOC4wODksMTkuNTE5czIuNjk1LDE0LjEyNiw4LjA4OSwxOS41MTlDNDUuODcyLDc1LjQ2NCw1Mi4zOCw3OC4xNiw2MCw3OC4xNnoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                                    {{{$comments->username}}}
                                    </a>
                                </p>
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <button class="ui secondary button flt_left">
                                編集
                            </button>
                            <button class="ui button flt_left">
                                削除
                            </button>
                            </div>
                        @endforeach
                            {{--<p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>--}}
                            {{--<div class="comment" ng-hide="loading" ng-repeat="comment in comments">--}}
                                {{--<h3>コメント <% comment.id %> <small>by <% comment.author %></h3>--}}
                                {{--<p><% comment.text %></p>--}}
                                {{--<p><a href="" ng-click="deleteComment(comment.id)" class="text-muted">削除</a></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<form ng-submit="submitComment()">--}}
                        {{--<input type="text" class="post_comment" ng-model="commentData.text" name="comment">--}}
                        {{--<input type="submit" class="uk-button post_comment_button">--}}
                        {{--</form>--}}
                            <div >
                                <form id="comment_form">
                                    <input type="text" class="post_comment" name="name" id="comment_content">
                                    <input type="hidden" value="6">
                                    <input type="submit" class="uk-button post_comment_button" id="comment_submit">
                                </form>
                            </div>
                    </li>

                </ul>
            </div>

            <ul class="pages"></ul>

            {{--<div class="controls center">--}}
                {{--<button class="btn prevPage"><i class="icon-chevron-left"></i><i class="icon-chevron-left"></i> page</button>--}}
                {{--<button class="btn prev"><i class="icon-chevron-left"></i> item</button>--}}
                {{--<button class="btn backward"><i class="icon-chevron-left"></i> move</button>--}}

                {{--<div class="btn-group">--}}
                    {{--<button class="btn toStart">toStart</button>--}}
                    {{--<button class="btn toCenter">toCenter</button>--}}
                    {{--<button class="btn toEnd">toEnd</button>--}}
                {{--</div>--}}

                {{--<div class="btn-group">--}}
                    {{--<button class="btn toStart" data-item="10"><strong>10</strong> toStart</button>--}}
                    {{--<button class="btn toCenter" data-item="10"><strong>10</strong> toCenter</button>--}}
                    {{--<button class="btn toEnd" data-item="10"><strong>10</strong> toEnd</button>--}}
                {{--</div>--}}

                {{--<button class="btn forward">move <i class="icon-chevron-right"></i></button>--}}
                {{--<button class="btn next">item <i class="icon-chevron-right"></i></button>--}}
                {{--<button class="btn nextPage">page <i class="icon-chevron-right"></i><i class="icon-chevron-right"></i></button>--}}
            {{--</div>--}}
        </div>

        <div class="under_nav">
            <a href="/user/{{  $result['articles']->user_id }}" class="ui blue image medium label" target="_blank">
                <img class="uk-border-circle user-face" width="30" height="30"
                     src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTIwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjAgMTIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGRkZGRkYiIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNMTA5LjM1NCw5OS40NzhjLTAuNTAyLTIuODA2LTEuMTM4LTUuNDA0LTEuOTAzLTcuODAxYy0wLjc2Ny0yLjM5Ny0xLjc5Ny00LjczMi0zLjA5My03LjAxMQ0KCQljLTEuMjk0LTIuMjc2LTIuNzc4LTQuMjE3LTQuNDU1LTUuODIzYy0xLjY4MS0xLjYwNC0zLjcyOS0yLjg4Ny02LjE0OC0zLjg0NmMtMi40MjEtMC45NTgtNS4wOTQtMS40MzgtOC4wMTctMS40MzgNCgkJYy0wLjQzMSwwLTEuNDM3LDAuNTE2LTMuMDIsMS41NDVjLTEuNTgxLDEuMDMyLTMuMzY3LDIuMTgyLTUuMzU1LDMuNDVjLTEuOTksMS4yNzEtNC41NzgsMi40MjEtNy43NjUsMy40NTENCgkJQzY2LjQxLDgzLjAzNyw2My4yMSw4My41NTIsNjAsODMuNTUyYy0zLjIxMSwwLTYuNDEtMC41MTUtOS41OTgtMS41NDZjLTMuMTg4LTEuMDMtNS43NzctMi4xODEtNy43NjUtMy40NTENCgkJYy0xLjk5MS0xLjI2OS0zLjc3NC0yLjQxOC01LjM1NS0zLjQ1Yy0xLjU4Mi0xLjAyOS0yLjU4OC0xLjU0NS0zLjAyLTEuNTQ1Yy0yLjkyNiwwLTUuNTk4LDAuNDc5LTguMDE3LDEuNDM4DQoJCWMtMi40MiwwLjk1OS00LjQ3MSwyLjI0MS02LjE0NiwzLjg0NmMtMS42ODEsMS42MDYtMy4xNjQsMy41NDctNC40NTgsNS44MjNjLTEuMjk0LDIuMjc4LTIuMzI2LDQuNjEzLTMuMDkyLDcuMDExDQoJCWMtMC43NjcsMi4zOTYtMS40MDIsNC45OTUtMS45MDYsNy44MDFjLTAuNTAyLDIuODAzLTAuODM5LDUuNDE1LTEuMDA2LDcuODM1Yy0wLjE2OCwyLjQyMS0wLjI1Miw0LjkwMi0wLjI1Miw3LjQ0DQoJCWMwLDEuODg0LDAuMjA3LDMuNjI0LDAuNTgyLDUuMjQ3aDEwMC4wNjNjMC4zNzUtMS42MjMsMC41ODItMy4zNjMsMC41ODItNS4yNDdjMC0yLjUzOC0wLjA4NC01LjAyLTAuMjUzLTcuNDQNCgkJQzExMC4xOTIsMTA0Ljg5MywxMDkuODU3LDEwMi4yOCwxMDkuMzU0LDk5LjQ3OHoiLz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNNjAsNzguMTZjNy42MiwwLDE0LjEyNi0yLjY5NiwxOS41Mi04LjA4OGM1LjM5Mi01LjM5Myw4LjA4OC0xMS44OTgsOC4wODgtMTkuNTE5DQoJCXMtMi42OTYtMTQuMTI2LTguMDg4LTE5LjUxOUM3NC4xMjYsMjUuNjQzLDY3LjYyLDIyLjk0Niw2MCwyMi45NDZzLTE0LjEyOCwyLjY5Ny0xOS41MTksOC4wODkNCgkJYy01LjM5NCw1LjM5Mi04LjA4OSwxMS44OTctOC4wODksMTkuNTE5czIuNjk1LDE0LjEyNiw4LjA4OSwxOS41MTlDNDUuODcyLDc1LjQ2NCw1Mi4zOCw3OC4xNiw2MCw3OC4xNnoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                {{{$result['articles']->username}}}
            </a>
            @if(!Auth::check())
            <small><a href="">内容についてのお問い合わせ</a></small>
            {{--@elseif()--}}
            <div class="ui buttons">
                <button class="ui positive small button">編集</button>
                <div class="or"></div>
                <button class="ui button small">削除</button>
            </div>
            @endif
            <p>tsukutabi.,inc</p>

            <div class="ui labeled medium button" tabindex="0">
                <div class="ui yellow button" id="fav_botton">
                    <i class="empty star icon"></i>
                    fav
                </div>
                <a class="ui basic yellow left pointing label" id="fav_num">
                    <span id="before_fav">{{{ $result['fav_num'] }}}</span>
                </a>
            </div>

            <div class="ui labeled medium button" tabindex="0">
                <div class="ui green button" >
                    <i class="heart icon"></i>
                    view
                </div>
                <a class="ui basic green left pointing label" >
                    <span id="before_view view_count" >{{{$result['articles']->view}}}</span>
                </a>
            </div>
        </div>
        <div id="auth_login_register" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-large">
                <a class="uk-modal-close uk-close"></a>
                <p>お気に入り登録する際には会員登録 または ログインして下さい。</p>
                <div class="uk-grid">
                <div class="uk-width-1-2">
                <p class="uk-text-large">会員登録 <span>無料</span> </p>
                {{ Form::open(['url' => 'register','class'=>'uk-form']) }}
                {{ Form::email('email','', ['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'メールアドレス']) }}
                {{ Form::text('username','', ['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'ユーザー名']) }}
                {{ Form::password('password',['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'password']) }}
                {{ Form::button('送信',['class'=> 'uk-button uk-button-primary uk-width-1-1']) }}
                {{ Form::close() }}
                </div>
                <div class="uk-width-1-2">
                <p class="uk-text-large">ログイン</p>
                {{ Form::open(['url' => 'login','class'=>'uk-form']) }}
                {{ Form::email('email','', ['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'email']) }}
                {{ Form::password('password',['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'password']) }}
                {{ Form::label('label','ログイン用にデータを記憶する') }}
                {{ Form::checkbox('remember',1,['class'=>'メールアドレスとパスワードを記憶する。'])}}
                {{ Form::button('送信',['class'=>'uk-button uk-button-primary uk-width-1-1']) }}
                {{ Form::close() }}
                </div>

                </div>
            </div>
        </div>
        <script>
            jQuery(function($){
//                'use strict';
                // -------------------------------------------------------------
                //   Basic Navigation
                // -------------------------------------------------------------
                (function () {
                    var $frame  = $('#basic');
                    var $slidee = $frame.children('.panel').eq(0);
                    var $wrap   = $frame.parent();

                    // Call Sly on frame
                    $frame.sly({
                        horizontal: 1,
                        itemNav: 'basic',
                        smart: 1,
                        activateOn: 'click',
                        mouseDragging: 1,
                        touchDragging: 1,
                        releaseSwing: 1,
                        startAt: 0,
                        scrollBar: $wrap.find('.scrollbar'),
                        scrollBy: 2,
                        pagesBar: $wrap.find('.pages'),
                        activatePageOn: 'click',
                        width:500,
                        speed: 400,
                        elasticBounds: 1,
                        easing: 'easeOutExpo',
                        dragHandle: 1,
                        dynamicHandle: 1,
                        clickBar: 1,

                        // Buttons
                        forward: $wrap.find('.forward'),
                        backward: $wrap.find('.backward'),
                        prev: $wrap.find('.prev'),
                        next: $wrap.find('.next'),
                        prevPage: $wrap.find('.prevPage'),
                        nextPage: $wrap.find('.nextPage')
                    });

                    // To Start button
                    $wrap.find('.toStart').on('click', function () {
                        var item = $(this).data('item');
                        // Animate a particular item to the start of the frame.
                        // If no item is provided, the whole content will be animated.
                        $frame.sly('toStart', item);
                    });

                    // To Center button
                    $wrap.find('.toCenter').on('click', function () {
                        var item = $(this).data('item');
                        // Animate a particular item to the center of the frame.
                        // If no item is provided, the whole content will be animated.
                        $frame.sly('toCenter', item);
                    });

                    // To End button
                    $wrap.find('.toEnd').on('click', function () {
                        var item = $(this).data('item');
                        // Animate a particular item to the end of the frame.
                        // If no item is provided, the whole content will be animated.
                        $frame.sly('toEnd', item);
                    });


                }());

                $(function(){
                    $('#modal_lgon').click(function(){
                        var modal = UIkit.modal("#auth_login_register");
                        modal.show();
                    })
                });

                $(function(){
                    $('#comment_submit').click(function(){
                        $login = {{{ Session::get('user.bool') }}}
                        if(!$login){
                            var modal = UIkit.modal("#auth_login_register");
                            modal.show();
                            return
                        }
                    var fd = new FormData();
                    fd.append("article_id",{{ $result['articles']->id }});
                    fd.append("user_id",<?php if(Auth::check()){echo Auth::user()->id;}else{echo "null";}?>);
                    fd.append("_token",$('meta[name="csrf-token"]').attr('content'));
                    fd.append("comment",$('#comment_content').val());
                    console.log(fd);
//              todo  validation
                $.ajax({
                    url:'/comment/',
                    type:'POST',
                    datatype:'json',
                    data:fd,
                    processData:false,
                    contentType: false,
                    success:function(data){
                        console.log('posted');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        alert(errorThrown);
                    }

                })
                    });
                });

               $(function(){
                  $('#fav_botton').click(function(){
                      $login = {{{ Session::get('user.bool') }}}
                      if(!$login){
                          var modal = UIkit.modal("#auth_login_register");
                          modal.show();
                          return
                      }
                      var fd = new FormData();
                      fd.append("article_id",{{ $result['articles']->id }});
                      fd.append("user_id", <?php if(Auth::check()){echo Auth::user()->id;}else{echo 'aa';}?>);
                      fd.append("_token",$('meta[name="csrf-token"]').attr('content'));
                      console.log(fd);
                          $.ajax({
                              url:"/fav",
                              type:'POST',
                              dataType:'json',
                              data:fd,
                              processData:false,
                              contentType: false,
                              success: function(data){
                                  var fav_num = {{{ $result['fav_num']  }}};
                                  var fav_on_off = {{ $has_fav }}
                                  if(fav_on_off){
                                     fav_num = fav_num+1;
                                     console.log(fav_num);
                                     fav_on_off = false;
                                  }else {
                                     console.log(fav_num);
                                     fav_num = fav_num-1;
                                     console.log(fav_num);
                                     fav_on_off = true;
                                  }
                                  console.log(data);
                                  $('#before_fav').css("display","none");
                                  $('#before_fav').after(fav_num);
                              },
                              error: function(XMLHttpRequest, textStatus, errorThrown){
                                  console.log(XMLHttpRequest);
                              }

                          });


                  });

               });
//viewのカウント
                $(function (){
                    $.ajax({
                        url:"/count/{{{ $result['articles']->id }}}",
                        type:'GET',
                        dataType:'json',
                        data:"{{{ $result['articles']->id }}}",
                        processData:false,
                        contentType: false,
                        success: function(data){
                            $('#view_count').after(data);
                            $('#before_view').css("display","none");
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(XMLHttpRequest);
                        }
                    })
                });
//                ajaxここまで
            });
        </script>
@stop
