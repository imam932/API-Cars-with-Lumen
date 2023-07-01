<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group([
    'prefix' => 'api'
], function () {
    // Route Auth
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh/{token}', 'AuthController@refresh');
    });

    // Route User
    Route::group([
        'prefix' => 'users',
    ], function () {
        Route::post('register', 'UserController@register');
        Route::get('profile', 'UserController@profile');

    });

    // Route Car
    Route::group([
        'prefix' => 'cars',
        'middleware' => 'auth'
    ], function () {
        Route::post('/create', 'CarController@create');
        Route::post('/add-image', 'CarController@add_image');
        Route::get('/', 'CarController@index');
        Route::put('/update/{id}', 'CarController@update');
        Route::delete('/delete/{id}', 'CarController@destroy');

    });

});
