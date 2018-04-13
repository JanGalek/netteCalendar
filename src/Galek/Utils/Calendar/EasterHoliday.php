<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar;

use Galek\Utils\Calendar\Exceptions\EasterNotCalculable;

class EasterHoliday
{

	public static function getMonday(int $year): Calendar
	{
		$easter = self::getEaster($year);
		$day = Calendar::from($easter);
		$day->modify('+1 day');
		return $day;
	}


	public static function getEaster(int $year): Calendar
	{
		$a = ($year % 19); // cyklus stejnych dnu
		$b = ($year % 4); // cyklus prestupnych roku
		$c = ($year % 7); // dorovnani dne v tydnu
		$m = 1;
		$n = 1;

		if ($year >= '1800' && $year <= '1899') {
			$m = 23;
			$n = 4;
		} else if ($year >= '1900' && $year <= '2099') {
			$m = 24;
			$n = 5;
		}

		$d = (((19 * $a) + $m) % 30);
		$e = (($n + (2 * $b) + (4 * $c) + (6 * $d)) % 7);

		$s1 = (22 + $d + $e);
		$s2 = ($d + $e - 9);

		return self::calculate($year, $s1, $s2, $d, $e, $a);
	}


	public static function getGoodFriday(int $year): Calendar
	{
		$easter = self::getEaster($year);
		$day = Calendar::from($easter);
		$day->modify('-2 day');
		return $day;
	}


	private static function calculate(int $year, int $s1, int $s2, int $d, int $e, int $a): Calendar
	{
		if ($s1 >= 22 && $s1 <= 31) {
			$date = $year . '-03-' . $s1;
		} elseif ($s2 === 25 && $d === 28 && $e === 6 && $a > 10) {
			$date = $year . '-04-18';
		} elseif ($s2 <= 25) {
			$date = $year . '-04-';
			if ($s2 <= 9) {
				$date .= '0';
			}
			$date .= $s2;
		} elseif ($s2 > 25) {
			$date = $year . '-04-' . ($s2 - 7);
		} else {
			$date = date('Y-m-d', easter_date($year));
		}

		return new Calendar($date);
	}
}
