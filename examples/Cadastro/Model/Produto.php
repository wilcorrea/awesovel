<?php

namespace CodeDelivery\Src\Cadastro\Model;

use Awesovel\Defaults\Model;

class Produto extends Model {

  public function __construct(array $attributes = array()) {
    parent::__construct('Cadastro', 'Produto', $attributes);
  }

}
