<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar;


class Time
{

	public static function stamp(Calendar $date)
	{
		$ts = $date->format('U');
		return \is_float($tmp = $ts * 1) ? $ts : $tmp;
	}


	public static function over(Calendar $date, int $hour, int $minute): bool
	{
		if ($date->getHour() >= $hour) {
			return ($date->getHour() === $hour ? ($date->getMinute() >= $minute) : true);
		}
		return false;
	}


	public static function bellow(Calendar $date, int $hour, int $minute): bool
	{
		if ($date->getHour() <= $hour) {
			return ($date->getHour() === $hour ? ($date->getMinute() <= $minute) : true);
		}
		return false;
	}


	public static function between(Calendar $date, int $hour1, int $minute1, int $hour2, int $minute2): bool
	{

		if ($hour1 > $hour2) {
			$date2 = $date->getDay() . '.' . $date->getMonth() . '.' . $date->getYear();

			$firstDate = new Calendar($date2 . ' ' . $hour1 . ':' . $minute1);
			$lastDate = new Calendar($date2 . ' ' . $hour2 . ':' . $minute2);
			$lastDate->modify('+1 day');

			if (self::stamp($date) >= self::stamp($firstDate)) {
				if ($date <= $lastDate) {
					return true;
				}
			} elseif ($date <= $lastDate) {
				return true;
			}
		}

		return (self::bellow($date, $hour2, $minute2) ? self::over($date, $hour1, $minute1) : false);
	}


	public static function getFullMinute(int $minute): string
	{
		if ($minute <= 9) {
			$minute .= '0';
		}

		return (string) $minute;
	}


	public static function getFullTime(int $hour, int $minute)
	{
		return $hour . ':' . self::getFullMinute($minute);
	}

}
