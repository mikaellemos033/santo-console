<?php

namespace SantoConsole;

use SantoConsole\ListCommands\ListCommands;
use SantoConsole\Parameters\Extract;

class Command
{
  public function setCommands( array $command )
  {
    $this->commands = new ListCommands($command);
  }

  public function run($argv)
  {
      $this->args($argv);
      if( empty($this->job) ){
         echo $this->showCommands();
         return true;
      }

      if( in_array($this->job, array_keys($this->commands->calls)) ){
          try{
            $obj = new $this->commands->calls[$this->job];
            $newparam = new Extract();
            $datas = $newparam->run($obj->params, $this->params);

            foreach( $datas as $k => $v ){
              $obj->$k = $v;
            }
            return $obj->run();
            
          }catch(Exception $e){
              echo 'Houve um error: '. $e->getMessage() . '\n no arquivo: ' . $e->getFile() . '\n na linha ' . $e->getLine();
          }
      }
  }

  public function showCommands()
  {
      $str = "\n";
      foreach( $this->commands->lists as $k => $v ){
        $str .= "{$k}: {$v} \n";
      }
      return $str . "\n";
  }

  public function args($args)
  {
      array_shift($args);
      $this->job = null;
      $this->params = [];

      if( empty($args) || !is_array($args) ) return true;
      $this->job = $args[0];
      if( count($args) < 2) return true;

      array_shift($args);
      $this->params = $args;
  }

}
