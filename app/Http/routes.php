<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', ['uses'=>'HomeController@index', 'as'=>'home_page']);
    Route::post('/home', ['uses'=>'HomeController@setUserType']);
    Route::get('/dashboard', ['uses'=>'HomeController@dashboard', 'as'=>'dashboard']);
    Route::get('/settings', ['uses'=>'HomeController@settings', 'as'=>'settings']);
    Route::get('/registration/part-1', ['uses'=>'RegistrationController@register1Get', 'as'=>'register_get1']);
    Route::post('/registration/part-1', ['uses'=>'RegistrationController@register1Post']);
    Route::get('/registration/part-2', ['uses'=>'RegistrationController@register2Get', 'as'=>'register_get2']);
    Route::post('/registration/part-2',['uses'=>'RegistrationController@register2Post']);
    Route::get('/registration/payment', ['uses'=>'RegistrationController@paymentGet', 'as'=>'paymentGet']);
    Route::post('/registration/payment',['uses'=>'RegistrationController@paymentPost']);
});
