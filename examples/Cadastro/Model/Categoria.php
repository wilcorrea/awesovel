<?php

namespace CodeDelivery\Src\Cadastro\Model;

use Awesovel\Defaults\Model;

class Categoria extends Model {

  public function __construct(array $attributes = array()) {
    parent::__construct('Cadastro', 'Categoria', $attributes);
  }

}
