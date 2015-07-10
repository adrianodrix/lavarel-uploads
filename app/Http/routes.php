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

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/',         ['as'=>'home',           'uses'=>'FileUploadController@index']);
    Route::get('usuario/{userId}/remove/{fileId}',   ['as'=>'files.destroy',  'uses'=>'FileUploadController@destroy']);
    Route::get('usuario/{userId}/download/{fileId}', ['as'=>'files.download', 'uses'=>'FileUploadController@download']);
    Route::post('/upload',  ['as' => 'files.upload', 'uses'=>'FileUploadController@upload']);
});
