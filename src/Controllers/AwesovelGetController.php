<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 16/01/16
 * Time: 15:48
 */

namespace Awesovel\Controllers;


use Awesovel\Controllers\AwesovelRequestController;
use Awesovel\Defaults\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AwesovelGetController
{

    /**
     * @param $path
     * @return \Illuminate\Http\Response
     */
    public static function route($path) {

        $route = explode('/', $path);

        $root = $route[0];

        switch ($root) {
            /*
            |--------------------------------------------------------------------------
            | Static Requests
            |--------------------------------------------------------------------------
            |
            | That requests are parsed to control the assets
            | All requests need pass here
            |
            */
            case config('awesovel')['static']:

                array_shift($route);

                return AwesovelRequestController::stt($route);
                break;
            /*
            |--------------------------------------------------------------------------
            | Api Requests
            |--------------------------------------------------------------------------
            |
            | That requests are parsed to control the assets
            | All requests need pass here
            |
            */
            case config('awesovel')['api']:

                //return AwesovelRequestController::stt($route);
                break;
            /*
            |--------------------------------------------------------------------------
            | App Requests && CMS Requests
            |--------------------------------------------------------------------------
            |
            | Resolve about page requests between App and CMS Requests
            |
            */
            default:

                $use_language = false;

                if (is_array(config('awesovel')['languages'])) {

                    if (count(config('awesovel')['languages']) > 1) {

                        $use_language = true;
                    }
                }

                $language = config('awesovel')['language'];

                if ($use_language) {

                    $language = array_shift($route);
                }

                return self::request($language, $route);
                break;
        }
    }

    /**
     * @param $language
     * @param $route
     *
     * @return \Illuminate\Http\View
     */
    public static function request($language, $route = null) {

        $service = isset($route[0]) ? $route[0] : '';

        switch ($service) {
            /*
            |--------------------------------------------------------------------------
            | Auth Requests
            |--------------------------------------------------------------------------
            |
            | login, logout, register
            |
            */
            case 'auth':

                array_shift($route);

                return self::auth($route);

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

                array_shift($route);

                return self::password($route);

                break;
            /*
            |--------------------------------------------------------------------------
            | App Requests
            |--------------------------------------------------------------------------
            |
            | index, create, show, edit
            |
            | {language}/app/{module}/{entity}/{operation?}/{id?}
            | All requests need pass here
            |
            */
            case config('awesovel')['app']:

                if (isset($route[1]) && isset($route[2])) {

                    $module = $route[1];
                    $entity = $route[2];
                    $operation = isset($route[3]) ? $route[3] : null;
                    $id = isset($route[4]) ? $route[4] : null;

                    return (new Controller($module, $entity))->resolve($operation, $id, $language, (Input::all()));
                } else {

                    return view(awesovel_app('index'), ["page"=>(object)['header'=>false]]);
                }
                break;
            /*
            |--------------------------------------------------------------------------
            | CMS Requests
            |--------------------------------------------------------------------------
            |
            | Parse url to display the pages based on template theme
            |
            */
            default:

                return view(awesovel_template('index'), ["page"=>(object)['header'=>true]]);
                break;
        }

    }

    /**
     *
     * @param $route
     *
     * @return \Illuminate\View\View
     */
    public static function auth($route) {

        $service = isset($route[0]) ? $route[0] : '';

        switch($service) {

            case 'register':

                return view(awesovel_template('auth.register'));
                break;

            case 'login':

                return view(awesovel_template('auth.login'));
                break;

            case 'logout':

                Auth::logout();

                return redirect('/');

                break;
        }
    }

    /**
     *
     * @param $route
     *
     * @return \Illuminate\View\View
     */
    public static function password($route) {

        $service = isset($route[0]) ? $route[0] : '';

        switch($service) {

            case 'email':

                return view(awesovel_template('auth.password'));
                break;

            case 'reset':

                $token = isset($route[1]) ? $route[1] : null;

                return view(awesovel_template('auth.reset'))->with('token', $token);
                break;
        }
    }

}