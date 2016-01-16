<?php

namespace CodeDelivery\Src\Site\Model;

use Awesovel\Defaults\Model;

class Pagina extends Model {

  public function __construct(array $attributes = array()) {
    parent::__construct('Site', 'Pagina', $attributes);
  }

}
