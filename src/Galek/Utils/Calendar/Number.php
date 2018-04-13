<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 13.4.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar;


class Number
{
	public static function between(int $number, int $lowNumber, int $upNumber): bool
	{
		return ($number >= $lowNumber && $number <= $upNumber);
	}
}
