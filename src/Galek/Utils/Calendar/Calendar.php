<?php
declare(strict_types=1);

namespace Galek\Utils\Calendar;

use Galek\Utils\Calendar\Enum\Country;
use Nette\Utils\DateTime;

date_default_timezone_set('Europe/Prague');

/**
 * Extensions function to \Nette\Utils\DateTime
 * @author Galek
 *
 */
class Calendar extends DateTime
{
    /** @var \DateTime */
    public $date;

  	/** @var int Number of days to delivery */
  	public $shippingtime = 1;

    /**
      * Use 24 hours type
      * ['work start ([hour,minute])', 'work_end ([hour,minute])']
      * @example [ ['8','0'], ['16','30'] ]
      * @var array
      */
    private $working_time = [
        ['8', '0'],
        ['16', '0'],
    ];

    private $shipping_time = [
        'hour' => '16', 'minute' => '30'
    ];

    private $shippingWeekend = false;

    const WORKTIME_START = 1,
          WORKTIME_END = 2;

	/**
	 * @var Localization
	 */
	private $localization;

	/**
	 * @var Holidays
	 */
	private $holidays;


	/**
     * @param string $time [optional]
     * @param $object [optional]
	 * @param string $localization
	 * @param string $country
     */
    public function __construct($time = 'now', $object = null, $localization = 'cs', $country = Country::CZ)
    {
        parent::__construct($time, $object);

        if (null === $this->date) {
            $this->date = new \DateTime();
        }

        $this->setLocalization($localization);
        $this->setHolidays($country);
	}


	public function setHolidays(string $country)
	{
		$this->holidays = new Holidays($country);
		return $this;
	}


	public function getHolidays()
	{
		return $this->holidays;
	}


	public function setLocalization(string $localization)
	{
		$this->localization = new Localization($localization);
		return $this;
	}


	public function getLocalization()
	{
		return $this->localization;
	}


	/**
	 * Set number of days to delivery
	 * @param int
	 */
	public function setShippingDays($shippingtime): void
    {
  		$this->shippingtime = (int) $shippingtime;
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
	 * Get number of days to delivery
	 * @return int
	 */
	public function getShippingDays(): int
    {
  		return $this->shippingtime;
	}

	/**
     * Get Day
     * @return int
     */
    public function getDay(): int
    {
        return (int) $this->format("d");
    }

    /**
     * Get Month
     * @return int
     */
    public function getMon(): int
    {
        return (int) $this->format('m');
    }

    /**
     * Get Month
     * @return int
     */
    public function getMonth(): int
    {
        return $this->getMon();
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


    public function isWorkTime(): bool
    {
        if ($this->isWorkDay()) {
            $startTime = $this->getWorkTime(1);
            $endTime = $this->getWorkTime(2);
            return $this->timeBetween($startTime[0], $startTime[1], $endTime[0], $endTime[1]);
        }

        return false;
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
    	return Day::isWork($this->holidays, $date ?: $this);
    }


    public function getDaysInMonth(int $year, int $month)
    {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }


    public function getWorkDayNumberInMonth(int $month, int $year)
    {
        return $this->getWorkDayNumberInMonthTo($month, $year, $this->getDaysInMonth($year, $month));
    }


    public function getWorkDayNumberInMonthTo(int $month, int $year, int $day): int
    {
        $dayCount = $this->getDaysInMonth($year, $month);
        if ($day > $dayCount) {
            $day = $dayCount;
        }

        $date = new Calendar();
        $date->setDate($year, $month, 1);

        $number = 0;

        for ($i = 1; $i <= $day; $i++) {
            $date->setDay($i);
            if ($date->isWorkDay()) {
                $number++;
            }
        }

        return $number;
    }

    /**
     * Check Time bellow
     * @param int $hour
     * @param int $minute format: 1,2,3,..9,10,...
     * @return boolean
     */
    public function timeBellow(int $hour, int $minute = 0): bool
    {
        return Time::bellow($this, $hour, $minute);
    }

    /**
     * Check Time over
     * @param int $hour
     * @param int $minute
     * @return bool
     */
    public function timeOver(int $hour, int $minute = 0): bool
    {
        return Time::over($this, $hour, $minute);
    }

    /**
     * @param int $firstHour
     * @param int $firstMinute
     * @param int $lastHour
     * @param int $lastMinute
     * @return bool
     */
    public function timeBetween(int $firstHour, int $firstMinute, int $lastHour, int $lastMinute): bool
    {
    	return Time::between($this, $firstHour, $firstMinute, $lastHour, $lastMinute);
    }


    public function dayNumber(): int
    {
        return (int) $this->format('w');
    }

    /**
	 * Get format date d.m.Y
	 * @return string
	 */
    public function getDateFormat(): string
    {
        return $this->format('d.m.Y');
    }

    /**
     * Get format date d.m.Y H:i:s
     * @return string
     */
    public function getDateTimeFormat(): string
    {
        return $this->format('d.m.Y H:i:s');
    }

	/**
	 * Get different between today and $date by world
	 * @param null|DateTime $date
	 * @return string
	 */
    public function werbDif($date = null): string
    {
        $curDate = new Calendar();
        $date2 = ($date ?: $this);
        $diff = $date2->diff($curDate)->days;

		$local = $this->localization->getDifference();

        if ($diff === 0) {
        	return $local['today'];
		} elseif ($diff === 1) {
			return $local['tomorrow'];
        } elseif ($diff === 2) {
			return $local['afterTomorrow'];
		} elseif ($diff < 5) {
        	return $local['after'] . ' ' . $diff . ' ' . $local['twoDays'];
        }

		return $local['after'] . ' ' . $diff . ' ' . $local['fiveDays'];
    }

	/**
	 * Get Easter Monday
	 * @param bool|int $year
	 * @return Calendar
	 */
    public function getEasterMonday($year = false): Calendar
    {
    	$year = ($year === false ? $this->getYear() : $year);
        return EasterHoliday::getMonday($year);
    }

	/**
	 * Get Easter
	 * @param bool|int $year
	 * @return Calendar
	 */
    public function getEaster($year = false): Calendar
    {
		$year = ($year === false ? $this->getYear() : $year);
		return EasterHoliday::getEaster($year);
    }

	/**
	 * Is Big Friday (friday before Easter, Czech republic = Holiday) ?
	 * @param bool|int $year
	 * @return Calendar
	 */
	public function getGoodFriday($year = false): Calendar
	{
		$year = ($year === false ? $this->getYear() : $year);
		return EasterHoliday::getGoodFriday($year);
	}


    /**
     * @param \DateTime $date
     * @param integer $pad
     * @return string
     */
    public function sklonovaniDays($date, $pad = 1): string
    {
    	return $this->localization->getInflexion($date->format('w'), $pad);
    }

    /**
     * Get workday
     * @param bool|Calendar|\DateTime|DateTime $next
     * @param bool|Calendar $date
     * @return Calendar
     */
    public function getWorkDay($next = false, $date = false): Calendar
    {
    	if (!$date) {
            $date = $this;
        }

        if ($next instanceof \DateTime) {
            $date = $next;
            $next = false;
        }

		if ($next) {
  			$date->modify('+1 days');
		}

		if ($date->isWeekend()) {
  			if ($date->isSunday()) {
                $date->modify('+1 days');
  			} else {
                $date->modify('+2 days');
  			}
		} elseif ($date->isHoliday()) {
            $date->modify('+1 days');
		}

        if (!$this->isWorkDay($date)) {
            $this->getWorkDay();
        }

	    return $date;
    }

    /**
     * @param bool $workTime
     * @param bool $date
     * @return Calendar
     */
    public function GetWorkDayLimit($workTime = true, $date = false): Calendar
    {
        if (!$date) {
            $date = $this;
        }

        if ($workTime === true) {
            $limit = $this->getWorkTime();
            $sH = $limit[0][0];
            $sM = $limit[0][1];
            $eH = $limit[1][0];
            $eM = $limit[1][1];

            if ($this->timeBellow($eH, $eM) === false) {
                $date->modify('+1 days');
            }
        }

        $date->getWorkDay();
        return $date;
    }

    /**
     *
     * @param mixed $worktime    Work time in array () or hour of work time (int)
     * @param int|boolean $startMinute [description]
     * @param int|boolean $endHour     [description]
     * @param int|boolean $endMinute   [description]
     * @return Calendar
     * @throws \Exception
     */
    public function setWorkTime($worktime, $startMinute = false, $endHour = false, $endMinute = false): Calendar
    {
        if (\is_array($worktime)) {

            if (\is_array($worktime[0])) {

                $startHour = (int) $worktime[0][0];
                $startMinute = (int) $worktime[0][1];

                if (isset($worktime[1])) {
                    $endHour = $worktime[1][0];
                    $endMinute = $worktime[1][1];
                }

                if (isset($worktime[0][2])) {
                    $endHour = $worktime[0][2];
                }

                if (isset($worktime[0][3])) {
                    $endMinute = $worktime[0][3];
                }
            } else {
                $startHour = $worktime[0];
                $startMinute = (int) $worktime[1];
                $endHour = (int) $worktime[2];
                $endMinute = (int) $worktime[3];
            }

        } elseif (is_numeric($worktime)) {
            $startHour = $worktime;
            $startMinute = (int) $startMinute;
            $endHour = (int) $endHour;
            $endMinute = (int) $endMinute;
        } else {
            throw new \Exception( "Value '$worktime' is not allowed, use array (full list) or int (hour)" );
        }

        if ($startHour < 0 || $startHour > 23) {
           throw new \Exception( "Try set bad value of start work time hour ('$startHour'), use 0-23." );
        }

        if ($endHour < 0 || $endHour > 23) {
           throw new \Exception( "Try set bad value of end work time hour ('$endHour'), use 0-23." );
        }

        if ($startMinute < 0 || $startMinute > 59) {
           throw new \Exception( "Try set bad value of start work time minute ('$startMinute'), use 0-59." );
        }

        if ($endMinute < 0 || $endMinute > 59) {
           throw new \Exception( "Try set bad value of end work time minute ('$endMinute'), use 0-59." );
        }
        $this->working_time = [ [(int) $startHour, (int) $startMinute], [(int) $endHour, (int) $endMinute] ];

        return $this;
    }

    /**
     * @param bool $type
     * @return array|mixed
     * @throws \Exception
     */
    public function getWorkTime($type = false)
    {
        if ($type === false) {
            return $this->working_time;
        }

        $type = (int) $type;

        if ($type === self::WORKTIME_START) {
            return $this->working_time[0];
        } elseif ($type === self::WORKTIME_END) {
            return $this->working_time[1];
        }

        throw new \Exception( "Value '$type' is not allowed, you can use (false, 1, 2)" );
    }

    /**
     * Enable Transport at weekend
     * @return Calendar
     */
    public function enableShippingWeekend(): Calendar
    {
        $this->shippingWeekend = true;
        return $this;
    }

    /**
     * Disable Transport at weekend
     * @return Calendar
     */
    public function disableShippingWeekend(): Calendar
    {
        $this->shippingWeekend = false;
        return $this;
    }

    /**
     * Set Transport time
     * @param int $endHour
     * @param int $endMinute
     * @return Calendar
     */
    public function setShippingTime($endHour, $endMinute): Calendar
    {
        $this->shipping_time['hour'] = $endHour;
        $this->shipping_time['minute'] = $endMinute;
        return $this;
    }

    /**
     * Get Transport Date
     * @return Calendar
     */
    public function getShippingDate(): Calendar
    {
        $shippingTime = $this->shipping_time;
        $hour = $shippingTime['hour'];
        $minute = $shippingTime['minute'];

        $date = clone $this;

        //if ($date->isFriday()) {
        if ($date->isWorkDay()) {
            if ($date->timeOver($hour, $minute)) {
                $date->modify('+1 days');
            }

            if (!$this->shippingWeekend) {
                $date = $date->getWorkDay();
            }
        }

        if (!$date->isWorkDay()) {
            if (!$this->shippingWeekend) {
                $date = $date->getWorkDay();
            }
        }
        $date->modify('+' . $this->shippingtime . ' days');
        if (!$this->shippingWeekend) {
            $date = $date->getWorkDay();
        }

        return $date;
    }
}
