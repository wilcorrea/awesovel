<?php

namespace Awesovel\Helpers;

class AwesovelConfig {
  
  public static function parse($module, $entity) {

    $filename = \Awesovel\Helpers\AwesovelPath::path(['Src', $module, 'Config', $entity . '.json']);

    $content = file_get_contents($filename);

    return \Awesovel\Helpers\AwesovelJson::decode($content);
  }

}
