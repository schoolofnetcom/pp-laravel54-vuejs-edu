<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'as' => 'api.',
    'namespace' => 'Api\\'
], function () {
    Route::post('/access_token', 'AuthController@accessToken');


    Route::group(['middleware' => 'auth.renew'], function () {
        Route::get('/user', function (Request $request) {
            return \Auth::user();
        });

        Route::group([
            'prefix' => 'teacher',
            'as' => 'teacher.',
            'namespace' => 'Teacher\\',
            'middleware' => 'can:teacher'
        ], function () { //GET /class_teaching/1/class_tests/1
            Route::group(['prefix' => 'class_teachings/{class_teaching}', 'as' => 'class_teachings.'], function () {
                Route::resource('class_tests', 'ClassTestsController', ['except' => ['create', 'edit']]);
            });
            Route::resource('class_informations', 'ClassInformationsController', ['only' => ['index', 'show']]);
            Route::resource('class_teachings', 'ClassTeachingsController', ['only' => ['index', 'show']]);
        });

        Route::group([
            'prefix' => 'student',
            'as' => 'student.',
            'namespace' => 'Student\\',
            'middleware' => 'can:student'
        ], function () {
            Route::group(['prefix' => 'class_informations/{class_information}', 'as' => 'class_informations.'], function(){
                Route::resource('class_teachings', 'ClassTeachingsController', ['only' => ['index', 'show']]);
            });
            Route::group(['prefix' => 'class_teachings/{class_teaching}', 'as' => 'class_teachings.'], function () {
                Route::resource('class_tests', 'ClassTestsController', ['only' => ['index', 'show']]);
            });
            Route::group(['prefix' => 'class_tests', 'as' => 'class_tests.'], function () {
                Route::group(['prefix' => '{class_test}'], function(){
                    Route::resource('do', 'StudentClassTestsController', ['only' => ['show','store']]);
                });
                Route::group(['prefix' => 'results'], function(){ //class_tests/results/per_subject
                    Route::get('per_subject', 'ClassTestResultsController@perSubject');
                });
            });
            Route::resource('class_informations', 'ClassInformationsController', ['only' => ['index', 'show']]);
        });
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', 'AuthController@logout');
    });
});