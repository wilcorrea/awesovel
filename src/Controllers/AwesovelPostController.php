<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 20/01/16
 * Time: 11:59
 */

namespace Awesovel\Controllers;

use Awesovel\Controllers\AwesovelRequestController;
use Awesovel\Defaults\Controller;
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
            | That requests are parsed to control the assets
            | All requests need pass here
            |
            */
            case awesovel_config('api'):

                //$controller = new \Awesovel\Defaults\Controller($module, $entity);

                //return $controller->api($version, $operation, $id, $relationships);
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
            /*
            |--------------------------------------------------------------------------
            | App Requests
            |--------------------------------------------------------------------------
            |
            | create, read, update, delete
            |
            | {language}/app/{module}/{entity}/{operation?}/{id?}
            | All requests need pass here
            |
            */
            case awesovel_config('app'):

                if (!Auth::check()) {

                    return redirect()->guest('auth/login');
                }

                return var_dump(Input::all());

                return view(awesovel_app('index'), ["page" => (object)['header' => false]]);

                break;
        }
    }
}