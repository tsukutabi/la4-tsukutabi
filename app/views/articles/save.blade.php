@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="{{ asset('packages/bower_components/tag-it/css/jquery.tagit.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/validationEngine/css/validationEngine.jquery.css') }}">

    <script src="{{ asset('packages/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/jquery-ui/jquery-ui.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/validationEngine/js/jquery.validationEngine.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/validationEngine/js/languages/jquery.validationEngine-ja.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/tag-it/js/tag-it.min.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/fileinput.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/fileinput_locale_ja.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') }}" defer="defer"></script>
    <div class="container">
    <img src="images/logo/logo_type.png" alt="つくたび">
    <span>投稿ページ</span>
    <h1 class="lead">投稿ページ</h1>
        {{Form::open(['url'=>'save','enctype'=>'multipart/form-data','id'=>'uk_form'])}}
    <div class="form-group">
        <label for="main">タイトル <span>必須項目</span></label>
        <input id="main" type="text" name="MainTitle" class="form-control" placeholder="旅行記のタイトル" required="true">
        <label for="sub">概要 <span>必須項目</span></label>
        <input id="sub" type="text" name="SubTitle" class="form-control" placeholder="旅の概要を教えて下さい">
        <div class="form-inline mg-tp">
            <label for="departure">出発日</label>
            <input type="text" id="datepicker" class="form-control" placeholder="出発日を教えて下さい">
            <label for="">宿泊数</label>
            <input type="number" name="night" id="night" class="form-control" required="true">
            <label for="">泊</label>
            <input type="number" name="days" id="days" class="form-control" required="true">
            <label for="">日</label>
        </div>
        <label for="budget">予算</label>
        <select name="budget" id="budget" class="ui fluid dropdown">
            <option value="0">¥1~10000</option>
            @for ($budget_i = 2; $budget_i < 30; $budget_i++)
                <option value="{{$budget_i}}">¥{{$budget_i-1}}0001~¥{{$budget_i}}0000</option>
            @endfor
        </select>
        <br/>
        <label for="tag-it">タグを5つ入力して下さい。</label>
        <ul id="tag-it"></ul>
        <input id="input-id" name="photos[]" class="file" type="file" multiple data-preview-file-type="image" data-preview-file-icon="" >
    </div>
        {{Form::close() }}
    </div>
    <script>
        $(document).ready(function() {
            $(function(){
                $("#datepicker").datepicker({
                    showButtonPanel: true
                });
            });

            $("#night").bind('keyup',function(){
                var night =1;
                var day =1;
                night = $(this).val();
                console.log(night++);
                day = night++;
//                console.log(day);
                $("#days").val(day);
            });

            $('#tag-it').tagit({
                placeholderText:"タグをつけよう",
                fieldName:"tags[]",
                tagLimit:5,
            });

            $('.ui-widget-content').blur(function () {
                console.log('はずれたよ');
                $('.tagit-label').each(
                        function (i,elem) {
                            
                        }
                    )
            })



//            写真のテンプレートが表示された時
            $("#input-id").fileinput({
                uploadUrl: "/save",
                allowedFileExtensions : ['jpg','png','gif','jpeg'],
                language: "ja",
                multiple:true,
                uploadAsync:false,
                // showUpload:true,
                // showUploadedThumbs:true,
                previewFileType:['image'],
                maxFileCount: 80,
                minFileCount: 2,
                async: false,
                success : function(msg, status){
                    alert('アップロードが成功しました');
                },
                error : function(msg, status){
                    alert('通信ができない状態です。');
                },
                uploadExtraData: function () {
//                    console.log($("#main").val());
                    return {
                        "MainTitle": $("#main").val(),
                        "SubTitle":$("#sub").val(),
                        "tags":$('input[name="tags[]"]').val(),
                        "budgets":$("#budget").val(),
                        "departure_at":$('#datepicker').val(),
                        "days":$("#days").val(),
                        "night":$("#night").val(),
                        "_token":$('meta[name="csrf-token"]').attr('content'),
                    };
                }
            });
        });
    </script>
    <style>
        .kv-file-upload{
         display: none;
        }
        .mg-tp{
            margin-top: 15px;
            margin-bottom: 10px;
        }
        h1{
            display: none;
        }
    </style>
@stop
