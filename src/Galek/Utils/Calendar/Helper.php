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
			if ($diff === 0) {
				return $local['today'];
			} elseif ($diff === 1) {
				return $local['tomorrow'];
			} elseif ($diff === 2) {
				return $local['afterTomorrow'];
			} elseif ($diff < 5) {
				return $local['after'] . ' ' . $diff . ' ' . $local['twoDays'];
			}
		} else {
			if ($diff === 1) {
				return $local['yesterday'];
			} else {
				return $local['before'] . ' ' . $diff . ' ' . $local['twoDays'];
			}
		}

		return $local['after'] . ' ' . $diff . ' ' . $local['fiveDays'];
	}
}
