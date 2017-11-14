<?php 

namespace SantoConsole\Write;

use Exception;

class Comment
{
	protected $colors = [];
	protected $backgrounds = [];

	public function __construct()
	{
		$path = __DIR__ . '/../config/';

		$this->registerColors($path . 'colors.php');
		$this->registerBackgrounds($path . 'backgrounds.php');

	}

	public function registerColors($file)
	{
		if (!file_exists($file)) {
			throw new Exception(sprintf('Arquivo "%s" não encontrado.', $file));
		}

		$this->colors = array_merge($this->colors, require($file));
		return $this;
	}

	public function registerBackgrounds($file)
	{
		if (!file_exists($file)) {
			throw new Exception(sprintf('Arquivo "%s" não encontrado.', $file));
		}

		$this->backgrounds = array_merge($this->backgrounds, require($file));
		return $this;
	}

	public function showColors()
	{
		$this->puts(implode(array_keys($this->colors), "\n"));
	}

	public function showBackgrounds()
	{
		$this->puts(implode(array_keys($this->backgrounds), "\n"));
	}

	public function puts($text, $color = null, $bg = null)
	{
		$message = '';

		if (isset($this->colors[$color]))   $message .= "\033[" . $this->colors[$color] . "m";
		if (isset($this->backgrounds[$bg])) $message .= "\033[" . $this->backgrounds[$bg] . "m";
		
		$message .= $text . "\033[0m";
		echo sprintf("\n%s\n", $message);
	}

	public function success($text) 
	{
		$this->puts($text, 'white', 'green');
	}

	public function error($text)
	{
		$this->puts($text, 'white', 'red');
	}
}