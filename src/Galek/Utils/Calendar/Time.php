<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils;


class Time
{

	/**
	 * @param Calendar $date
	 * @return float|int|string
	 */
	public static function stamp(Calendar $date)
	{
		$ts = $date->format('U');
		return \is_float($tmp = $ts * 1) ? $ts : $tmp;
	}

	/**
	 * @param Calendar $date
	 * @param int      $hour
	 * @param int      $minute
	 * @return bool
	 */
	public static function over(Calendar $date, int $hour, int $minute)
	{
		if ($date->getHour() >= $hour) {
			return ($date->getHour() === $hour ? ($date->getMinute() >= $minute) : true);
		}
		return false;
	}

	/**
	 * Check Time bellow
	 * @param int $hour
	 * @param int $minute format: 1,2,3,..9,10,...
	 * @return boolean
	 */
	public static function bellow(Calendar $date, int $hour, int $minute)
	{
		if ($date->getHour() <= $hour) {
			return ($date->getHour() === $hour ? ($date->getMinute() <= $minute) : true);
		}
		return false;
	}


	public static function between(Calendar $date, int $hour1, int $minute1, int $hour2, int $minute2)
	{

		if ($hour1 > $hour2) {
			$date2 = $date->getDay() . '.' . $date->getMon() . '.' . $date->getYear();

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

}
