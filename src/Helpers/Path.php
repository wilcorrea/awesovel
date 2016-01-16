<?php

namespace Awesovel\Helpers;

use Awesovel\Providers\AwesovelServiceProvider;

class Path
{

    /**
     *
     * @param string $module
     * @param string $entity
     * @param string $layer
     *
     * @return string
     */
    public static function name($module, $entity, $layer = null)
    {

        if (is_null($layer)) {
            $layer = 'Model';
        }

        return AwesovelServiceProvider::$NAMESPACE . '\\Src\\' . $module . '\\' . $layer . '\\' . $entity;
    }

    /**
     *
     * @param path $root
     * @param array $pieces
     *
     * @return string
     */
    private static function _path($root, $pieces)
    {

        return $root . DIRECTORY_SEPARATOR . join(DIRECTORY_SEPARATOR, $pieces);
    }

    /**
     *
     * @param array $pieces
     *
     * @return string
     */
    public static function app($pieces)
    {

        return self::_path(app_path(), $pieces);
    }

    /**
     *
     * @param array $pieces
     *
     * @return string
     */
    public static function resources($pieces)
    {

        return self::_path(base_path(), ['resources'] + $pieces);
    }
    /**
     *
     * @param array $pieces
     *
     * @return string
     */
    public static function assets($pieces)
    {
        return self::_path(base_path(), array_merge(['resources', 'assets', 'awesovel'], $pieces));
    }

    /**
     *
     * @param array $pieces
     *
     * @return string
     */
    public static function base($pieces)
    {

        return self::_path(base_path(), $pieces);
    }

}
