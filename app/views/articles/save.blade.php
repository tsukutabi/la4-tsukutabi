@extends('layout.default')
@section('content')
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="{{ asset('packages/bower_components/tag-it/css/jquery.tagit.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap-fileinput/css/fileinput.min.css') }}">
    <script src="{{ asset('packages/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/jquery-ui/jquery-ui.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/tag-it/js/tag-it.min.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/fileinput.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/fileinput_locale_ja.js') }}" defer="defer"></script>
    <script src="{{ asset('packages/bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') }}" defer="defer"></script>
    <div class="container">
    <h1>投稿ページ</h1>
        {{Form::open(['url'=>'save','enctype'=>'multipart/form-data','id'=>'uk_form'])}}
    <div class="form-group">
        <input id="main" type="text" name="MainTitle" class="form-control" placeholder="旅行記のタイトル" required="true">
        <input id="sub" type="text" name="SubTitle" class="form-control" placeholder="旅の概要を教えて下さい。" >
        <div class="form-inline">
            <input type="number" name="night" id="night" class="form-control">
            <label for="">泊</label>
            <input type="number" name="days" id="days" class="form-control">
            <label for="">日</label>
        </div>
        <label for="">予算</label>

        <select name="budget" id="budget" class="ui fluid dropdown">
            <option value="0">¥1~10000</option>
            @for ($budget_i = 2; $budget_i < 20; $budget_i++)
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
        {{--$(document).ready(function(){--}}
{{--//        todo 静的なjsonをcdnにおいておく。--}}
            {{--$.ajax({--}}
                {{--type: 'GET',--}}
{{--//                url: '/tags',--}}
                {{--dataType: 'json',--}}
                {{--processData: false,--}}
                {{--contentType: false,--}}
                {{--success: function (data) {--}}
                    {{--console.log(data);--}}
                    {{--var tags = data;--}}
                    {{--$('#tag-it').tagit({--}}
                        {{--removeConfirmation: true,--}}
                        {{--tagLimit:5,--}}
                        {{--placeholderText:"5つタグをつけて下さい",--}}
                        {{--fieldName:"tags[]",--}}
                        {{--availableTags: []--}}
                    {{--});--}}
                {{--},--}}
                {{--error: function(data){--}}
                    {{--console.log('エラー');--}}
                    {{--console.log(data);--}}
                {{--}--}}
            {{--});--}}
        {{--tag it のあれ--}}

 $(document).ready(function() {

            $("#night").bind('keyup',function(){
                var night =1;
                var day =1;
                night = $(this).val();
                console.log(night++);
                day=  night++;
//                console.log(day);
                $("#days").val(day);
            });

            $('#tag-it').tagit({
                placeholderText:"タグをつけよう",
                fieldName:"tags[]",
                tagLimit:5
            });

//            写真のテンプレートが表示された時

            $("#input-id").fileinput({
                uploadUrl: "/save",
                allowedFileExtensions : ['jpg','png','gif','jpeg'],
                language: "ja",
                multiple:true,
                uploadAsync:false,
                previewFileType:['image'],
                maxFileCount: 80,
                minFileCount: 2,
//                template:"<>",
                async: false,
                success : function(msg, status){
                    alert('成功');
                    location.href="/";
                },
                error : function(msg, status){
                    alert('通信ができない状態です。');
                },
                uploadExtraData: function () {
//
                    console.log($(".ui-widget-content").val());
//                    console.log($("#main").val());
//                    console.log($("#sub").val());
//                    console.log($("#departure").val());
                    return {
                        "MainTitle": $("#main").val(),
                        "SubTitle":$("#sub").val(),
                        "depature_at":$('#departure').val(),
                        "retrun_at":$('#retrune').val(),
                        "_token":$('meta[name="csrf-token"]').attr('content'),
//                        "tags":$(".ui-widget-content").val(),
                        {{--"user_id":"{{{ Auth::user()->id }}}"--}}
                    };
                }
            });
        });
    </script>
@stop
