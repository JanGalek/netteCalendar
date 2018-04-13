<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar\Configuration;

use Galek\Utils\Calendar;
use Galek\Utils\Calendar\Business\Shipper;
use Galek\Utils\Calendar\Enum\Country;
use Galek\Utils\Calendar\Enum\CountryLocalization;


class Localization
{
	/**
	 * @var Calendar\Localization
	 */
	private $localization;

	/**
	 * @var Calendar\Holidays
	 */
	private $holidays;


	/**
	 * Localization constructor.
	 * @param string $country
	 * @param array  $shippers
	 */
	public function __construct($country = Country::CZ, array $shippers = [])
	{
		$localization = CountryLocalization::$list[$country];
		$this->setLocalization($localization);
		$this->setHolidays($country);
	}


	public function getDate(): Calendar\Calendar
	{
		return new Calendar\Calendar('now', null, $this);
	}


	public function setLocalization(string $localization): void
	{
		$this->localization = new Calendar\Localization($localization);
	}


	public function getLocalization(): Calendar\Localization
	{
		return $this->localization;
	}


	public function setHolidays(string $country): void
	{
		$this->holidays = new Calendar\Holidays($country);
	}


	public function getHolidays(): Calendar\Holidays
	{
		return $this->holidays;
	}
}
