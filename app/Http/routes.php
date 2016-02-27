<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'PagesController@index');

    Route::get('identify', function () { return redirect('/'); });
    Route::post('identify', 'UserController@identify');

    Route::get('register', function () { return redirect('/'); });
    Route::get('register/{token}', 'UserController@showRegisterForm');
    Route::put('register', 'UserController@register');

    Route::post('login', 'UserController@login');
    Route::get('login', 'UserController@showLoginForm'); 

    Route::get('logout', 'UserController@logout');

    Route::get('dashboard', 'PagesController@dashboard');
    Route::post('dashboard', 'RafflesController@participate');
    Route::get('settings', 'PagesController@settings');
    Route::put('settings', 'UserController@edit');

    // Admin Routes
        Route::get('admin', 'AdminController@dashboard');
        Route::get('admin/raffles', 'AdminController@showRafflesView');
        Route::get('admin/raffles/create', 'AdminController@createRafflesView');
        Route::post('admin/raffles/create', 'RafflesController@create');
        Route::post('admin/raffles/delete', 'RafflesController@delete');
        Route::put('admin/raffles', 'RafflesController@edit');
        Route::get('admin/users', 'AdminController@users');
});
