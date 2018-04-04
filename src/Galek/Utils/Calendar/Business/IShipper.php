<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 4.4.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Business;


use Galek\Utils\Calendar\Calendar;


interface IShipper
{
	public function getName(): string ;

	public function getCurrentDate(): Calendar;

	public function getDate(): Calendar;

	public function setTime(int $hour, int $minute): void;

	public function setHour(int $hour): void;

	public function setMinute(int $minute): void;

	public function getHour(): int;

	public function getMinute(): int;

	public function enableWeekend($value = true): void;

	public function disableWeekend(): void;
}
