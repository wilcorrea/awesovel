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
     * @param array $pieces
     *
     * @return string
     */
    public static function path($pieces)
    {

        return app_path() . DIRECTORY_SEPARATOR . join(DIRECTORY_SEPARATOR, $pieces);
    }

}
