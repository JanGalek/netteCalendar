<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils;


class Day
{
	public static function getNumber(\DateTime $date)
	{
		return (int) $date->format('w');
	}


	/**
	 * Check Monday
	 * @return boolean
	 */
	public static function isMonday(\DateTime $date)
	{
		return (self::getNumber($date) === 1);
	}

	/**
	 * Check Tuesday
	 * @return boolean
	 */
	public static function isTuesday(\DateTime $date)
	{
		return (self::getNumber($date) === 2);
	}

	/**
	 * Check Wednesday
	 * @return boolean
	 */
	public static function isWednesday(\DateTime $date)
	{
		return (self::getNumber($date) === 3);
	}

	/**
	 * Check Thursday
	 * @return boolean
	 */
	public static function isThursday(\DateTime $date)
	{
		return (self::getNumber($date) === 4);
	}

	/**
	 * Check Friday
	 * @return boolean
	 */
	public static function isFriday(\DateTime $date)
	{
		return (self::getNumber($date) === 5);
	}

	/**
	 * Check Saturday
	 * @return boolean
	 */
	public static function isSaturday(\DateTime $date)
	{
		return (self::getNumber($date) === 6);
	}

	/**
	 * Check Sunday
	 * @return boolean
	 */
	public static function isSunday(\DateTime $date)
	{
		return (self::getNumber($date) === 0);
	}


	public static function isWeekend(\DateTime $date)
	{
		return (self::isSaturday($date) || self::isSunday($date));
	}



	public static function isWork(Holidays $holidays, \DateTime $date)
	{
		if ($holidays->isHoliday($date) || self::isWeekend($date)) {
			return false;
		}

		return true;
	}


	public static function isWeek(\DateTime $date)
	{
		$number = self::getNumber($date);
		return ($number <= 5 && $number >= 1);
	}
}