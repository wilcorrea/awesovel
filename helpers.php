<?php

/*
|--------------------------------------------------------------------------
| Helpers Functions
|--------------------------------------------------------------------------
|
| These functions are very useful when we are making templates
| The functions combine the settings defined in app.json with the parameters
|
| For reasons of security only index stay on the public folder,
| otherwise the app will use routes to get files and contents and anything
|
*/

/**
 * Generate path to assets route
 *
 * @param $path
 * @return string
 */
function awesovel_asset($path)
{

    return url(implode('/', ['static/assets', $path]));
}

/**
 * Create the paths to app layouts
 *
 * @param string $index
 * @return string
 */
function awesovel_app($index = 'index')
{

    return implode('.', [config('awesovel')['view'], $index]);
}

/**
 * Create the paths to layouts
 *
 * @param string $root
 * @param string $index
 * @return string
 */
function awesovel_layouts($root, $index = 'index')
{

    return $root . '.layouts.' . $index;
}

/**
 * Create the paths to cms layouts
 *
 * @param string $index
 * @return string
 */
function awesovel_template($index = 'index')
{

    return awesovel_layouts(config('awesovel')['template'], $index);
}

/**
 * Generate routes to others pages
 *
 * @param $slug
 * @param bool $print
 *
 * @return string
 */
function awesovel_route($slug, $print = false)
{

    $go = url($slug);

    if (is_array(config('awesovel')['languages']) && count(config('awesovel')['languages']) > 1) {

        $language = config('awesovel')['language'];

        $go = url(implode('/', [$language, $slug]));
    }

    if ($print) {

        echo $go;
    }

    return $go;
}

/**
 * @param $language
 * @param $module
 * @param $entity
 * @param $button
 * @param $data
 * @return string
 */
function awesovel_link($module, $entity, $button = null, $data = null)
{

    $href = $button;

    $parameters = [];

    if (is_object($button)) {

        $href = (isset($button->href)) ? $button->href : '';

        if (isset($button->parameters) && $button->parameters && $data) {
            foreach ($button->parameters as $parameter) {
                if (isset($data->$parameter)) {
                    $parameters[] = $data->$parameter;
                }
            }
        }
    }

    $link = implode('/', [config('awesovel')['app'], \Awesovel\Helpers\Parse::uncamelize($module), \Awesovel\Helpers\Parse::uncamelize($entity), $href]);

    $link = implode('/', [$link, implode('|', $parameters)]);

    return awesovel_route($link);
}
