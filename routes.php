<?php

/*
  |--------------------------------------------------------------------------
  | Api Resources
  |--------------------------------------------------------------------------
  |
  | That requests are parsed to control the assets
  | All requests need pass here
  |
 */

use \Awesovel\Controllers\AwesovelGetController;
use \Awesovel\Controllers\AwesovelPostController;
use \Awesovel\Providers\AwesovelServiceProvider;

$namespace = AwesovelServiceProvider::$NAMESPACE;

// Authentication routes...
Route::post('auth/login', $namespace .'\Http\Controllers\Auth\AuthController@postLogin');

// Registration routes...
Route::post('auth/register', $namespace .'\Http\Controllers\Auth\AuthController@postRegister');

// Password reset link request routes...
Route::post('password/email', $namespace .'\Http\Controllers\Auth\PasswordController@postEmail');

// Password reset routes...
Route::post('password/reset', $namespace .'\Http\Controllers\Auth\PasswordController@postReset');


//Route::get('/' . awesovel_config('api') . '/{version}/{module}/{entity}/{operation}/{id?}/{relationships?}', function ($version, $module, $entity, $operation, $id = null, $relationships = null) {
//
//    $controller = new \Awesovel\Defaults\Controller($module, $entity);
//
//    return $controller->api($version, $operation, $id, $relationships);
//});

/*
  |--------------------------------------------------------------------------
  | Middleware to parse GET requests
  |--------------------------------------------------------------------------
  |
  | That requests are parsed to control the assets
  | All requests need pass here
  |
 */

Route::get('{path?}', function ($path = 'home') {


    return AwesovelGetController::route($path);

})->where('path', '.+');

/*
  |--------------------------------------------------------------------------
  | Middleware to parse POST requests
  |--------------------------------------------------------------------------
  |
  | That requests are parsed to control the assets
  | All requests need pass here
  |
 */
Route::post('{path?}', function ($path = null) {


    return AwesovelPostController::route($path);

})->where('path', '.+');