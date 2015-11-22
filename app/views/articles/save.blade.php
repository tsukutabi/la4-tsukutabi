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
        <input id="main" type="text" name="MainTitle" class="form-control" placeholder="旅行記のタイトル" required="true">
        <input id="sub" type="text" name="SubTitle" class="form-control" placeholder="旅の概要を教えて下さい。" >
        <input type="hidden" value="{{{Auth::user()->id}}}" name="user_id" >
        <input type="text" name="tags" class="form-control" placeholder="
        @foreach($tags as $tag)
            {{{ $tag->name }}}
        @endforeach">
        <input type="date" name="departure_at" id="departure">
        <input type="date" name="return_at" id="return">
        <input id="input-id" name="photos[]" class="file" type="file" multiple data-preview-file-type="image" data-preview-file-icon="" >
    </div>
        {{Form::close() }}
    </div>
    <script>
        $(document).ready(function(){
//            $("#sub").change(function () {
//                sub = $(this).val();
//                console.log(sub);
//            }).change();

//            var main = new Object('hello');


            function get_value(){
                var sub = $('#sub').val();
                return sub;
            }




            var departure_time = $('#departure').blur(
                    function (){
                        departure_time = $(this).val()
                        console.log(departure_time);
                        return departure_time;
                    }
            );

            var return_time = $('#return').blur(
                    function (){
                        return_time = $(this).val()
                        console.log(return_time);
                        return return_time;
                    }
            )

            $("#input-id").fileinput({
                uploadUrl: "/save",
                allowedFileExtensions : ['jpg','png','gif','jpeg'],
                language: "ja",
                multiple:true,
                uploadAsync:false,
//                previewFileType:['image','video'],
                maxFileCount: 80,
                minFileCount: 2,
                async: false,
                success : function(msg, status){
                    console/log(sub);
                  alert('成功');
                },
                error : function(msg, status){
                    alert('通信ができない状態です。');
                },
                uploadExtraData: function () {
                    return {
                        "Subtitle": $("#main").val(),
                        "Maintitle":$("#sub").val(),
                        "depature_at":$('#departure').val(),
                        "retrun_at":$('#retrune').val(),
                        "user_id": {{{ Auth::user()->id }}}
                    };
                }
                });


        });
    </script>
@stop
