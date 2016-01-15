<?php
/**
 * Created by PhpStorm.
 * User: analista
 * Date: 15/01/16
 * Time: 17:44
 */

namespace Awesovel\Helpers;


class Url
{

    /**
     * @param $language
     * @param $module
     * @param $entity
     * @param $button
     * @param $data
     * @return string
     */
    public static function link($language, $module, $entity, $button, $data = null)
    {

        $link = implode('/', ['', 'app', $language, $module, $entity, $button->href]);

        $parameters = [];

        if (isset($button->parameters) && $button->parameters && $data) {
            foreach ($button->parameters as $parameter) {
                if (isset($data->$parameter)) {
                    $parameters[] = $data->$parameter;
                }
            }
        }

        $link = implode('/', [$link, implode('|', $parameters)]);

        return $link;
    }
}