<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Business;


use Galek\Utils\Calendar;


class Shipping
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


	public function setTime(int $hour, int $minute)
	{
		$this->setHour($hour);
		$this->setMinute($minute);
	}


	public function setHour(int $hour)
	{
		$this->hour = $hour;
	}


	public function setMinute(int $minute)
	{
		$this->minute = $minute;
	}


	public function enableWeekend($value = true)
	{
		$this->weekend = $value;
	}

	public function disableWeekend()
	{
		$this->enableWeekend(false);
	}
}
