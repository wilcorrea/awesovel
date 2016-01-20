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
use Awesovel\Helpers\File;
use Awesovel\Helpers\Path;
use Awesovel\Providers\AwesovelServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AwesovelGetController
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
            | Static Requests
            |--------------------------------------------------------------------------
            |
            | That requests are parsed to control the assets
            | All requests need pass here
            |
            */
            case awesovel_config('static'):

                array_shift($route);

                return self::resources($route);
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

                if (count(awesovel_config('languages')) > 1) {
                    $use_language = true;
                }

                $language = AwesovelServiceProvider::$LANGUAGE;

                if ($use_language) {

                    $language = array_shift($route);
                }

                AwesovelServiceProvider::$LANGUAGE = $language;

                return self::standard($language, $route);
                break;
        }
    }

    /**
     * @param $language
     * @param $route
     *
     * @return \Illuminate\Http\View
     */
    public static function standard($language, $route = null)
    {

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
            case awesovel_config('app'):

                if (!Auth::check()) {

                    return redirect()->guest('auth/login');
                }

                if (isset($route[1]) && isset($route[2])) {

                    $module = $route[1];
                    $entity = $route[2];
                    $operation = isset($route[3]) ? $route[3] : null;
                    $id = isset($route[4]) ? $route[4] : null;

                    return (new Controller($module, $entity))->resolve($operation, $id, $language, (Input::all()));
                } else {

                    return view(awesovel_app('index'), ["page" => (object)['header' => false]]);
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

                return view(awesovel_template('index'), ["page" => (object)['header' => true]]);
                break;
        }

    }

    /**
     *
     * @param $route
     *
     * @return \Illuminate\View\View
     */
    public static function auth($route)
    {

        $service = isset($route[0]) ? $route[0] : '';

        switch ($service) {

            case 'register':

                return view(awesovel_template('auth.register'), ["page" => (object)['header' => true]]);
                break;

            case 'login':

                return view(awesovel_template('auth.login'), ["page" => (object)['header' => true]]);
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
    public static function password($route)
    {

        $service = isset($route[0]) ? $route[0] : '';

        switch ($service) {

            case 'email':

                return view(awesovel_template('auth.password'), ["page" => (object)['header' => true]]);
                break;

            case 'reset':

                $token = isset($route[1]) ? $route[1] : null;

                return view(awesovel_template('auth.reset'), ["page" => (object)['header' => true]])->with('token', $token);
                break;
        }
    }

    /**
     * Parse static requests
     *
     * @param $route
     * @return Response
     */
    public static function resources($route)
    {

        $filename = "";

        $root = isset($route[0]) ? $route[0] : null;

        switch ($root) {
            case 'assets':

                array_shift($route);

                $filename = Path::assets($route);
                break;
        }

        if (File::exists($filename)) {

            return self::render($filename);
        }
    }

    /**
     * Load file by extension
     *
     * @param $filename
     * @return Response
     */
    public static function render($filename) {

        $type = mime_content_type($filename);

        $extension = File::extension($filename);
        switch ($extension) {

            case 'css':

                $type = "text/css";
                break;

            case 'js':

                $type = "application/javascript";
                break;
        }

        return (new Response(File::get($filename), '200'))->header('Content-Type', $type);
    }

}