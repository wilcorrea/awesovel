<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 16/01/16
 * Time: 10:19
 */

namespace Awesovel\Helpers;


class File
{

    /**
     * @param $filename
     * @return bool
     */
    public static function exists($filename) {

        return file_exists($filename);
    }

    /**
     * @param string $filename
     * @param string $suffix
     * @return string
     */
    public static function name($filename, $suffix = null) {

        return basename($filename, $suffix);
    }

    /**
     * @param $filename
     * @return string
     */
    public static function extension($filename) {

        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    /**
     * @param $filename
     * @return string
     */
    public static function get($filename) {

        return file_get_contents($filename);
    }
}