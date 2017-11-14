<?php

namespace SantoConsole\Job;

use SantoConsole\Write\Comment;

abstract class JobConsole
{
	protected $comment;

	public function __construct()
	{
		$this->comment = new Comment();
	}

    abstract public function run();
}
