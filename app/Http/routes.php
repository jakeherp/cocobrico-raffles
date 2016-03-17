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

    Route::get('email', function () { return redirect('/'); });
    Route::post('email', 'UserController@resendEmail');

    Route::get('register', function () { return redirect('/'); });
    Route::get('register/{token}', 'UserController@showRegisterForm');
    Route::put('register', 'UserController@register');

    Route::post('password', 'UserController@showPasswordMsg'); 
    Route::get('password/{token}', 'UserController@showPasswordForm');
    Route::put('password', 'UserController@savePasswordChange');

    Route::post('login', 'UserController@login');
    Route::get('login', 'UserController@showLoginForm'); 

    Route::get('logout', 'UserController@logout');

    Route::get('dashboard', 'PagesController@dashboard');
    Route::post('dashboard', 'RafflesController@participate');
    Route::post('dashboard/confirm', 'RafflesController@confirmUserCode');
    Route::get('settings', 'PagesController@settings');
    Route::put('settings', 'UserController@edit');
    Route::put('settings/image', 'UserController@image');
    Route::put('settings/password', 'UserController@savePasswordChange');

    Route::get('impressum', 'PagesController@impressum');

    // Admin Routes
        Route::get('admin', 'AdminController@showRafflesView');
        Route::get('admin/changelog', 'AdminController@showChangelog');
        Route::get('admin/codes', 'AdminController@showCodesView');
        Route::post('admin/codes/create', 'CodesController@create');
        Route::put('admin/codes/deactivate', 'CodesController@deactivate');
        Route::put('admin/codes/deactivateAction', 'CodesController@deactivateAction');
        Route::get('admin/codes/{id}', 'AdminController@detailCodesView');
        Route::get('admin/codes/{id}/create', 'AdminController@createCodesView');
        Route::get('admin/codes/{id}/print', 'CodesController@printCodes');
        
        Route::get('admin/emails', 'AdminController@showEmailsView');
        Route::put('admin/emails', 'EmailsController@edit');
        Route::get('admin/emails/create', 'AdminController@createEmailView');
        Route::post('admin/emails/create', 'EmailsController@create');
        Route::post('admin/emails/delete', 'EmailsController@delete');
        Route::post('admin/emails/pdf', 'EmailsController@pdf');
        Route::get('admin/emails/{id}/preview', 'EmailsController@preview');
        Route::get('admin/emails/{id}/edit', 'AdminController@editEmailView');
        Route::get('admin/emails/{id}/pdf', 'AdminController@emailPdfView');

        Route::get('admin/pdf', 'AdminController@showConfirmationsView');
        Route::put('admin/pdf', 'ConfirmationsController@edit');
        Route::get('admin/pdf/create', 'AdminController@createPdfView');
        Route::post('admin/pdf/create', 'ConfirmationsController@create');
        Route::post('admin/pdf/delete', 'ConfirmationsController@delete');
        Route::get('admin/pdf/{id}', 'AdminController@pdfDetail');
        Route::get('admin/pdf/{id}/preview', 'ConfirmationsController@preview');
        Route::get('admin/pdf/{id}/edit', 'AdminController@editPdfView');

        Route::get('admin/raffles', 'AdminController@showRafflesView');
        Route::put('admin/raffles/confirm', 'RafflesController@confirmUser');
        Route::get('admin/raffles/create', 'AdminController@createRafflesView');
        Route::post('admin/raffles/create', 'RafflesController@create');
        Route::post('admin/raffles/delete', 'RafflesController@delete');
        Route::post('admin/raffles/emails', 'RafflesController@emails');
        Route::put('admin/raffles', 'RafflesController@edit');
        Route::get('admin/raffles/{id}', 'AdminController@raffleDetail');
        Route::get('admin/raffles/{id}/edit', 'AdminController@editRaffleView');
        Route::get('admin/raffles/{id}/pdf', 'AdminController@pdfPreview');
        Route::get('admin/raffles/{id}/emails', 'AdminController@raffleEmailsView');
        Route::put('admin/raffles/save', 'RafflesController@edit');
        
        Route::get('admin/users', 'AdminController@users');
        Route::post('admin/users/delete', 'UserController@delete');
        Route::get('admin/users/{id}', 'AdminController@userDetail');
});
