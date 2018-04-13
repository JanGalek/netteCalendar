<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar;

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
		[$s1, $s2, $d, $e, $a] = self::getCalculableVars($year);
		return self::calculate($year, $s1, $s2, $d, $e, $a);
	}


	private static function getCalculableVars($year)
	{
		[$a, $b, $c] = self::getCyclesVar($year);
		[$m, $n] = self::getEasterVar($year);
		$d = (((19 * $a) + $m) % 30);
		$e = (($n + (2 * $b) + (4 * $c) + (6 * $d)) % 7);

		$s1 = (22 + $d + $e);
		$s2 = ($d + $e - 9);

		return [$s1, $s2, $d, $e, $a];
	}


	private static function getCyclesVar(int $year): array
	{
		$a = ($year % 19); // cyklus stejnych dnu
		$b = ($year % 4); // cyklus prestupnych roku
		$c = ($year % 7); // dorovnani dne v tydnu

		return [$a, $b, $c];
	}


	private static function getEasterVar(int $year): array
	{
		if ($year >= 1800 && $year <= 1899) {
			$m = 23;
			$n = 4;
		} else if ($year >= 1900 && $year <= 2099) {
			$m = 24;
			$n = 5;
		} else {
			$m = 1;
			$n = 1;
		}

		return [$m, $n];
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
		$date = null;
		self::calculate1($date, $year, $s1);
		self::calculate2($date, $year, $s2, $d, $e, $a);
		self::calculate3($date, $year, $s2);
		self::calculate4($date, $year, $s2);

		return new Calendar($date ?? date('Y-m-d', easter_date($year)));
	}


	private static function calculate1(& $date, int $year, int $s1): void
	{
		if ($s1 >= 22 && $s1 <= 31) {
			$date = $year . '-03-' . $s1;
		}
	}


	private static function calculate2(& $date, int $year, int $s2, int $d, int $e, int $a): void
	{
		if ($date === null && ($s2 === 25 && $d === 28 && $e === 6 && $a > 10)) {
			$date = $year . '-04-18';
		}
	}


	private static function calculate3(& $date, int $year, int $s2): void
	{
		if ($date === null && $s2 <= 25) {
			$date = $year . '-04-';
			if ($s2 <= 9) {
				$date .= '0';
			}
			$date .= $s2;
		}
	}


	private static function calculate4(& $date, int $year, int $s2): void
	{
		if ($date === null && $s2 > 25) {
			$date = $year . '-04-' . ($s2 - 7);
		}
	}
}
