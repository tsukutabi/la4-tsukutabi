<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="つくたびのページです。">
    <meta name="keywords" content="コンテンツです">
    <meta name="author" content="tsukutabi-inc">
    <meta property="og:title" content=" {{{$title }}}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="ページのディスクリプション" />
    <meta property="og:url" content="tsukutabi.com" />
    <meta property="og:site_name"  content="サイト名" />
    <meta property="og:image" content="tsukutabi.com" />
    <meta name="csrf-token" content="<?= csrf_token() ?>">

    {{--twitter--}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@[Twitter ID]">
    {{--facebook--}}
    <meta property="fb:app_id" content="App-ID（15文字の半角数字）" />

    <link rel="stylesheet" href="{{ asset('packages/bower_components/uikit/css/uikit.almost-flat.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bower_components/semantic/dist/semantic.css') }}">
    <title>つくたび || {{{$title }}}</title>
    <script src="{{ asset('packages/bower_components/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('packages/bower_components/uikit/js/uikit.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('packages/bower_components/normalize.css/normalize.css') }}">
    <link rel="icon" type="image/png" href="/favicon_48.ico" sizes="48x48">
    <style>
        {{-- 解説: インラインのCSSブロックです。各ページで追記ができます。--}}
        @section ('inline-style')

        @show
        {{-- 解説: セクションをこの場所に展開させたい場合、@showを指定します。--}}
    </style>
</head>
<body  ng-app id="main_body">
{{-- 解説: ここに各ページの内容が展開されます。--}}
@yield ('content')

@include ('elements.footer')
<style>
    footer p {
        text-align: center;
    }
</style>
<script>
    {{-- 解説: インラインのJavaScriptブロックです。各ページで追記ができます。--}}
    @section ('inline-script')
    @show
    {{-- 解説: セクションをこの場所に展開させたい場合、@showを指定します。--}}
</script>
</body>
</html>