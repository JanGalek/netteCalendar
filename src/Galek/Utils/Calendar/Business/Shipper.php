<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Business;


use Galek\Utils\Calendar\Calendar;
use Galek\Utils\Calendar\Day;
use Galek\Utils\Calendar\Configuration\Localization;
use Galek\Utils\Calendar\Time;


class Shipper implements IShipper
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var int
	 */
	private $hour;

	/**
	 * @var int
	 */
	private $minute;

	/**
	 * @var bool
	 */
	private $weekend;

	/**
	 * @var \Galek\Utils\Calendar\Configuration\Localization
	 */
	private $configuration;

	/**
	 * @var int
	 */
	private $deliveryTime;

	/**
	 * @var Calendar
	 */
	private $date;



	public function __construct(string $name, Localization $configuration, int $hour, int $minute, bool $weekend = false, int $deliveryTime = 1)
	{
		$this->setTime($hour, $minute);
		$this->enableWeekend($weekend);
		$this->configuration = $configuration;
		$this->deliveryTime = $deliveryTime;
		$this->name = $name;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getCurrentDate(): Calendar
	{
		if ($this->date) {
			return $this->date;
		}

		$date = new Calendar('now', null, $this->configuration);
		return $date;
	}


	public function setCurrentDate(Calendar $date = null): void
	{
		$this->date = $date;
	}


	public function getDate(): Calendar
	{
		$date = $this->getCurrentDate();

		if (Day::isWork($this->configuration->getHolidays(), $date)) {
			if (Time::over($date, $this->hour, $this->minute)) {
				$date->modify('+1 days');
			}

			if ($this->weekend === false) {
				$date = $date->getWorkDay();
			}
		} else {
			if ($this->weekend === false) {
				$date = $date->getWorkDay();
			}
		}

		$date->modify('+' . $this->deliveryTime . ' days');

		if ($this->weekend === false) {
			$date = $date->getWorkDay();
		}

		//return $date->getWorkDay();
		return $date;
	}


	public function setTime(int $hour, int $minute): void
	{
		$this->setHour($hour);
		$this->setMinute($minute);
	}


	public function setHour(int $hour): void
	{
		$this->hour = $hour;
	}


	public function getHour(): int
	{
		return $this->hour;
	}


	public function setMinute(int $minute): void
	{
		$this->minute = $minute;
	}


	public function getMinute(): int
	{
		return $this->minute;
	}


	public function enableWeekend($value = true): void
	{
		$this->weekend = $value;
	}


	public function disableWeekend(): void
	{
		$this->enableWeekend(false);
	}
}
