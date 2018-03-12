<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Validators;


use Galek\Utils\Exceptions\InvalidHourException;


class HourValidator implements IValidator
{

	public static function validate($value)
	{
		if ($value >= 0 && $value <= 23) {
			return true;
		}

		throw new InvalidHourException(sprintf('Value "%s" is invalid for hour', $value));
	}
}