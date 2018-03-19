<?php
/**
 * Created by PhpStorm.
 * User: Jan Galek
 * Date: 10.03.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Business;


use Galek\Utils\Calendar\Calendar;
use Galek\Utils\Calendar\Configuration\Localization;
use Galek\Utils\Calendar\Day;
use Galek\Utils\Calendar\Holidays;
use Galek\Utils\Calendar\Validators\HourValidator;
use Galek\Utils\Calendar\Validators\MinuteValidator;


class Work
{
	/**
	 * @var Localization
	 */
	private $localization;


	public function __construct(Localization $localization, int $startHour, int $startMinute, int $endHour, int $endMinute)
	{
		HourValidator::validate($startHour);
		MinuteValidator::validate($startMinute);
		HourValidator::validate($endHour);
		MinuteValidator::validate($endMinute);
		$this->localization = $localization;
	}


	public function getCurrentDate(): Calendar
	{
		$date = new Calendar('now', null, $this->localization);
		return $date;
	}


	public function isWork(Calendar $date = null): bool
	{
		$date = $date ?: $this->getCurrentDate();
		return Day::isWork($this->localization->getHolidays(), $date);
	}


	public function getDay($date = null): Calendar
	{
		$date = $date ?: $this->getCurrentDate();

		if (Day::isWeekend($date)) {
			if (Day::isSunday($date)) {
				$date->modify('+1 days');
			} else {
				$date->modify('+2 days');
			}
		} elseif ($this->localization->getHolidays()->isHoliday($date)) {
			$date->modify('+1 days');
		}

		if (!$this->isWork($date)) {
			$this->getNext();
		}

		return $date;
	}


	public function getNext($date = null): Calendar
	{
		$date = $date ?: $this->getCurrentDate();
		$date->modify('+1 days');
		$date = $this->getDay($date);
		return $date;
	}
}