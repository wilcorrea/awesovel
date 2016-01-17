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