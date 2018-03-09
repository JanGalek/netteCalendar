<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils;


use Nette\Neon\Neon;


class Localization
{
	/**
	 * @var string
	 */
	private $local;


	public function __construct(string $local)
	{
		$this->local = $local;
	}


	public function setLocalization(string $local)
	{
		$this->local = $local;
	}


	public function getLocalization()
	{
		return $this->local;
	}


	public function getInflexion($day, int $inflexion)
	{
		return $this->getInflexionDay($day)[$inflexion];
	}


	public function getDifference()
	{
		return $this->loadConfig()['difference'];
	}


	private function getInflexionDay($day)
	{
		return $this->getInflexionDays()[$day];
	}


	private function getInflexionDays()
	{
		return $this->getInflexions()['days'];
	}


	private function getInflexions()
	{
		return $this->loadConfig()['inflexion'];
	}


	private function loadConfig()
	{
		$file = __DIR__ . '/Localization/' . $this->local . '.neon';
		return Neon::decode(file_get_contents($file));
	}
}
