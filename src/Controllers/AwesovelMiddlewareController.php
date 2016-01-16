<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 16/01/16
 * Time: 15:48
 */

namespace Awesovel\Controllers;


use Awesovel\Controllers\AwesovelRequestController;

class AwesovelMiddlewareController
{

    /**
     * @param $path
     * @return \Illuminate\Http\Response
     */
    public static function route($path) {

        $route = explode('/', $path);

        $root = $route[0];

        array_shift($route);

        switch ($root) {
            case config('awesovel')['static']:

                return AwesovelRequestController::stt($route);
                break;
            default:
                return view('awesovel.templates.portal.layouts.index', ["page"=>(object)['header'=>true]]);
                break;
        }
    }

}