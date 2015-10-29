@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap-fileinput/css/fileinput.min.css') }}">
    <script src="{{ asset('packages/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/fileinput.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/fileinput_locale_ja.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') }}" defer="defer"></script>
    <div class="container">
    <h1>投稿ページ</h1>
        {{Form::open(['url'=>'save','enctype'=>'multipart/form-data','id'=>'uk_form'])}}
    <div class="form-group">
        <input id="main" type="text" name="MainTitle" class="form-control" placeholder="旅行記のタイトル" id="Main" required="true">
        <input id="sub" type="text" name="SubTitle" class="form-control" placeholder="旅の概要を教えて下さい。" id="Sub">
        <input type="hidden" value="{{{Auth::user()->id}}}" name="user_id" >
        <input type="text" name="tags" class="form-control" placeholder="
        @foreach($tags as $tag)
            {{{ $tag->name }}}
        @endforeach">
        <input type="date" name="departure_at">
        <input type="date" name="return_at">
        <input id="input-id" name="photos[]" class="file" type="file" multiple data-preview-file-type="image" data-preview-file-icon="" >

        <input type="submit" class="btn-block">

    </div>
        {{Form::close() }}
    </div>
    <script>

        $(document).ready(function() {
//            値が入力された時
            $("#uk_form input[name=name]").on("blur",function(){
                var main = $("#main").val();
                var sub = $("#sub").val();
//                var photo_comments = $('#photo_comments).val();
            });




            $("#input-id").fileinput({
                uploadUrl: "/save",
                allowedFileExtensions : ['jpg','png','gif','jpeg'],
                language: "ja",
                multiple:true,
                uploadAsync:false,
                previewFileType:['image','video'],
                maxFileCount: 80,
                minFileCount: 2,
                uploadExtraData: {
                    MainTitle: main,
                    SubTitle: sub
                }

    //            successs( function(){
    //                location("/");
    //            }),
                });
        });
    </script>
@stop
