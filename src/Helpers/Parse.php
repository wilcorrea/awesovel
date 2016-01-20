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

        $filename = Path::app([awesovel_config('root'), $module, 'Scaffold', $entity, $entity . '.gen']);

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
    public static function form($module, $entity, $index, $language = null)
    {
        if (is_null($language)) {
            $language = AwesovelServiceProvider::$LANGUAGE;
        }

        $filename = Path::app([awesovel_config('root'), $module, 'Scaffold', $entity, 'Form', $index . '.frm']);

        $content = file_get_contents($filename);

        $form = Json::decode($content);

        return self::language($form, $module, $entity, $language);
    }

    /**
     * @param $form
     * @param $module
     * @param $entity
     * @param $spell
     */
    private static function language($form, $module, $entity, $spell)
    {
        $__default = 'default';

        if ($spell === $__default) {
            $spell = AwesovelServiceProvider::$LANGUAGE;
        }

        $filename = Path::app([awesovel_config('root'), $module, 'Scaffold', $entity, 'Language', $spell . '.lng']);

        $content = file_get_contents($filename);

        $translations = Json::decode($content);

        $id = $form->id;

        $default = $translations->$__default;

        $language = $default;

        if (isset($translations->$id)) {
            $language = $translations->$id;
        }

        /*
         * recover spell to label
         */
        $form->label = $language->label;

        /*
         * recover spell to items
         */
        foreach ($form->items as $key => $item) {

            if (isset($language->items->$key)) {

                foreach ($language->items->$key as $__property => $__stub) {

                    $form->items->$key->$__property = $language->items->$key->$__property;
                }
            } else if (isset($default->items->$key)) {

                foreach ($default->items->$key as $__property => $__stub) {

                    $form->items->$key->$__property = $default->items->$key;
                }
            }

            $form->items->$key->id = $key;
        }

        /*
         * recover spell to actions
         */
        foreach ($form->actions as $key => $__action) {

            $id = $__action->id;

            $properties = ['label' => $default->label, 'title' => ""];

            foreach ($properties as $property => $__default) {

                $__action->$property = $__default;

                if (isset($language->actions) && isset($language->actions->$id) && isset($language->actions->$id->$property)) {

                    $__action->$property = $language->actions->$id->$property;

                } else if (isset($translations->$id) && isset($translations->$id->$property)) {

                    $__action->$property = $translations->$id->$property;
                }
            }


            $form->actions[$key] = $__action;
        }

        return $form;
    }

    /**
     * @param $data
     * @param $id
     */
    public static function out($data, $id)
    {
        return $data->$id;
    }

    /**
     * Translates a camel case string into a string with underscores (e.g. firstName -&gt; first_name)
     * @param    string $str String in camel case format
     * @return    string            $str Translated into underscore format
     */
    public static function uncamelize($str)
    {
        $str[0] = strtolower($str[0]);

        $func = create_function('$c', 'return "-" . strtolower($c[1]);');

        return preg_replace_callback('/([A-Z])/', $func, $str);
    }

    /**
     * Translates a string with underscores into camel case (e.g. first_name -&gt; firstName)
     * @param    string $str String in underscore format
     * @param    bool $capitalise_first_char If true, capitalise the first char in $str
     * @return   string                              $str translated into camel caps
     */
    public static function camelize($str, $capitalise_first_char = false)
    {
        if ($capitalise_first_char) {
            $str[0] = strtoupper($str[0]);
        }

        $func = create_function('$c', 'return strtoupper($c[1]);');

        return preg_replace_callback('/\-([a-z])/', $func, $str);
    }

}
