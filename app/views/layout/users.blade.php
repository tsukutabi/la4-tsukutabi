<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>つくたび {{$title}}</title>
    <link rel="stylesheet" href="{{ asset('packages/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        {{-- 解説: インラインのCSSブロックです。各ページで追記ができます。--}}
        @section ('inline-style')
	footer {
            margin-bottom: 5em;
        }
        @show
        {{-- 解説: セクションをこの場所に展開させたい場合、@showを指定します。--}}
    </style>

    <script src="{{ asset('packages/bower_components/jquery/dist/jquery.min.js') }}"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js" type="text/javascript"></script>--}}
    <script src="{{ asset('packages/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/pjax.js') }}" type="text/javascript"></script>
    <script>
        $(function(){
            $.pjax({
                area : '#content',
                link : 'a:not([target])',
                ajax: { timeout: 2500},
                wait: 500
            });
            $(document).bind('pjax:fetch', function(){
                $('body').css('overflow', 'hidden');
                $('#content').attr({'class': 'fadeOut'});
            });
            $(document).bind('pjax:render', function(){
                $('#content').attr({'class': 'fadeIn'});
                $('body').css('overflow', '');
            });
        });
    </script>
</head>
<body>
<div class="container">
{{-- 解説: ここに各ページの内容が展開されます。--}}
@yield ('content')
</div>
{{ $errors->first() }}
{{-- 解説: 'app/views/partials/footer.blade.php' の内容をこの箇所に展開します。 --}}
@include ('elements.footer')

<script>
    {{-- 解説: インラインのJavaScriptブロックです。各ページで追記ができます。--}}
    @section ('inline-script')
    @show
    {{-- 解説: セクションをこの場所に展開させたい場合、@showを指定します。--}}
</script>
</body>
</html>
