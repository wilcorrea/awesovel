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
// Interpunct: ·

Route::get('/api/{version}/{module}/{entity}/{operation}/{id?}/{relationships?}', function($version, $module, $entity, $operation, $id = null, $relationships = null) {

  $path = \Awesovel\Helpers\AwesovelPath::name($module, $entity);

  $class = new $path();

  if (is_null($id)) {

    $request = $class::$operation();
  } else {

    $request = $class::$operation($id);
  }

  if ($relationships) {

    if (is_array($request)) {
      $request = $request[0];
    }

    $relationships = explode(',', $relationships);
    foreach ($relationships as $relationship) {
      $request->$relationship = $request->$relationship;
    }
  }

  if ($version === 'debug') {

    dd(json_decode(json_encode($request)));
  } else {

    return $request;
  }
});
