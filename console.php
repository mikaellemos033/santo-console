<?php
/**
 * @author [Mikael Lemos]<mikaellemos033@gmail.com >
 * @description: Console customizado, para executar jobs customizados,
 * independente de frameworks
 *
 */

require ('vendor/autoload.php');

$command = new \SantoConsole\Command();
$command->setCommands([
    'Examples\MestreJob',
    'Examples\TestJob'
]);

$command->run($argv);
