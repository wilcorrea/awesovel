<?php

namespace Awesovel\Helpers;

use Awesovel\Helpers\Path;
use Awesovel\Helpers\Json;

class Config
{

    public static function parse($module, $entity)
    {

        $filename = Path::path(['Src', $module, 'Config', $entity . '.gen']);

        $content = file_get_contents($filename);

        return Json::decode($content);
    }

}
