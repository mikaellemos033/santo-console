<?php

namespace SantoConsole\Parameters;

use \Exception;

class Extract
{
  private $comment;

  public function run(array $params, array $inputs)
  {
    if (empty($params) && empty($inputs)) return [];

    $arguments = [];

    foreach ($params as $param) {
      
      foreach ($inputs as $k => $input) {
        
        if (!preg_match("/^([--{$param}=])/", $input)) continue;
    
        if (empty($arguments[$param])) {

          $arg = explode('=', $input);
          $arguments[$param] = end($arg);

        }
    
      }
      
    }
      
    return $this->validParams($arguments, $params);
  }

  private function validParams(array $arguments, array $params)
  {
    if (sizeof($arguments) != sizeof($params)) {    
      throw new Exception(sprintf('Está faltando alguns parâmetros (%s)', implode(", ", $params)));
    }

    return $arguments;
  }

}
