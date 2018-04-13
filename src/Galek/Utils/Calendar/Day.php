<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types = 1);

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


	public static function getWorkDay(Calendar $date, Holidays $holidays, $next = false): Calendar
	{
		if ($next) {
			$date->modify('+1 days');
		}

		if (self::isWeekend($date)) {
			if (self::isSunday($date)) {
				$date->modify('+1 days');
			} else {
				$date->modify('+2 days');
			}
		} elseif ($holidays->isHoliday($date)) {
			$date->modify('+1 days');
		}

		if (!self::isWork($holidays, $date)) {
			$date = self::getWorkDay($date, $holidays);
		}

		return $date;
	}


	public static function isWeek(\DateTime $date): bool
	{
		$number = self::getNumber($date);
		return ($number <= 5 && $number >= 1);
	}


	public static function countInMonth(int $year, int $month): int
	{
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}


	public static function getWorkDayNumberInMonth(int $month, int $year): int
	{
		return self::getWorkDayNumberInMonthTo($month, $year, self::countInMonth($year, $month));
	}


	public static function getWorkDayNumberInMonthTo(int $month, int $year, int $day): int
	{
		$dayCount = self::countInMonth($year, $month);
		if ($day > $dayCount) {
			$day = $dayCount;
		}

		$date = new Calendar();
		$date->setDate($year, $month, 1);

		$number = 0;

		for ($i = 1; $i <= $day; $i++) {
			$date->setDay($i);
			if ($date->isWorkDay()) {
				$number++;
			}
		}

		return $number;
	}
}