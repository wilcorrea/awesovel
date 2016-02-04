<?php

namespace Delivery\Src\App\Main\Model;

use Awesovel\Defaults\Model;

class Category extends Model {

  public function __construct(array $attributes = array()) {
    parent::__construct('Main', 'Category', $attributes);
  }

}
