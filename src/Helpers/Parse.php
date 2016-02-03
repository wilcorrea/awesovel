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

        $filename = Path::app([awesovel_config('root_app'), $module, 'Scaffold', $entity, $entity . '.gen']);

        $content = null;

        if (File::exists($filename)) {

            $content = File::get($filename);
        }

        return Json::decode($content);
    }

    /**
     * @param $module
     * @param $entity
     * @param $index
     * @param $merge
     *
     * @return type
     */
    public static function form($module, $entity, $index, $merge = false)
    {

        $filename = Path::app([awesovel_config('root_app'), $module, 'Scaffold', $entity, 'Form', $index . '.frm']);

        $content = null;

        if (File::exists($filename)) {

            $content = File::get($filename);
        }

        $form = Json::decode($content);

        if ($merge && $form) {

            $scaffold = self::scaffold($module, $entity);

            if (isset($form->fields)) {

                foreach ($form->fields as $row) {

                    if (isset($row->fieldGroup)) {

                        $fieldGroup = $row->fieldGroup;

                        foreach ($fieldGroup as $field) {

                            $key = $field->key;

                            if (isset($scaffold->items->$key)) {

                                $field->templateOptions = self::merge($scaffold->items->$key, $field->templateOptions);
                            }
                        }
                    }
                }
            }

            $form->actions = self::actions($module, $entity, $form);
        }

        return $form;
    }

    /**
     * @param $module
     * @param $entity
     * @param $index
     *
     * @return type
     */
    public static function operation($module, $entity, $index)
    {

        $filename = Path::app([awesovel_config('root_app'), $module, 'Scaffold', $entity, 'Operation', $index . '.opr']);

        $content = null;

        if (File::exists($filename)) {

            $content = File::get($filename);

            $operation = Json::decode($content);

            if (isset($operation->action) && !$operation->action) {
                $operation->action = $operation->id;
            }
        }

        return $operation;
    }

    /**
     * @param $module
     * @param $entity
     * @param $spell
     * @param string $index
     *
     * @return mixed
     */
    public static function language($module, $entity, $spell, $index = 'default')
    {
        $__default = 'default';

        if ($spell === $__default) {
            $spell = AwesovelServiceProvider::$LANGUAGE;
        }

        $filename = Path::app([awesovel_config('root_app'), $module, 'Scaffold', $entity, 'Language', $spell . '.lng']);

        $language = null;

        if (File::exists($filename)) {

            $content = File::get($filename);

            $translations = Json::decode($content);

            $language = $translations->$__default;

            if (isset($translations->forms->$index)) {

                $language = self::merge($language, $translations->forms->$index);
            }
        }

        return $language;
    }

    /**
     * @param $module
     * @param $entity
     * @param $form
     *
     * @return object
     */
    private static function actions($module, $entity, $form)
    {

        $positions = [
            'top' => [],
            'middle' => [],
            'bottom' => []
        ];

        foreach ($form->actions as $i => $action) {

            $frm = self::form($module, $entity, $i, false);

            if ($frm) {
                $action = self::merge($action, $frm->templateOptions);
            }

            foreach ($positions as $key => $available) {

                if (isset($action->position) && isset($action->position->$key)) {

                    $positions[$key][$action->position->$key] = $action;
                }

                ksort($positions[$key]);
            }
        }

        ksort($positions);

        return (object)$positions;
    }

    /**
     *
     * @param $module
     * @param $entity
     * @param $index
     * @param $spell
     *
     * @return array|object
     */
    public static function undefined($module, $entity, $index, $spell)
    {
        $operation = null;

        $form = self::form($module, $entity, $index);

        if ($form) {

            $language_default = self::language($module, $entity, $spell, 'default');
            $language_form = self::language($module, $entity, $spell, $index);

            $language = self::merge($language_default, $language_form);

            foreach ($language->items as $key => $value) {
                if (!isset($form->items->$key)) {
                    unset($language->items->$key);
                }
            }

            foreach ($language->actions as $key => $value) {
                if (!isset($form->actions->$key)) {
                    unset($language->actions->$key);
                }
            }

            $operation = self::merge($language, $form);
        }

        return $operation;
    }


    /**
     *
     * @param $data
     * @param $id
     *
     * @return string
     */
    public static function out($data, $id)
    {
        return isset($data->$id) ? $data->$id : '';
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
     * @param    string $string String in underscore format
     * @param    bool $capitalise_first_char If true, capitalise the first char in $str
     * @return   string                              $str translated into camel caps
     */
    public static function camelize($string, $capitalise_first_char = false)
    {
        if ($capitalise_first_char) {
            $string[0] = strtoupper($string[0]);
        }

        $func = create_function('$c', 'return strtoupper($c[1]);');

        return preg_replace_callback('/\-([a-z])/', $func, $string);
    }

    /**
     * @param \stdClass $object1
     * @param \stdClass $object2
     * @return array|object
     */
    private static function merge($object1, $object2, $override = true)
    {
        if ($override) {

            $merged = array_replace_recursive(self::convert($object1), self::convert($object2));
        } else {

            $merged = array_intersect_key(self::convert($object1), self::convert($object2));
        }

        return self::convert($merged, false);
    }

    /**
     * @param array|\stdClass $convert
     * @param bool $isObject
     *
     * @return array|\stdClass
     */
    private static function convert($convert, $isObject = true)
    {
        if (is_array($convert)) {
            foreach ($convert as $key => $value) {
                $convert[$key] = self::convert($value, $isObject);
            }
            if (!$isObject && !isset($convert[0])) {
                $convert = (object)$convert;
            }
        } else if (is_a($convert, 'stdClass')) {
            if ($isObject) {
                $convert = self::convert((array)$convert, $isObject);
            }
        }

        return $convert;
    }

}
