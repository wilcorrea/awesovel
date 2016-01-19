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

$namespace = \Awesovel\Providers\AwesovelServiceProvider::$NAMESPACE;

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
  | Middleware to parse url
  |--------------------------------------------------------------------------
  |
  | That requests are parsed to control the assets
  | All requests need pass here
  |
 */
Route::get('{slug?}', function ($slug = 'home') {


    return \Awesovel\Controllers\AwesovelGetController::route($slug);

})->where('slug', '.+');