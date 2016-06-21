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


Route::group(['middleware' => ['web'/*, 'auth'*/], 'prefix' => 'admin'], function() {
    Route::resource('/preguntas', 'QuestionController');
    Route::get('preguntas/{id}/eliminar',[
        'uses'  =>  'QuestionController@destroy',
        'as'    =>  'admin.question.destroy'
    ]);
});

Route::auth();

Route::get('/home', 'HomeController@index');
