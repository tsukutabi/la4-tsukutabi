@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">
    <script src="{{ asset('packages/bower_components/sly/dist/sly.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/jquery-easing/jquery.easing.js') }}" defer="defer"></script>
    <script src="{{ asset('js/hor.js') }}" defer="defer"></script>

    <script src="{{ asset('packages/bower_components/tag-it/js/tag-it.min.js') }}" defer="defer"></script>
    <header class="view_header" >
        <a href="/">
        <img src="" alt="エゴだよ" id="test">
        </a>
        <h1>{{{$result['articles']->title  }}}</h1>
        <h2>{{{$result['articles']->subtitle}}}</h2>
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
                            <input type="text" name="comment[]">
                        </li>
                    @endforeach
                </ul>
                <ul>
                    <label for="tag-it">タグを5つ入力して下さい。</label>
                    <ul id="tag-it"></ul>
                </ul>
            </div>
            <ul class="pages"></ul>
        </div>
            <p>tsukutabi.,inc</p>
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
//                    todo blade
                    fd.append("user_id",<?php if(Auth::check()){echo Auth::user()->id;}else{echo "null";}?>);
                    fd.append("_token",$('meta[name="csrf-token"]').attr('content'));
                    fd.append("comment",$('#comment_content').val());
                    console.log(fd);
                    event.preventDefault();
//              todo  validation
//                    if (!$('input[name=comment]').val()) {
//                        $('#send-comment-error').text('コメントを入力して下さい。');
//                        return;
//                    }
                        $.ajax({
                            url:'/comment/',
                            type:'POST',
                            datatype:'json',
                            data:fd,
                            processData:false,
                            contentType: false,
                            success:function(data){
                                console.log('posted');
                                $('').after();
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown){
                                alert(errorThrown);
                            }
                        })
                    });


                //  todo グローバルってるので修正
                $('#tag-it').tagit({
                    placeholderText:"タグをつけよう",
                    fieldName:"tags[]",
                    tagLimit:5,
                    afterTagAdded: function(event, ui) {
                        console.log(ui.tag);
                        console.log(this);
                        var tag_num = $('input[name="tags[]"]').length;
                        var tag_info =[];
                        for (var i=0; i < tag_num; i++) {
                            console.log($('#tag-it li:eq(1)>span'));
                            tag_info.push($('#tag-it li:eq(i) span').text());
                            console.log(tag_info);
                        }
                    }
                });


            });



            $(function(){
                var button = $('#fav_botton');
                if(button.data('condition') == true){
                    button.css('backgroundColor','#D9E778');
                }
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
                      fd.append("user_id", @if(Auth::check()){{ Auth::user()->id}}@else{{"none"}}@endif);
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
                                  var button = $('#fav_botton');
                                  var fav_num = {{{ $result['fav_num'] }}};
                                  if($('#fav_botton').data('condition') == false){
                                      console.log('false');
                                      fav_num ++;
                                      console.log(fav_num);
                                      $('#before_fav').text(fav_num);
                                      button.css('backgroundColor','#FF0');
                                      button.data('condition',true);
                                      return
                                  }else if($('#fav_botton').data('condition') == true){
                                      console.log('true');
                                      console.log(fav_num);
//                                      fav_num --;
                                      console.log(fav_num);
                                      $('#before_fav').text(fav_num);
                                      button.css('backgroundColor', '#FBBD08');
                                      //お気に入りボタン状態の更新
                                      button.data('condition',false);
                                  }
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

                            $('#view_count').text(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(XMLHttpRequest);
                        }
                    })
                });
//                ajaxここまで
            });

            //  todo グローバルってるので修正
            $('#tag-it').tagit({
                placeholderText:"タグをつけよう",
                fieldName:"tags[]",
                tagLimit:5,
                afterTagAdded: function(event, ui) {
                    console.log(ui.tag);
                    console.log(this);
                    var tag_num = $('input[name="tags[]"]').length;
                    var tag_info =[];
                    for (var i=0; i < tag_num; i++) {
                        console.log($('#tag-it li:eq(1)>span'));
                        tag_info.push($('#tag-it li:eq(i) span').text());
                        console.log(tag_info);
                    }
                }
            });
        </script>
@stop
