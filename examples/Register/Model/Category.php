<?php

namespace Delivery\Src\Register\Model;

use Awesovel\Defaults\Model;

class Category extends Model {

  public function __construct(array $attributes = array()) {
    parent::__construct('Register', 'Category', $attributes);
  }

}
