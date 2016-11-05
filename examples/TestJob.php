<?php

namespace Examples;

use \SantoConsole\Job\JobConsole;

class TestJob implements JobConsole
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
    ];

    /**
     * função que será executado
     */
    public function run()
    {
      echo "vai cavalinho";
      return true;
    }

}
