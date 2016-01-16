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
  |  Api allows
  |
 */
// Interpunct in version: ·

Route::get('/' . config('awesovel')['api'] . '/{version}/{module}/{entity}/{operation}/{id?}/{relationships?}', function ($version, $module, $entity, $operation, $id = null, $relationships = null) {

    $controller = new \Awesovel\Defaults\Controller($module, $entity);

    return $controller->api(
        $version,
        $operation,
        $id,
        $relationships
    );
});

/*
 * Resources
 */
//list, add, view, set
//index, create, show, edit
Route::get('/' . config('awesovel')['app'] . '/{language}/{module}/{entity}/{operation?}/{id?}', function ($language, $module, $entity, $operation = null, $id = null) {

    $controller = new \Awesovel\Defaults\Controller($module, $entity);

    return $controller->resolve($operation, $id, $language, (Input::all()));
});


/**
 * Otherwise
 */
Route::get('{slug?}', function ($slug = 'home') {

    return \Awesovel\Controllers\AwesovelMiddlewareController::route($slug);

})->where('slug', '.+');