<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar;


class Day
{
	public static function getNumber(\DateTime $date): int
	{
		return (int) $date->format('w');
	}


	public static function isMonday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 1);
	}


	public static function isTuesday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 2);
	}


	public static function isWednesday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 3);
	}


	public static function isThursday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 4);
	}


	public static function isFriday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 5);
	}


	public static function isSaturday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 6);
	}


	public static function isSunday(\DateTime $date): bool
	{
		return (self::getNumber($date) === 0);
	}


	public static function isWeekend(\DateTime $date): bool
	{
		return (self::isSaturday($date) || self::isSunday($date));
	}


	public static function isWork(Holidays $holidays, \DateTime $date): bool
	{
		if ($holidays->isHoliday($date) || self::isWeekend($date)) {
			return false;
		}

		return true;
	}


	public static function isWeek(\DateTime $date): bool
	{
		$number = self::getNumber($date);
		return ($number <= 5 && $number >= 1);
	}
}