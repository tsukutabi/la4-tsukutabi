<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get( '/', [ 'as' => 'home', 'uses' => 'ArticleController@index' ] );
Route::when('*','csrf',['post','put']);

Route::any(
		"/test"
		,function (){
    Log::debug(Input::all());
    Log::info($_GET);
    }
);

//ユーザー認証

Route::get('save','ArticleController@get_save');
Route::post('save','ArticleController@post_save');
//View::make('users.login')->with('title','ログイン画面');

Route::get('find','ArticleController@find');
Route::get('view/{id}','ArticleController@view');

Route::get('count/{id}','ArticleController@count_view');

Route::get('tags','ArticleController@tags_json');

Route::put('edit/{id}','ArticleController@edit');
Route::get('edit/{id}','ArticleController@get_edit');

Route::post('comment','CommentController@post');
Route::put('edit_comment/{id}','CommentController@edit');
Route::post('delete_comment/{id}','CommentController@delete');
Route::post('spam_comment/{id}','CommentController@spam');

Route::post('fav','FavController@post');

Route::get('error',['as'=>'error'],function(){
	echo 'hello error';
});

Route::get('contact',function(){
	return View::make('Articles.contact')->with('title','TOP画面');;
});
Route::post('contact','Articles@contact');

//自作のユーザー系
Route::get('user/login',function(){
	return View::make('users.login')->with('title','TOP画面');;
});
Route::post('user/login','UsersController@login');

Route::get('user/add',function(){
	return View::make('users.add')->with('title','TOP画面');
});

Route::post('user/add','UsersController@add');
Route::get('user/{id}','UserController@view');
//プロフィール編集する時の処理
Route::post('user/profile','UserController@change_profile');
Route::post('user/change_face_photo','UserController@change_face_photo');




Route::when( 'admin', 'admin' );

Route::get( 'register',function(){
    return View::make('auth.register')->with('title','つくたび会員登録');
});
Route::post( 'register',
	['as' => 'handle-register', 'uses' => 'UserController@handleRegister' ] );
Route::get( 'confirm',
	['as' => 'confirm-form', 'uses' => 'UserController@showConfirmForm' ] );
Route::post( 'confirm',
	['as' => 'handle-confirm', 'uses' => 'UserController@handleConfirm' ] );
Route::get( 'login', ['as' => 'login-form', 'uses' => 'UserController@showLoginForm' ] );
Route::post( 'login', ['as' => 'handle-login', 'uses' => 'UserController@handleLogin' ] );
Route::get( 'logout', ['as' => 'logout', 'uses' => 'UserController@handleLogout' ] );

Route::get( 'remainder',
	['as' => 'reminder-form', 'uses' => 'RemindersController@showReminderForm' ] );
Route::post( 'remainder',
	['as' => 'handle-reminder', 'uses' => 'RemindersController@handleReminder' ] );
Route::get( 'reset/{token}',
	['as' => 'reset-form', 'uses' => 'RemindersController@showResetForm' ] );
Route::post( 'reset/{token}',
	['as' => 'handle-reset', 'uses' => 'RemindersController@handleReset' ] );

//sapi系だよ〜〜
Route::get('api/ping',function(){
    return Response::json('ping');
});

//記事系
Route::get('api/index','ArticleController@api_index');
Route::get('api/view/{id}','ArticleController@api_index');
Route::post('api/post','ArticleController@api_save');
Route::put('api/put{id}','ArticleController@api_edit');
Route::delete('api/delete{id}','ArticlesController@api_delete');

//ユーザー編集系


// //api用のルーティング
// $apiPrefix = '/api';
// Route::get($apiPrefix . '/ping', function () {
// 	return Response::json('pong');
// });
// // Route::filter('api_auth', '');
// //記事表示用
// Route::group(function () use ($apiPrefix) {
//     $controller = 'ArticlesController';
// //    記事表示用
//     Route::post($apiPrefix.'/post',$controller.'@post_save');
// 	Route::get($apiPrefix . '/index',$controller .'@index');
//     Route::get($apiPrefix.'/view/{id}',$controller .'@view');
// 	Route::put($apiPrefix . '/edit/{id}', $controller . '@update');
// 	Route::delete($apiPrefix . '/delete/{id}', $controller . '@delete');
// //    ユーザー系
//     Route::post($apiPrefix.'/post',$controller .'@post_save');
//     Route::post($apiPrefix.'/post',$controller .'@post_save');
// });
// //ユーザー表示用