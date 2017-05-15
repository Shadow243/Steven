<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::group(['middleware' => 'auth'], function () {
//    //    Route::get('/link1', function ()    {
////        // Uses Auth Middleware
////    });
//
//    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
//    #adminlte_routes
//});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'PostController@index');
    Route::get('/user/colections', 'PostController@colections');
    Route::get('/online-users', 'BaseController@Onle_ajax_alist_freind');
    Route::get('/home/collectios', 'HomeController@DisplayHome');


    Route::group(['as' => 'profile::', 'prefix' => 'profile'], function(){
        Route::get('/', ['as'=>'index', 'uses' => 'ProfileController@index']);
        Route::post('/user/profile', ['as'=>'store::profil', 'uses' => 'ProfileController@store']);
        Route::put('/user/profile/update_photo_couvert', ['as'=>'cover::update', 'uses' => 'ProfileController@ChangeCover']);
        Route::put('/user/profile/update_photo_profile', ['as'=>'avatar::update', 'uses' => 'ProfileController@ChangeAvatar']);
    });


    Route::group(['as' => 'post::', 'prefix' => 'post'], function(){
        Route::get('/', ['as'=>'index', 'uses' => 'PostController@index']);
        Route::post('/post', ['as'=>'store::post', 'uses' => 'Postcontroller@store']);
        Route::post('/comment/store', ['as'=>'comment::store', 'uses' => 'PostController@storeComment']);
        Route::delete('/comment/destroy/{comment}', ['as'=>'comment::destroy', 'uses' => 'PostController@destroyComment']);
        Route::get('/like/{post_id}', ['as'=>'like', 'uses' => 'PostController@storeLikes']);
    });
    Route::group(['as' => 'Freind::', 'prefix' => 'Freind'], function(){
        Route::get('/', ['as'=>'index', 'uses' => 'FriendController@index']);
        Route::post('/request_accept', ['as'=>'Accept::request', 'uses' => 'FriendController@AcceptFreindRequest']);
        Route::post('/Send_freind_request', ['as'=>'add', 'uses' => 'FriendController@SendFriendRequest']);
        Route::post('/Deny_freind_request', ['as'=>'Deny::freindRequest', 'uses' => 'FriendController@DenignedFriendRequest']);

    });

    Route::group(['as' => 'Message::', 'prefix' => 'Message'], function(){
        Route::get('/', ['as'=>'index', 'uses' => 'MessageController@DisplayMessagePage']);

    });
    Route::group(['as' => 'About::', 'prefix' => 'About'], function(){
        Route::get('/', ['as'=>'index', 'uses' => 'ProfileController@DisplayAboutPage']);

    });
});
