{{Form::open(['url' => 'find','method'=>'get']) }}
<div class="ui category search">
    <div class="ui icon input">
        <input type="text" name="word" value="<?php if(isset($_GET['word'])){ echo $_GET['word'];}?>" class="">
        <i class="search icon"></i>
{{--{{Form::button('検索',['class'=>'uk-button uk-button-primary','placeholer'=>'検索ワード'])}}--}}
    </div>
    <div class="results"></div>
</div>
{{Form::close()}}

<style>
    nav .uk-navbar-content form{
        margin-top: -40px;
    }
</style>