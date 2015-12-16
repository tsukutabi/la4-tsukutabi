@extends('layout.users')
@section('content')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/uikit/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/uikit/css/uikit.gradient.css') }}">
    <style>
        footer p{
            text-align: center;
            position: absolute;
            bottom:0;
        }
        footer {
            margin-bottom: 20px;
            position: absolute;
            margin: auto;
            bottom:0;
            overflow: hidden;
        }

        html,body{
            height:100%;
        }

        input[type="file"] {
            display: none;
        }

        .btn-group{
            position: relative;
        }

        .btn-group:hover:after{
            content:"顔写真を変更する";
            display:block;
            position:absolute;
            bottom:10px;
            left:0;
            width:100%;
            height:30px;
            line-height:30px;
            background-color:#eee;
            font-weight:bold;
            text-align:center;
        }

    </style>
    <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
        <nav class="uk-navbar uk-margin-large-bottom">
            <a class="uk-navbar-brand uk-hidden-small" href="/">つくたび</a>
            <ul class="uk-navbar-nav uk-hidden-small">
                <li>
                    <a href="">Frontpage</a>
                </li>
                <li>
                    <a href="">Portfolio</a>
                </li>
                <li >
                    <a href="">Blog</a>
                </li>
                <li>
                    <a href="">Documentation</a>
                </li>
                <li>
                    <a href="">連絡</a>
                </li>
                <li>
                    <a href="">ログアウト</a>
                </li>
            </ul>
            <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small">Brand</div>
        </nav>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-3-4">
                <article class="uk-article">
                    <h1 class="uk-article-title">
                        記事一覧
                    </h1>
                    <p class="uk-article-meta">Written by php on 12 April 2013. Posted in <a href="#">Blog</a></p>
                    <p>
                        <img width="900" height="300"
                        src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iOTAwcHgiIGhlaWdodD0iMzAwcHgiIHZpZXdCb3g9IjAgMCA5MDAgMzAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA5MDAgMzAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSI5MDAiIGhlaWdodD0iMzAwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0zNzguMTg0LDkzLjV2MTEzaDE0My42MzN2LTExM0gzNzguMTg0eiBNNTEwLjI0NCwxOTQuMjQ3SDM5MC40Mzd2LTg4LjQ5NGgxMTkuODA4TDUxMC4yNDQsMTk0LjI0Nw0KCQlMNTEwLjI0NCwxOTQuMjQ3eiIvPg0KCTxwb2x5Z29uIGZpbGw9IiNEOEQ4RDgiIHBvaW50cz0iMzk2Ljg4MSwxODQuNzE3IDQyMS41NzIsMTU4Ljc2NCA0MzAuODI0LDE2Mi43NjggNDYwLjAxNSwxMzEuNjg4IDQ3MS41MDUsMTQ1LjQzNCANCgkJNDc2LjY4OSwxNDIuMzAzIDUwNC43NDYsMTg0LjcxNyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iNDI1LjQwNSIgY3k9IjEyOC4yNTciIHI9IjEwLjc4NyIvPg0KPC9nPg0KPC9zdmc+DQo=" alt="">
                    </p>

                    <table class="uk-table uk-table-striped uk-table-hover">
                        <thead>
                        <tr>
                            <th>旅行記</th>
                            <th>サブタイトル</th>
                            <th>created</th>
                            <th>view</th>
                            <th>faved</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            {{var_dump($articles)}}
                            @foreach($articles as $article)
                            <tr>
                                <td>{{{ $article->title }}}</td>
                                <td>{{{ $article->subtitle }}}</td>
                                <td>{{{ $article->created_at }}}</td>
                                <td></td>
                                <td></td>
                                <td><a href="/view/{{{ $article->id }}}" target="_blank" class="uk-button uk-button-primary">続きを読む</a></td>
                            </tr>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                    <p>
                        <a class="uk-button uk-button-primary" href="layouts_post.html">Continue Reading</a>
                        <a class="uk-button" href="layouts_post.html">4 Comments</a>
                    </p>
                </article>

                <article class="uk-article">

                    <h1 class="uk-article-title">
                        <a href="">お気に入り記事一覧</a>
                    </h1>

                    <p class="uk-article-meta">Written by Author on 12 April 2013. Posted in <a href="#">Blog</a></p>

                    <p>

                        <img width="900" height="300" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iOTAwcHgiIGhlaWdodD0iMzAwcHgiIHZpZXdCb3g9IjAgMCA5MDAgMzAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA5MDAgMzAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSI5MDAiIGhlaWdodD0iMzAwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0zNzguMTg0LDkzLjV2MTEzaDE0My42MzN2LTExM0gzNzguMTg0eiBNNTEwLjI0NCwxOTQuMjQ3SDM5MC40Mzd2LTg4LjQ5NGgxMTkuODA4TDUxMC4yNDQsMTk0LjI0Nw0KCQlMNTEwLjI0NCwxOTQuMjQ3eiIvPg0KCTxwb2x5Z29uIGZpbGw9IiNEOEQ4RDgiIHBvaW50cz0iMzk2Ljg4MSwxODQuNzE3IDQyMS41NzIsMTU4Ljc2NCA0MzAuODI0LDE2Mi43NjggNDYwLjAxNSwxMzEuNjg4IDQ3MS41MDUsMTQ1LjQzNCANCgkJNDc2LjY4OSwxNDIuMzAzIDUwNC43NDYsMTg0LjcxNyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iNDI1LjQwNSIgY3k9IjEyOC4yNTciIHI9IjEwLjc4NyIvPg0KPC9nPg0KPC9zdmc+DQo=" alt="">
                    </p>

                    <table class="uk-table uk-table-striped uk-table-hover">
                        <thead>
                        <tr>
                            <th>旅行記</th>
                            <th>サブタイトル</th>
                            <th>created</th>
                            <th>view</th>
                            <th>faved</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        {{var_dump($articles)}}
                        @foreach($articles as $article)
                            <tr>
                                <td>{{{ $article->title }}}</td>
                                <td>{{{ $article->subtitle }}}</td>
                                <td>{{{ $article->created_at }}}</td>
                                <td></td>
                                <td></td>
                                <td><a href="/view/{{{ $article->id }}}" target="_blank" class="uk-button uk-button-primary">続きを読む</a></td>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>

                    <p>
                        <a class="uk-button uk-button-primary" href="layouts_post.html">Continue Reading</a>
                        <a class="uk-button" href="layouts_post.html">4 Comments</a>
                    </p>

                </article>

                <ul class="uk-pagination">
                    <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
                    <li class="uk-active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><span>...</span></li>
                    <li><a href="#">20</a></li>
                    <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
                </ul>

            </div>

            <div class="uk-width-medium-1-4">
                <div class="uk-panel uk-panel-box uk-text-center">

                    <div id="drag-area">
                        <div class="btn-group">
                            <input type="file" multiple="multiple">
                            @if(isset($users->facephoto))
                            <img src="/images/facephoto/{{{ $users->facephoto }}}" alt="{{{$users->username}}}" id="btn" class="uk-border-circle hover_message">
                            @else
                            <img class="uk-border-circle hover_message" id="btn" width="120" height="120" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTIwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjAgMTIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGRkZGRkYiIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNMTA5LjM1NCw5OS40NzhjLTAuNTAyLTIuODA2LTEuMTM4LTUuNDA0LTEuOTAzLTcuODAxYy0wLjc2Ny0yLjM5Ny0xLjc5Ny00LjczMi0zLjA5My03LjAxMQ0KCQljLTEuMjk0LTIuMjc2LTIuNzc4LTQuMjE3LTQuNDU1LTUuODIzYy0xLjY4MS0xLjYwNC0zLjcyOS0yLjg4Ny02LjE0OC0zLjg0NmMtMi40MjEtMC45NTgtNS4wOTQtMS40MzgtOC4wMTctMS40MzgNCgkJYy0wLjQzMSwwLTEuNDM3LDAuNTE2LTMuMDIsMS41NDVjLTEuNTgxLDEuMDMyLTMuMzY3LDIuMTgyLTUuMzU1LDMuNDVjLTEuOTksMS4yNzEtNC41NzgsMi40MjEtNy43NjUsMy40NTENCgkJQzY2LjQxLDgzLjAzNyw2My4yMSw4My41NTIsNjAsODMuNTUyYy0zLjIxMSwwLTYuNDEtMC41MTUtOS41OTgtMS41NDZjLTMuMTg4LTEuMDMtNS43NzctMi4xODEtNy43NjUtMy40NTENCgkJYy0xLjk5MS0xLjI2OS0zLjc3NC0yLjQxOC01LjM1NS0zLjQ1Yy0xLjU4Mi0xLjAyOS0yLjU4OC0xLjU0NS0zLjAyLTEuNTQ1Yy0yLjkyNiwwLTUuNTk4LDAuNDc5LTguMDE3LDEuNDM4DQoJCWMtMi40MiwwLjk1OS00LjQ3MSwyLjI0MS02LjE0NiwzLjg0NmMtMS42ODEsMS42MDYtMy4xNjQsMy41NDctNC40NTgsNS44MjNjLTEuMjk0LDIuMjc4LTIuMzI2LDQuNjEzLTMuMDkyLDcuMDExDQoJCWMtMC43NjcsMi4zOTYtMS40MDIsNC45OTUtMS45MDYsNy44MDFjLTAuNTAyLDIuODAzLTAuODM5LDUuNDE1LTEuMDA2LDcuODM1Yy0wLjE2OCwyLjQyMS0wLjI1Miw0LjkwMi0wLjI1Miw3LjQ0DQoJCWMwLDEuODg0LDAuMjA3LDMuNjI0LDAuNTgyLDUuMjQ3aDEwMC4wNjNjMC4zNzUtMS42MjMsMC41ODItMy4zNjMsMC41ODItNS4yNDdjMC0yLjUzOC0wLjA4NC01LjAyLTAuMjUzLTcuNDQNCgkJQzExMC4xOTIsMTA0Ljg5MywxMDkuODU3LDEwMi4yOCwxMDkuMzU0LDk5LjQ3OHoiLz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNNjAsNzguMTZjNy42MiwwLDE0LjEyNi0yLjY5NiwxOS41Mi04LjA4OGM1LjM5Mi01LjM5Myw4LjA4OC0xMS44OTgsOC4wODgtMTkuNTE5DQoJCXMtMi42OTYtMTQuMTI2LTguMDg4LTE5LjUxOUM3NC4xMjYsMjUuNjQzLDY3LjYyLDIyLjk0Niw2MCwyMi45NDZzLTE0LjEyOCwyLjY5Ny0xOS41MTksOC4wODkNCgkJYy01LjM5NCw1LjM5Mi04LjA4OSwxMS44OTctOC4wODksMTkuNTE5czIuNjk1LDE0LjEyNiw4LjA4OSwxOS41MTlDNDUuODcyLDc1LjQ2NCw1Mi4zOCw3OC4xNiw2MCw3OC4xNnoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                            @endif
                        </div>
                    </div>


                    <h3>{{{$users->username}}}</h3>
                    {{var_dump($users)}}
                    <p id="user_profile">{{$users->profile}}</p>

                </div>
                <div class="uk-panel">
                    <h3 class="uk-panel-title">Archives</h3>
                    <ul class="uk-list uk-list-line">
                        <li><a href="#">January 2014</a></li>
                        <li><a href="#">December 2013</a></li>
                        <li><a href="#">November 2013</a></li>
                        <li><a href="#">October 2013</a></li>
                        <li><a href="#">September 2013</a></li>
                    </ul>
                </div>
                <div class="uk-panel">
                    <h3 class="uk-panel-title">Social Links</h3>
                    <ul class="uk-list">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar">
            <ul class="uk-nav uk-nav-offcanvas">
                <li>
                    <a href="layouts_frontpage.html">Frontpage</a>
                </li>
                <li>
                    <a href="layouts_portfolio.html">Portfolio</a>
                </li>
                <li class="uk-active">
                    <a href="layouts_blog.html">Blog</a>
                </li>
                <li>
                    <a href="layouts_documentation.html">Documentation</a>
                </li>
                <li>
                    <a href="layouts_contact.html">Contact</a>
                </li>
                <li>
                    <a href="layouts_login.html">Login</a>
                </li>
            </ul>
        </div>
    </div>
    <style>
        #users-head{
            overflow: hidden;
        }
        #users-head ul a .user-list{
            float: left;
            list-style: none;
        }
        .overflow{
            overflow: hidden;
        }
        .overflow main{
            float: left;
            width: 70%;
        }

        .overflow .sidebar{
            float: left;
            width: 30%;
        }

    </style>
    <div class="container overflow">
    <main>
    <p>投稿記事</p>
    {{var_dump($articles)}}
    <p>お気に入り記事</p>
    {{var_dump($favs)}}
    </main>
        <div class="sidebar">
        <section>
        顔写真
            <img src="" alt="顔写真">
            <p>username</p>
            <p>ユーザー紹介</p>
            <p>How many favved</p>
            <p></p>
        </section>
        <section>

        </section>
        </div>{{--sidebar--}}
    </div>

    <script>
        jQuery(function($){


            $(function(){
                /*================================================
                 ファイルをドロップした時の処理
                 =================================================*/
                $('#drag-area').bind('drop', function(e){
                    // デフォルトの挙動を停止
                    e.preventDefault();

                    // ファイル情報を取得
                    var files = e.originalEvent.dataTransfer.files;

                    uploadFiles(files);

                }).bind('dragenter', function(){
                    // デフォルトの挙動を停止
                    return false;
                }).bind('dragover', function(){
                    // デフォルトの挙動を停止
                    return false;
                });

                /*================================================
                 ダミーボタンを押した時の処理
                 =================================================*/
                $('#btn').click(function() {
                    // ダミーボタンとinput[type="file"]を連動
                    $('input[type="file"]').click();
                });

                $('input[type="file"]').change(function(){
                    // ファイル情報を取得
                    var files = this.files;


                    var file = $(this).prop('files')[0];
                    var fr = new FileReader();
                    fr.onload = function() {
                        $('#btn').attr('src', fr.result);   // 読み込んだ画像データをsrcにセット
                    }
                    fr.readAsDataURL(file);  // 画像読み込み
                    uploadFiles(files);
                });

            });

            /*================================================
             アップロード処理
             =================================================*/
            function uploadFiles(files) {
                // FormDataオブジェクトを用意
                var fd = new FormData();

                fd.append("face_photo",files['0']);
                fd.append("user_id", {{{  Session::get('user.id') or 'null' }}});
                fd.append("_token",$('meta[name="csrf-token"]').attr('content'));
                console.log(fd);

                // Ajaxでアップロード処理をするファイルへ内容渡す
                $.ajax({
                    url: "/user/change_face_photo",
                    type: 'POST',
                    dataType : 'json',
                    data :fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log('ファイルがアップロードされました。');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        console.log("エラー");
                    }
                });
            }

            $('#user_profile').click(function(){
                if(!$(this).hasClass('on')){
                    $(this).addClass('on');
                    var txt = $(this).text();
                    console.log('test');
                    $(this).text('').append('<input type="text" value="'+txt+'" />');
                    $('#user_profile > input').focus().blur(function(){
                        var inputVal = $(this).val();
                        if(inputVal===''){
                            inputVal = this.defaultValue;
                        }else {
                            $.ajax({
                                url: "/user/profile",
                                type:'POST',
                                dataType: 'json',
                                data : {
                                    _token:$('meta[name="csrf-token"]').attr('content'),
                                    id:"{{{$users->id}}}",
                                    profile:inputVal,
//                                    _token
                                },
                                timeout:10000,
                                success: function(data) {
                                    console.log('おk');
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("error");
                                }
                            });
                        };

                        $(this).parent().removeClass('on').text(inputVal);
                    });
                };
            });
        });
    </script>

@stop