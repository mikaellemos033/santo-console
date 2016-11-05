<?php
/**
 * @author: [Mikael Lemos]<mikaellemos033@gmail.com>
 * @description: listas de descricao do comandos cadastrados
 */

namespace SantoConsole\ListCommands;

class ListCommands
{
    /**
     * @var array
     * lista os comandos, e suas classes
     *
     */
    public $calls = [];

    /**
     * lista os comandos e suas descrições
     */
    public $lists = [];


    /**
     * @param $calls array
     *
     * recebe um array com todos os comandos
     */
    public function __construct( array $calls )
    {
      $this->listsCommand($calls);
    }

    public function listsCommand($options)
    {
      foreach ( $options as $option ) {
        $this->lists[$option::$command] = $option::$description;
        $this->calls[$option::$command] = $option;
      }
    }
}
