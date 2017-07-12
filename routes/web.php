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

    Route::group([
        'namespace' => 'Admin\\',
        'as' => 'admin.',
        'middleware' => 'auth'
    ], function(){
        Route::name('dashboard')->get('/dashboard', function () {
            return "Estou no dashboard";
        });
        Route::resource('users','UsersController');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
