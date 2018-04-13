<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 13.4.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar;


class Helper
{
	public static function dateDifferenceTranslation(Calendar $date, Calendar $curDate, int $diff, array $local): string
	{
		if ($date >= $curDate) {
			return self::getDifferenceAfter($diff, $local);
		}

		return self::getDifferenceBefore($diff, $local);
	}


	private static function getDifferenceAfter(int $diff, array $local): string
	{
		if ($diff === 0) {
			return $local['today'];
		} elseif ($diff === 1) {
			return $local['tomorrow'];
		} elseif ($diff === 2) {
			return $local['afterTomorrow'];
		} elseif ($diff < 5) {
			return $local['after'] . ' ' . $diff . ' ' . $local['twoDays'];
		} else {
			return self::getDifferenceDefault($diff, $local);
		}
	}


	private static function getDifferenceBefore(int $diff, array $local): string
	{
		if ($diff === 1) {
			return $local['yesterday'];
		} else {
			return $local['before'] . ' ' . $diff . ' ' . $local['twoDays'];
		}
	}


	private static function getDifferenceDefault(int $diff, array $local): string
	{
		return $local['after'] . ' ' . $diff . ' ' . $local['fiveDays'];
	}
}
