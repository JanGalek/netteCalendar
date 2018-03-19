<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Validators;

use Galek\Utils\Calendar\Enum\Country;
use Galek\Utils\Calendar\Exceptions\InvalidHourException;


class CountryValidator implements IValidator
{

	public static function validate($value): bool
	{
		if ( \in_array($value, Country::$list, false) ) {
			return true;
		}

		throw new InvalidHourException(sprintf('Value "%s" is invalid for country', $value));
	}

}
