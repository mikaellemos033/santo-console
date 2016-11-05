<?php

namespace SantoConsole\Parameters;

use \Exception;

class Extract
{
  public function run($params, $inputs)
  {
      if( empty($params) && empty($inputs) ) return [];

      $new_params = [];
      foreach( $params as $param ){
        foreach( $inputs as $k => $input ){
          if( !preg_match("/^([--{$param}=])/", $input) ) continue;
          if( empty($new_params[$param]) ){
            $new_params[$param] = end(explode('=', $input));
          }
        }
      }
      
      return $this->validParams($new_params, $params);
  }

  public function validParams( array $new_params, array $params )
  {
    if( count($new_params) != count($params) ){
      $text = implode(", ", $params);
      $text = "Está faltando alguns parâmetros ({$text})";
      throw new Exception($text);
    }
    return $new_params;
  }

}
