<?php
declare(strict_types = 1);

namespace Galek\Utils\Calendar;

use Galek\Utils\Calendar\Configuration\Localization as ConfLocalization;
use Nette\Utils\DateTime;

date_default_timezone_set('Europe/Prague');

/**
 * Extensions function to \Nette\Utils\DateTime
 * @author Galek
 *
 */
class Calendar extends DateTime
{
	/**
	 * @var ConfLocalization
	 */
	private $configuration;


	/**
	 * @param string $time [optional]
	 * @param $object [optional]
	 * @param $configuration ConfLocalization
	 */
	public function __construct($time = 'now', $object = null, ConfLocalization $configuration = null)
	{
		parent::__construct($time, $object);
		$this->configuration = $configuration ?? new ConfLocalization();
	}


	public function setHolidays(string $country): void
	{
		$this->configuration->setHolidays($country);
	}


	public function getHolidays()
	{
		return $this->configuration->getHolidays();
	}


	public function setLocalization(string $localization)
	{
		$this->configuration->setLocalization($localization);
		return $this;
	}


	public function getLocalization()
	{
		return $this->configuration->getLocalization();
	}


	public function setYear($year): void
	{
		$this->setDate($year, $this->getMonth(), $this->getDay());
	}


	public function setMonth($month): void
	{
		$this->setDate($this->getYear(), $month, $this->getDay());
	}


	public function setDay($day): void
	{
		$this->setDate($this->getYear(), $this->getMonth(), $day);
	}

	/**
	 * Get Day
	 * @return int
	 */
	public function getDay(): int
	{
		return (int) $this->format('d');
	}


	/**
	 * Get Month
	 * @return int
	 */
	public function getMonth(): int
	{
		return (int) $this->format('m');
	}

	/**
	 * Get Year
	 * @return int
	 */
	public function getYear(): int
	{
		return (int) $this->format('Y');
	}

	/**
	 * Get Hour
	 * @return int
	 */
	public function getHour(): int
	{
		return (int) $this->format('G');
	}

	/**
	 * Get Minute
	 * @return int
	 */
	public function getMinute(): int
	{
		return (int) $this->format('i');
	}

	/**
	 * Get time Second
	 * @return int
	 */
	public function getSecond(): int
	{
		return (int) $this->format('s');
	}

	/**
	 * Check Weekend
	 * @return bool
	 */
	public function isWeekend(): bool
	{
		return Day::isWeekend($this);
	}

	/**
	 * Check Weekday
	 * @return bool
	 */
	public function isWeekday(): bool
	{
		return Day::isWeek($this);
	}

	/**
	 * Check Monday
	 * @return bool
	 */
	public function isMonday(): bool
	{
		return Day::isMonday($this);
	}

	/**
	 * Check Tuesday
	 * @return bool
	 */
	public function isTuesday(): bool
	{
		return Day::isTuesday($this);
	}

	/**
	 * Check Wednesday
	 * @return bool
	 */
	public function isWednesday(): bool
	{
		return Day::isWednesday($this);
	}

	/**
	 * Check Thursday
	 * @return bool
	 */
	public function isThursday(): bool
	{
		return Day::isThursday($this);
	}

	/**
	 * Check Friday
	 * @return bool
	 */
	public function isFriday(): bool
	{
		return Day::isFriday($this);
	}

	/**
	 * Check Saturday
	 * @return bool
	 */
	public function isSaturday(): bool
	{
		return Day::isSaturday($this);
	}

	/**
	 * Check Sunday
	 * @return bool
	 */
	public function isSunday(): bool
	{
		return Day::isSunday($this);
	}


	/**
	 * Check Holiday
	 * @return bool
	 */
	public function isHoliday(): bool
	{
		return $this->getHolidays()->isHoliday($this);
	}


	/**
	 * Check if is Workday
	 * @param \DateTime|null $date
	 * @return bool
	 */
	public function isWorkDay(\DateTime $date = null): bool
	{
		return Day::isWork($this->configuration->getHolidays(), $date ?: $this);
	}
}
