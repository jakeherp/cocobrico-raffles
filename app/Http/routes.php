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
    Route::get('/', 'UserController@showEmailForm');

    Route::get('identify', function () { return redirect('/'); });
    Route::post('identify', 'UserController@identify');

    Route::get('register', function () { return redirect('/'); });
    Route::get('register/{token}', 'UserController@showRegisterForm');
    Route::put('register', 'UserController@register');

    Route::post('login', 'UserController@login');
    Route::get('login', 'UserController@showLoginForm'); 

    Route::get('logout', 'UserController@logout');

    Route::get('dashboard', 'PagesController@dashboard');

    // Admin Routes
        Route::get('admin', 'AdminController@dashboard');
});
