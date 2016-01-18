<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 16/01/16
 * Time: 10:07
 */

namespace Awesovel\Controllers;

use Illuminate\Http\Response;

use Awesovel\Helpers\File;
use Awesovel\Helpers\Path;

class AwesovelRequestController
{

    /**
     * Parse static requests
     *
     * @param $route
     * @return Response
     */
    public static function stt($route)
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