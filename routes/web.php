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

Route::prefix('admin')->group(function(){
    Auth::routes();

    Route::group(['prefix' => 'users', 'as' => 'admin.users.'], function(){
        Route::name('settings.edit')->get('settings','Admin\UserSettingsController@edit');
        Route::name('settings.update')->put('settings','Admin\UserSettingsController@update');
    });

    Route::group([
        'namespace' => 'Admin\\',
        'as' => 'admin.',
        'middleware' => ['auth','can:admin']
    ], function(){
        Route::name('dashboard')->get('/dashboard', function () {
            return "Estou no dashboard";
        });
        Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
            Route::name('show_details')->get('show_details','UsersController@showDetails');
            Route::group(['prefix' => '/{user}/profile'], function(){
                Route::name('profile.edit')->get('','UserProfileController@edit');
                Route::name('profile.update')->put('','UserProfileController@update');
            });
        });
        Route::resource('users','UsersController');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
