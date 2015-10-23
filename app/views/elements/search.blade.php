{{Form::open(['url' => 'find','method'=>'get']) }}
<input type="text" name="word" value="<?php if(isset($_GET['word'])){ echo $_GET['word'];}?>">
{{Form::submit('検索')}}
{{Form::close()}}