<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 20/01/16
 * Time: 11:59
 */

namespace Awesovel\Controllers;

use Awesovel\Defaults\Controller;
use Awesovel\Helpers\Path;
use Awesovel\Providers\AwesovelServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AwesovelPostController
{

    /**
     * @param $path
     * @return \Illuminate\Http\Response
     */
    public static function route($path)
    {

        $route = explode('/', $path);

        $root = $route[0];

        switch ($root) {
            /*
            |--------------------------------------------------------------------------
            | Api Requests
            |--------------------------------------------------------------------------
            |
            | create, read, update, delete (, etc...)
            |
            | That requests are parsed to control the assets
            | All requests need pass here
            |
            */
            case awesovel_config('api'):

                array_shift($route);

                if (count($route) >= 3) {

                    $data = Input::all();

                    $version = $route[0];
                    $module = $route[1];
                    $entity = $route[2];
                    $operation = $route[3];
                    $relationships = isset($route[4]) ? $route[4] : null;

                    $path = Path::name($module, $entity, 'Controller');

                    if (class_exists($path)) {

                        $controller = new $path($module, $entity);
                    } else {

                        $controller = new Controller($module, $entity);
                    }

                    return $controller->api($version, $operation, $data, $relationships);
                }
                break;
            /*
            |--------------------------------------------------------------------------
            | Auth Requests
            |--------------------------------------------------------------------------
            |
            | login, logout, register
            |
            */
            case 'auth':


                break;
            /*
            |--------------------------------------------------------------------------
            | Password Requests
            |--------------------------------------------------------------------------
            |
            | index, create, show, edit
            |
            | {language}/app/{module}/{entity}/{operation?}/{id?}
            | All requests need pass here
            |
            */
            case 'password':


                break;
        }
    }
}