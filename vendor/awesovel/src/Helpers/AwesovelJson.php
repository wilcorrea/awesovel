<?php

namespace Awesovel\Helpers;

class AwesovelJson {
 
  /**
   * 
   * @param string $string
   * @return type
   */
  public static function decode($string) {

    return json_decode($string);
  }

  /**
   * 
   * @param string $object
   * @return type
   */
  public static function encode($object) {

    return json_encode($object);
  }

}
