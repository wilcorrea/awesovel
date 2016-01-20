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
use Awesovel\Helpers\Parse;
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

        foreach ($route as $i => $r) {
            if (!$r || $r === '.' || $r === '..') {
                unset($route[$i]);
            }
        }

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

        $s = '\\';
        $namespace = implode($s, [AwesovelServiceProvider::$NAMESPACE, 'Src', 'Pages']);

        $input = Input::all();

        $class = implode($s,
            [
                $namespace,
                implode($s, ['Home']) . 'Controller'
            ]);

        $homeController = new $class();

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

                $page = ["page" => $homeController->page($route, $language, $input)];

                return self::auth($route, $page);

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

                $page = ["page" => $homeController->page($route, $language, $input)];

                return self::password($route, $page);

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

                    //return redirect()->guest('auth/login');
                }

                if (isset($route[1]) && isset($route[2])) {

                    $module = $route[1];
                    $entity = $route[2];
                    $operation = isset($route[3]) ? $route[3] : null;
                    $id = isset($route[4]) ? $route[4] : null;

                    $controller = new Controller($module, $entity);

                    return $controller->resolve($operation, $id, $language, $input);
                } else {

                    $page = ["page" => $homeController->page($route, $language, $input)];

                    $page['page']->header = false;

                    return view(awesovel_app('index'), $page);
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

                $page_route = [];
                $parameters = [];

                $broken = false;

                foreach ($route as $r) {

                    if (!$broken && $r === awesovel_config('breaker')) {
                        $broken = true;
                    }

                    if (!$broken) {

                        $page_route[] = $r;
                    } else if ($r !== awesovel_config('breaker')) {

                        $parameters[] = $r;
                    }
                }

                $page_path = [];
                foreach ($page_route as $p) {

                    $page_path[] = Parse::camelize($p, true);
                }


                $class = implode($s,
                    [
                        $namespace,
                        implode($s, $page_path) . 'Controller'
                    ]);

                $page_data = ["page" => (object)["header" => true]];

                if (class_exists($class)) {

                    $controller = new $class();

                    $page_data = ["page" => $controller->page($route, $language, $input, $parameters)];
                }

                return view(awesovel_page($page_route), $page_data);
                break;
        }

    }

    /**
     *
     * @param $route
     * @param $page
     *
     * @return \Illuminate\View\View
     */
    public static function auth($route, $page)
    {

        $service = isset($route[0]) ? $route[0] : '';

        switch ($service) {

            case 'register':

                return view(awesovel_template('auth.register'), $page);
                break;

            case 'login':

                return view(awesovel_template('auth.login'), $page);
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
     * @param $page
     *
     * @return \Illuminate\View\View
     */
    public static function password($route, $page)
    {

        $service = isset($route[0]) ? $route[0] : '';

        switch ($service) {

            case 'email':

                return view(awesovel_template('auth.password'), $page);
                break;

            case 'reset':

                $token = isset($route[1]) ? $route[1] : null;

                return view(awesovel_template('auth.reset'), $page)->with('token', $token);
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
    public static function render($filename)
    {

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