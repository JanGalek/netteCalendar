<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar;


use Galek\Utils\Calendar\Validators\CountryValidator;
use Nette\Neon\Neon;


class Holidays
{
	/**
	 * @var string
	 */
	private $country;

	/**
	 * @var array
	 */
	private $config;


	public function __construct(string $country)
	{
		$this->setCountry($country);
	}


	public function setCountry(string $country): void
	{
		CountryValidator::validate($country);
		$this->country = $country;
	}


	public function getCountry(): string
	{
		return $this->country;
	}


	/**
	 * @return array
	 */
	public function getHolidays(): array
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
		if (!$this->config) {
			$file = __DIR__ . '/Holidays/' . $this->country . '.neon';

			$this->config = Neon::decode(file_get_contents($file), Neon::BLOCK);
		}

		return $this->config;
	}


	/**
	 * @param Calendar $date
	 * @return bool
	 */
	public function isHoliday(Calendar $date): bool
	{
		if ($this->allowedEaster() && EasterHoliday::getMonday($date->getYear())->format('Y-m-d') === $date->format('Y-m-d')) {
			return true;
		}

		if ($this->allowedGoodFriday() && EasterHoliday::getGoodFriday($date->getYear())->format('Y-m-d') === $date->format('Y-m-d')) {
			return true;
		}

		foreach ($this->getHolidays() as $holiday) {
			$yearHoliday = $date->getYear() . '-' . $holiday;

			if ($date->format('Y-m-d') === $yearHoliday) {
				return true;
			}
		}
		return false;
	}
}
