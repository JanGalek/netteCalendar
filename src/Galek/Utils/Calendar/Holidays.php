<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils;


use Galek\Utils\Calendar\Validators\CountryValidator;
use Nette\Neon\Neon;


class Holidays
{
	/**
	 * @var string
	 */
	private $country;


	public function __construct(string $country)
	{
		$this->setCountry($country);
	}


	public function setCountry(string $country)
	{
		CountryValidator::validate($country);
		$this->country = $country;
	}


	/**
	 * @return array
	 */
	public function getHolidays()
	{
		return $this->loadConfig()['holidays'];
	}


	public function allowedEaster()
	{
		return $this->loadConfig()['easter'];
	}


	public function allowedGoodFriday()
	{
		return $this->loadConfig()['goodFriday'];
	}


	private function loadConfig()
	{
		$file = __DIR__ . '/Holidays/' . $this->country . '.neon';
		return Neon::decode(file_get_contents($file), Neon::BLOCK);
	}
}
