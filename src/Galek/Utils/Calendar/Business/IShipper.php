<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 4.4.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar\Business;


use Galek\Utils\Calendar\Calendar;


interface IShipper
{
	public function getName(): string;

	public function getCurrentDate(): Calendar;

	public function setCurrentDate(Calendar $date = null);

	public function getDate(): Calendar;

	public function getDeliveryTextDate(string $format = 'Y.m.d'): string;

	public function setTime(int $hour, int $minute): void;

	public function setHour(int $hour): void;

	public function setMinute(int $minute): void;

	public function getHour(): int;

	public function getMinute(): int;

	public function enableWeekend($value = true): void;

	public function disableWeekend(): void;
}
