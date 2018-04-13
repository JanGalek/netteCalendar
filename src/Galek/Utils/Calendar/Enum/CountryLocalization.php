<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar\Enum;


class CountryLocalization
{
	public static $list = [
		Country::CZ => Localization::CZ,
		Country::SK => Localization::SK,
		Country::PL => Localization::PL,
		Country::DE => Localization::DE,
		Country::AT => Localization::DE,
	];
}
