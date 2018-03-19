<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Business;


use Galek\Utils\Calendar\Calendar;


class Transport
{
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
	 * @var Calendar
	 */
	private $date;


	public function __construct(Calendar $calendar, int $hour, int $minute, bool $weekend = false)
	{
		$this->setTime($hour, $minute);
		$this->enableWeekend($weekend);
		$this->date = clone $calendar;
	}


	public function getDate()
	{

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


	public function setMinute(int $minute): void
	{
		$this->minute = $minute;
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
