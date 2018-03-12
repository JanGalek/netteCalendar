<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Business;


use Galek\Utils\Calendar\Validators\HourValidator;
use Galek\Utils\Calendar\Validators\MinuteValidator;


class Work
{
	public function __construct(int $startHour, int $startMinute, int $endHour, int $endMinute)
	{
		HourValidator::validate($startHour);
		MinuteValidator::validate($startMinute);
		HourValidator::validate($endHour);
		MinuteValidator::validate($endMinute);
	}


	public function isWork()
	{

	}
}