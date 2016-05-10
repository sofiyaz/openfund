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

Route::group(['middleware' => ['web']], function () {

    // Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    // Facebook authentication routes...
    Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

    // Project routes...
    Route::post('search', 'ProjectController@search');
    Route::get('view-project/{id}', 'ProjectController@view');

    // Routes that need users to be signed in...
    Route::group(['middleware' => ['auth']], function () {
        // Payment routes...
        Route::get('/payment-successful/{id}', 'PaymentController@success');
        Route::get('{id}/pay', 'PaymentController@pay');
        Route::post('{id}/pay', 'PaymentController@pay');

        // Project routes...
        Route::get('projects', 'ProjectController@index');
        Route::get('create', 'ProjectController@create');
        Route::post('create', 'ProjectController@create');
        Route::get('edit-project/{id}', 'ProjectController@edit');
        Route::get('delete-project', 'ProjectController@deleteProject');

        // Dashboard routes
        Route::get('dashboard', 'DashboardController@index');
        Route::get('dashboard/messages', 'DashboardController@messages');
        Route::get('dashboard/notifications', 'DashboardController@notifications');

        // User routes
        Route::get('profile', 'UserController@profile');
    });

    Route::get('/', 'ProjectController@index');
    Route::get('/{category}/projects/', 'ProjectController@index');

    // Sandbox routes
    Route::get('module/project', 'SandboxController@projectModule');
});