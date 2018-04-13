<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar\Validators;

use Galek\Utils\Calendar\Exceptions\InvalidHourException;

class MinuteValidator implements IValidator
{

	public static function validate($value): bool
	{
		if ($value >= 0 && $value <= 59) {
			return true;
		}

		throw new InvalidHourException(sprintf('Value "%s" is invalid for minute', $value));
	}
}