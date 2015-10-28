<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
//   ログインさせる。
	if (Auth::check())
	{
		Session::put('user.id', Auth::user()->id);
		Session::put('user.username', Auth::user()->username);
	}else{
		$user_login = false;
		echo "ログインしていません";
	}

	//ユーザーエージェントの確認
	$ua = Request::server('HTTP_USER_AGENT');
	Log::info($ua);
	if ((strpos($ua, 'Android') !== false) &&
		(strpos($ua, 'Mobile') !== false) ||
		(strpos($ua, 'iPhone') !== false) ||
		(strpos($ua, 'Windows Phone') !== false)) {
		// スマートフォンからアクセスされた場合
		Session::put('layout','smart_phone');
	} elseif ((strpos($ua, 'Android') !== false) ||
		(strpos($ua, 'iPad') !== false)) {
		// タブレットからアクセスされた場合
		Session::put('layout','tablet');
	} elseif ((strpos($ua, 'DoCoMo') !== false) ||
		(strpos($ua, 'KDDI') !== false) ||
		(strpos($ua, 'SoftBank') !== false) ||
		(strpos($ua, 'Vodafone') !== false) ||
		(strpos($ua, 'J-PHONE') !== false)) {
		// 携帯からアクセスされた場合
		Session::put('layout','future_phone');
	} else {
		// その他（PC）からアクセスされた場合
		Session::put('layout','default');
	}

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/


Route::filter('auth', function()
{
	if( Auth::guest() )
	{
		return Redirect::guest( 'login' )
			->withMessage( 'ログインしてください。' );
	}
} );

//Route::filter('auth', function()
//{
//	if (Auth::guest())
//	{
//		if (Request::ajax())
//		{
//			return Response::make('Unauthorized', 401);
//		}
//		else
//		{
//			return Redirect::guest('login');
//		}
//	}
//});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('api',function(){
	 $user = User::where('api_token', Request::header(static::APPLICATION_TOKEN))->first();
        if (is_null($user)) {
            return Response::json(['message' => '401 Unauthorized'], 401);
        }

        app()[static::AUTHORIZED_USER] = $user;
});

// ユーザーエージェントの確認
Route::filter('user-agent',function()
{
	
})

;
Route::filter( 'admin', function()
{
	if( Auth::guest() || Auth::user()->role < 100 )
	{
		return Redirect::guest( 'login' )
			->withMessage( '管理者の権限がありません。' );
	}
} );

