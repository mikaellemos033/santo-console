<?php

namespace SantoConsole\Examples;

use \SantoConsole\Job\JobConsole;

class TestJob extends JobConsole
{    
    /**
     * @var string
     * comando que será executado no console
     */
    public static $command = "go:horse";

    /**
     * @var string
     * descrição do comando
     */
    public static $description = "vai cavalo";

    /**
     * @var array
     * parametros requeridos pelo comando
     */
    public $params = [
        'name'
    ];

    /**
     * função que será executado
     */
    public function run()
    {
      $this->comment->success("vai cavalinho");
      return true;
    }

}
