<nav class="uk-navbar">
    <a class="uk-navbar-brand" href="/">
        <img src="images/logo/logo_type.png" alt="つくたび">
    </a>
    <span class="uk-navbar-brand">do travel,share it</span>
    <ul class="uk-navbar-nav">
        @if(Auth::check())
            <li class="uk-parent uk-active" data-uk-dropdown>
                <a href="user/{{Auth::user()->id}}" target="_blank">
                <i class="uk-icon-user"></i>
                {{{ Auth::user()->username }}}
                </a>
            </li>
            <div class="uk-navbar-content"><a href="/save" target="_blank">旅行記を投稿する</a></div>
        @else
            <li class="uk-parent uk-active" data-uk-dropdown>
                <a href="#register" data-uk-modal><i class="uk-icon-envelope"></i>ユーザー登録</a>
            </li>
            {{--会員登録用のモーダル--}}
            <div id="register" class="uk-modal">
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <h2>会員登録</h2><span>無料</span>
                    {{ Form::open(['url' => 'register','class'=>'uk-form']) }}
                    {{ Form::email('email','', ['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'メールアドレス']) }}
                    {{ Form::text('username','', ['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'ユーザー名']) }}
                    {{ Form::password('password',['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'password']) }}
                    {{ Form::button('送信',['class'=> 'uk-button uk-button-primary uk-width-1-1']) }}
                    {{ Form::close() }}
                </div>
            </div>
            {{--会員登録用のモーダルここまで--}}

            {{--ログイン登録用のモーダル--}}
            <div id="login" class="uk-modal">
                <div class="uk-modal-dialog">
                    <a class="uk-modal-close uk-close"></a>
                    <h2>ログイン</h2>
                    {{ Form::open(['url' => 'login','class'=>'uk-form']) }}
                    {{ Form::email('email','', ['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'email']) }}
                    {{ Form::password('password',['class' => 'uk-width-1-1 uk-form-large','placeholder'=>'password']) }}
                    {{ Form::label('label','ログイン用にデータを記憶する') }}
                    {{ Form::checkbox('remember',1,['class'=>'メールアドレスとパスワードを記憶する。'])}}
                    {{ Form::button('送信',['class'=>'uk-button uk-button-primary uk-width-1-1']) }}
                    {{ Form::close() }}
                </div>
            </div>
            {{--ログイン登録用のモーダルここまで--}}
            <style>
                .uk-modal input{
                    margin-top: 15px;
                }
                .uk-modal button{
                    margin-top: 15px;
                }
                .uk-modal h2{
                    text-align: center;
                }
                .uk-modal p{
                    text-align: center;
                }
            </style>
            <li class="uk-parent uk-active">
                <a href="#login" data-uk-modal><i class="uk-icon-user"></i>ログイン</a>
            </li>
            <div class="uk-navbar-content"><a href="/save" target="_blank"><i class="uk-icon-pencil-square-o"></i>会員登録をして旅行記を投稿する</a></div>
        @endif
    </ul>
    <div class="uk-navbar-content uk-hidden-small">
        @include ('elements.search')
    </div>
    <div class="uk-navbar-content uk-navbar-flip  uk-hidden-small">
        <div class="uk-button-group">
            <a href="" class="uk-icon-button uk-icon-twitter uk-icon-medium"></a>
            <a href="" class="uk-icon-button uk-icon-facebook uk-icon-medium"></a>
        </div>
    </div>
</nav>