<?php

namespace Awesovel\Helpers;

use Awesovel\Helpers\Path;
use Awesovel\Helpers\Json;
use Awesovel\Providers\AwesovelServiceProvider;

class Parse
{

    /**
     * @param $module
     * @param $entity
     * @return type
     */
    public static function scaffold($module, $entity)
    {

        $filename = Path::path(['Src', $module, 'Scaffold', $entity . '.gen']);

        $content = file_get_contents($filename);

        return Json::decode($content);
    }

    /**
     * @param $module
     * @param $entity
     * @param $index
     * @param null $language
     * @return type
     */
    public static function operation($module, $entity, $index, $language = null)
    {
        if (is_null($language)) {
            $language = AwesovelServiceProvider::$LANGUAGE;
        }

        $filename = Path::path(['Src', $module, 'Operation', $entity, $index . '.opr']);

        $content = file_get_contents($filename);

        $operation = Json::decode($content);

        return self::language($operation, $module, $entity, $language);
    }

    /**
     * @param $operation
     * @param $module
     * @param $entity
     * @param $spell
     */
    private static function language($operation, $module, $entity, $spell)
    {
        $root = 'default';

        if ($spell === $root) {
            $spell = AwesovelServiceProvider::$LANGUAGE;
        }

        $filename = Path::path(['Src', $module, 'Language', $entity, $spell . '.lng']);

        $content = file_get_contents($filename);

        $translations = Json::decode($content);

        $id = $operation->id;

        $default = $translations->$root;

        $language = $default;

        if (isset($translations->$id)) {
            $language = $translations->$id;
        }

        foreach ($operation->items as $key => $item) {

            if (isset($language->items->$key)) {

                $operation->items->$key = $language->items->$key;
            } else if (isset($default->items->$key)) {

                $operation->items->$key = $default->items->$key;
            }

            $operation->items->$key->id = $key;
        }

        $operation->title = $language->title;

        return $operation;
    }

    /**
     * @param $data
     * @param $id
     */
    public static function out ($data, $id) {
        return $data->$id;
    }

}
