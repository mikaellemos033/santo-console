<?php

use PHPUnit\Framework\TestCase;

class OneCommandTest extends TestCase
{
   public function testCommand()
   {
     $command = new \SantoConsole\Command();
     $command->setCommands([
         '\Examples\TestJob'
     ]);

     $this->assertTrue($command->run(['file', 'go:horse']));
   }
}
