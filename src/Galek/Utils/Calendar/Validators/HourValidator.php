<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Validators;


use Galek\Utils\Calendar\Exceptions\InvalidHourException;


class HourValidator implements IValidator
{
	/**
	 * @param $value
	 * @return bool
	 * @throws InvalidHourException
	 */
	public static function validate($value): bool
	{
		if ($value >= 0 && $value <= 23) {
			return true;
		}

		throw new InvalidHourException(sprintf('Value "%s" is invalid for hour', $value));
	}
}