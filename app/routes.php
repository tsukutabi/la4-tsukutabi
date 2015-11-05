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


Route::get('save','ArticleController@get_save');
Route::post('save','ArticleController@post_save');
Route::get('find','ArticleController@find');
Route::get('view/{id}','ArticleController@view');
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
	return View::make('Articles.contact');
});
Route::post('contact','Articles@contact');

//自作のユーザー系

Route::get('user/login',function(){
	return View::make('users.login');
});
Route::post('user/login','UsersController@login');
Route::get('user/add',function(){
	return View::make('users.add');
});

Route::post('user/add','UsersController@add');
Route::get('user/{id}','UserController@view');


Route::when( 'admin/*', 'admin' );
Route::when( 'dashboard/*', 'auth' );
Route::pattern('id', '[0-9]+');

Route::get( 'register',
	['as' => 'register-form', 'uses' => 'UserController@showRegisterForm' ] );
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