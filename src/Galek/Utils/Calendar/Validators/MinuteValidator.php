<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Validators;


class MinuteValidator implements IValidator
{

	public static function validate($value)
	{
		if ( $value >= 0 && $value <= 59 ) {
			return true;
		}

		throw new InvalidHourException(sprintf('Value "%s" is invalid for minute', $value));
	}
}