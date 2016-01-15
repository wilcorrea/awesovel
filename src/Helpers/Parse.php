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

        $filename = Path::path([config('awesovel')['root'], $module, 'Scaffold', $entity . '.gen']);

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

        $filename = Path::path([config('awesovel')['root'], $module, 'Operation', $entity, $index . '.opr']);

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
        $__default = 'default';

        if ($spell === $__default) {
            $spell = AwesovelServiceProvider::$LANGUAGE;
        }

        $filename = Path::path([config('awesovel')['root'], $module, 'Language', $entity, $spell . '.lng']);

        $content = file_get_contents($filename);

        $translations = Json::decode($content);

        $id = $operation->id;

        $default = $translations->$__default;

        $language = $default;

        if (isset($translations->$id)) {
            $language = $translations->$id;
        }

        /*
         * recover spell to label
         */
        $operation->label = $language->label;

        /*
         * recover spell to items
         */
        foreach ($operation->items as $key => $item) {

            if (isset($language->items->$key)) {

                foreach ($language->items->$key as $__property => $__stub) {

                    $operation->items->$key->$__property = $language->items->$key->$__property;
                }
            } else if (isset($default->items->$key)) {

                foreach ($default->items->$key as $__property => $__stub) {

                    $operation->items->$key->$__property = $default->items->$key;
                }
            }

            $operation->items->$key->id = $key;
        }

        /*
         * recover spell to operations
         */
        foreach ($operation->operations as $key => $__operation) {

            $id = $__operation->id;

            $properties = ['label' => $default->label, 'title' => ""];

            foreach ($properties as $property => $__default) {

                $__operation->$property = $__default;

                if (isset($language->operations) && isset($language->operations->$id) && isset($language->operations->$id->$property)) {

                    $__operation->$property = $language->operations->$id->$property;

                } else if (isset($translations->$id) && isset($translations->$id->$property)) {

                    $__operation->$property  = $translations->$id->$property;
                }
            }


            $operation->operations[$key] = $__operation;
        }

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
