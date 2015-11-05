{{Form::open(['url' => 'find','method'=>'get','class'=>'uk-form uk-margin-remove uk-display-inline-block']) }}
<input type="text" name="word" value="<?php if(isset($_GET['word'])){ echo $_GET['word'];}?>" class="">
{{Form::button('検索',['class'=>'uk-button uk-button-primary','placeholer'=>'検索ワード'])}}
{{Form::close()}}