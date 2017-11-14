<?php

namespace SantoConsole;

use Exception;
use SantoConsole\ListCommands\ListCommands;
use SantoConsole\Parameters\Extract;
use SantoConsole\Write\Comment;

class Command
{
  private $job;
  private $params = [];
  private $comment;

  public function __construct()
  {
    $this->comment = new Comment();
  }


  public function setCommands(array $command)
  {
    $this->commands = new ListCommands($command);
    return $this;    
  }

  public function run($argv)
  {     
    $this->args($argv);
  
    if (empty($this->job)) {
       
      $this->showCommands();
      return null;

    }

    if (!in_array($this->job, array_keys($this->commands->calls))) {
      throw new Exception(sprintf('Job "%s" não encontrado', $this->job), 1);
    }
        
    $this->execute();
  }

  private function execute()
  {
    try{
        
        $args   = new Extract();
        $job    = new $this->commands->calls[$this->job];        
        $params = $args->run($job->params, $this->params);
        
        /**
         * setando parametros do 
         * job
         */

        foreach ($params as $k => $v) {          
          $job->$k = $v;
        }

        return $job->run();
         
    } catch (Exception $e) {

      $this->comment->error('Houve um error: '. $e->getMessage() . '\n no arquivo: ' . $e->getFile() . '\n na linha ' . $e->getLine());

    }

  }

  public function showCommands()
  {
      $str = "\n";
     
      foreach ($this->commands->lists as $k => $v) {
        $str .= "{$k}: {$v} \n";
      }

      $this->comment->success($str);
  }

  private function args($args)
  {
    array_shift($args);    
    if (empty($args) || !is_array($args)) return true;

    $this->job    = $args[0];
    $this->params = array_slice($args, 1, sizeof($args));
                
    return false;
  }

}
