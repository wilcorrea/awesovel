<?php

namespace Awesovel\Helpers;

class Config {
  
  public static function parse($module, $entity) {

    $filename = \Awesovel\Helpers\Path::path(['Src', $module, 'Config', $entity . '.json']);

    $content = file_get_contents($filename);

    return \Awesovel\Helpers\Json::decode($content);
  }

}
