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

// Authentication routes...
//Route::get('auth/login', 'CodeDelivery\Http\Controllers\Auth\AuthController@getLogin');
Route::post('auth/login', 'CodeDelivery\Http\Controllers\Auth\AuthController@postLogin');
//Route::get('auth/logout', 'CodeDelivery\Http\Controllers\Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'CodeDelivery\Http\Controllers\Auth\AuthController@getRegister');
Route::post('auth/register', 'CodeDelivery\Http\Controllers\Auth\AuthController@postRegister');

// Password reset link request routes...
//Route::get('password/email', 'CodeDelivery\Http\Controllers\Auth\PasswordController@getEmail');
Route::post('password/email', 'CodeDelivery\Http\Controllers\Auth\PasswordController@postEmail');

// Password reset routes...
//Route::get('password/reset/{token}', 'CodeDelivery\Http\Controllers\Auth\PasswordController@getReset');
Route::post('password/reset', 'CodeDelivery\Http\Controllers\Auth\PasswordController@postReset');


Route::get('/' . config('awesovel')['api'] . '/{version}/{module}/{entity}/{operation}/{id?}/{relationships?}', function ($version, $module, $entity, $operation, $id = null, $relationships = null) {

    $controller = new \Awesovel\Defaults\Controller($module, $entity);

    return $controller->api($version, $operation, $id, $relationships);
});

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