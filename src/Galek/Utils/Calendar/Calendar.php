<?php
declare(strict_types=1);

namespace Galek\Utils;


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
    private $curDate;

    /** @var \DateTime */
    public $date;

  	/** @var int Number of days to delivery */
  	public $shippingtime = 1;

    /**
     *	Werbs for different between current Date and setted Date (@var $date)
     * @example 0 today
     * @example 1 tomorrow
     * @example 2 after tomorrow
     * @example <5> 'after'
     * @example <5 X days
     * @example >=5 X days
     * @var array
     */
    public $difWerbs = [
        '0' => 'dnes',
        '1' => 'zítra',
        '2' => 'pozítří',
        '<5>' => 'za',
        '<5' => 'dny',
        '>=5' => 'dnů',
    ];

    public $sklonovani = [

    ];

    public $sklonovaniDny = [
        0 => [
            1 => 'neděle',
            2 => 'neděle',
            3 => 'neděli',
            4 => 'neděli',
            5 => 'neděle',
            6 => 'neděli',
            7 => 'nedělí',
        ],
        1 => [
            1 => 'pondělí',
            2 => 'pondělí',
            3 => 'pondělí',
            4 => 'pondělí',
            5 => 'pondělí',
            6 => 'pondělí',
            7 => 'pondělí',
        ],
        2 => [
            1 => 'úterý',
            2 => 'úterý',
            3 => 'úterý',
            4 => 'úterý',
            5 => 'úterý',
            6 => 'úterý',
            7 => 'úterý',
        ],
        3 => [
            1 => 'středa',
            2 => 'středy',
            3 => 'středě',
            4 => 'středu',
            5 => 'středo',
            6 => 'středě',
            7 => 'středou',
        ],
        4 => [
            1 => 'čtvrtek',
            2 => 'čtvrtku',
            3 => 'čtvrtku',
            4 => 'čtvrtek',
            5 => 'čtvrtku',
            6 => 'čtvrtku',
            7 => 'čtvrtkem',
        ],
        5 => [
            1 => 'pátek',
            2 => 'pátku',
            3 => 'pátku',
            4 => 'pátek',
            5 => 'pátku',
            6 => 'pátku',
            7 => 'pátkem',
        ],
        6 => [
            1 => 'sobota',
            2 => 'soboty',
            3 => 'sobotě',
            4 => 'sobotu',
            5 => 'sobota',
            6 => 'sobotě',
            7 => 'sobotou',
        ],
    ];


    /** @var array */
    private $svatky = [
        '01-01',
        '03-25',
        '05-01',
        '05-08',
        '07-05',
        '07-06',
        '09-28',
        '10-28',
        '11-17',
        '12-24',
        '12-25',
        '12-26',
    ];

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

    private $shippingWeekend = FALSE;

    const WORKTIME_START = 1,
          WORKTIME_END = 2;

    /**
     * @param string $time [optional]
     * @param $object [optional]
     */
    public function __construct($time = 'now', $object = null)
    {
        parent::__construct($time, $object);

        $this->curDate = new \DateTime();

        if (!isset($this->date)) {
            $this->date = $this->curDate;
        }
    }

	/**
	 * Set number of days to delivery
	 * @param int
	 */
	public function setShippingDays($shippingtime)
    {
  		$this->shippingtime = (int) $shippingtime;
	}

	/**
	 * Get number of days to delivery
	 * @return int
	 */
	public function getShippingDays()
    {
  		return $this->shippingtime;
	}

	/**
     * Get Day
     * @return int
     */
    public function getDay()
    {
        return (int) $this->format("d");
    }

    /**
     * Get Month
     * @return int
     */
    public function getMon()
    {
        return (int) $this->format("m");
    }

    /**
     * Get Year
     * @return int
     */
    public function getYear()
    {
        return (int) $this->format('Y');
    }

    /**
     * Get Hour
     * @return int
     */
    public function getHour()
    {
        return (int) $this->format("G");
    }

    /**
     * Get Minute
     * @return int
     */
    public function getMinute()
    {
        return (int) $this->format("i");
    }

    /**
     * Get time Second
     * @return int
     */
    public function getSecond()
    {
        return (int) $this->format("s");
    }

    /**
     * Check Weekend
     * @return boolean
     */
    public function isWeekend()
    {
        return ($this->dayNumber() >= 6 || $this->dayNumber() == 0 ? TRUE : FALSE);
    }

    /**
     * Check Weekday
     * @return boolean
     */
    public function isWeekday()
    {
        return ($this->dayNumber() <= 5 && $this->dayNumber() >= 1);
    }

    /**
     * Check Monday / Pondělí
     * @return boolean
     */
    public function isMonday()
    {
        return ($this->dayNumber() == 1);
    }

    /**
     * Check Tuesday / Úterý
     * @return boolean
     */
    public function isTuesday()
    {
        return ($this->dayNumber() == 2);
    }

    /**
     * Check Wednesday / Středa
     * @return boolean
     */
    public function isWednesday()
    {
        return ($this->dayNumber() == 3);
    }

    /**
     * Check Thursday / Čtvrtek
     * @return boolean
     */
    public function isThursday()
    {
        return ($this->dayNumber() == 4);
    }

    /**
     * Check Friday / Pátek
     * @return boolean
     */
    public function isFriday()
    {
        return ($this->dayNumber() == 5);
    }

    /**
     * Check Saturday / Sobota
     * @return boolean
     */
    public function isSaturday()
    {
        return ($this->dayNumber() == 6);
    }

    /**
     * Check Sunday / Neděle
     * @return boolean
     */
    public function isSunday()
    {
        return ($this->dayNumber() == 0);
    }

    /**
     * Check work time
     * @return bool
     */
    public function isWorkTime()
    {
        if ($this->isWorkDay()) {
            $startTime = $this->getWorkTime(1);
            $endTime = $this->getWorkTime(2);
            return $this->timeBetween($startTime[0], $startTime[1], $endTime[0], $endTime[1]);
        }

        return FALSE;
    }

    /**
     * Check Holiday
     * @return boolean
     */
    public function isHoliday()
    {
        $date = $this;
        if ($this->getEasterMonday()->diff($this)->days == 0) {
            return TRUE;
        }

        if ($this->getBigFriday()->diff($this)->days == 0) {
            return TRUE;
        }

        foreach ($this->svatky as $svatek) {
            $testdate = $date->getYear() . '-' . $svatek;

            if ($this->format('Y-m-d') == $testdate) {
                return TRUE;
            }
        }
        return FALSE;
    }
    /**
    * Check if is Workday
    * @return boolean
    */
    public function isWorkDay($date = FALSE)
    {
        if ($date === FALSE) {
            $testDate = $this;
        } else {
            $testDate = $date;
        }

    	if ($testDate->isHoliday()) {
    		return FALSE;
    	}
    	if ($testDate->isWeekend()) {
    		return FALSE;
    	}
    	return TRUE;
    }

    /**
     * Check Time bellow
     * @param int $hour
     * @param int $minute format: 1,2,3,..9,10,...
     * @return boolean
     */
    public function timeBellow($hour, $minute = 0)
    {
        if ($this->getHour() <= $hour) {
            return ($this->getHour() == $hour ? ($this->getMinute() <= $minute) : TRUE);
        }
        return FALSE;
    }

    /**
     * Check Time over
     * @param int $hour
     * @param int $minute
     * @return bool
     */
    public function timeOver($hour, $minute = 0)
    {
        if ($this->getHour() >= $hour) {
            return ($this->getHour() == $hour ? ($this->getMinute() >= $minute) : TRUE);
        }
        return FALSE;
    }

    /**
     * @param int $firstHour
     * @param int $firstMinute
     * @param int $lastHour
     * @param int $lastMinute
     * @return bool
     */
    public function timeBetween($firstHour, $firstMinute, $lastHour, $lastMinute)
    {
        if ($firstHour > $lastHour) {
            $date = $this->getDay() . '.' . $this->getMon() . '.' . $this->getYear();

            $firstDate = new Calendar($date . ' ' . $firstHour . ':' . $firstMinute);
            $lastDate = new Calendar($date . ' ' . $lastHour . ':' . $lastMinute);
            $lastDate->modify('+1 day');

            if ($this->getTimestamp() >= $firstDate->getTimestamp()) {
                if ($this <= $lastDate) {
                    return TRUE;
                }
            } elseif ($this <= $lastDate) {
                return TRUE;
            }

            return FALSE;
        }

        return ($this->timeBellow($lastHour, $lastMinute) ? $this->timeOver($firstHour, $firstMinute) : FALSE);
    }

    /**
     * Get Number of Day
     * @return string
     */
    public function dayNumber()
    {
        return (int) $this->format('w');
    }

    /**
	 * Get format date d.m.Y
	 * @return string
	 */
    public function getDateFormat()
    {
        return $this->format('d.m.Y');
    }

    /**
     * Get format date d.m.Y H:i:s
     * @return string
     */
    public function getDateTimeFormat()
    {
        return $this->format('d.m.Y  H:i:s');
    }

	/**
	 * Get different between today and $date by world
	 * @param array $werb
	 * @param null|DateTime $date
	 * @return boolean|string
	 */
    public function werbDif($werb = [], $date = NULL)
    {
        $curDate = new Calendar();
        $date2 = ($date ? $date : $this);
        $diff = $date2->diff($curDate)->days;

        $werbs = (empty($werb) ? $this->difWerbs : $werb);

        if ($diff <= 2) {
            $format = $werbs[$diff];
        } elseif ($diff < 5) {
            $format = $werbs['<5>'] . ' ' . $diff . ' ' . $werbs['<5'];
        } elseif ($diff >= 5) {
            $format = $werbs['<5>'] . ' ' . $diff.' '. $werbs['>=5'];
        } else {
            return FALSE;
        }
        return $format;
    }

	/**
	 * Get different between 2 day by world
	 * @param type $date
	 * @param type $date2
	 * @return boolean|string
	 */
    public function werbDif2($date = null, $date2 = null)
    {
        $curDate = ($date ? $date : new \DateTime());
        $date2 = ($date2 ? $date2 : $this->date);
        $diff = $date2->diff($curDate)->days;

        $werbs = (empty($werb) ? $this->difWerbs : $werb);

        if ($diff <= 2) {
            $format = $werbs[$diff];
        } elseif ($diff < 5) {
            $format = $werbs['<5>'] . ' ' . $diff . ' ' . $werbs['<5'];
        } elseif ($diff >= 5) {
            $format = $werbs['<5>'] . ' ' . $diff . ' ' . $werbs['>=5'];
        } else {
            return FALSE;
        }
        return $format;
    }

	/**
	 * Get Easter Monday
	 * @param bool|integer $rok
	 * @return DateTime
	 */
    public function getEasterMonday($rok = FALSE)
    {
        $velNe = $this->getVelikonoce($rok);
        $day = DateTime::from($velNe);
        $day->modify('+1 day');
        return $day;
    }

	/**
	 * Get Easter
	 * @param bool|integer $rok
	 * @return type
	 */
    public function getEaster($rok = FALSE)
    {
        return $this->getVelikonoce($rok);
    }

    /**
	 * Is Big Friday (friday before Easter, Czech republic = Holiday) ?
	 * @param bool|integer $rok
	 * @return type
	 */
    public function getBigFriday($rok = FALSE)
    {
        $velNe = $this->getVelikonoce($rok);
        $day = DateTime::from($velNe);
        $day->modify('-2 day');
        return $day;
    }

	/**
	 * Function for calculation Easter
	 * @param boolean|integer $rok
	 * @return type
	 */
    private function getVelikonoce($rok = FALSE)
    {
        if (!$rok) {
          $rok = $this->getYear();
        }

        $a = ($rok % 19);	    // cyklus stejnych dnu
        $b = ($rok % 4);    // cyklus prestupnych roku
        $c = ($rok % 7);    // dorovnani dne v tydnu

        if ($rok >= '1800' AND $rok <='1899') {
            $m = 23;
            $n = 4;
        } else if ($rok >= '1900' AND $rok <= '2099') {
            $m = 24;
            $n = 5;
        }

        $d = ( ( (19 * $a) + $m) % 30);
        $e = ( ($n + (2 * $b) + (4 * $c) + (6 * $d) ) % 7);

        $nedele1 = (22 + $d + $e);
        $nedele2 = ($d + $e - 9);

        return $this->velikonoceCalcDate($rok, $nedele1, $nedele2, $d, $e, $a);
    }

    /**
	 * Checking Easter
	 * @param type $rok
	 * @param mixed $nedele1
	 * @param mixed $nedele2
	 * @param type $d
	 * @param type $e
	 * @param type $a
	 * @return boolean
	 */
    private function velikonoceCalcDate($rok, $nedele1, $nedele2, $d, $e, $a)
    {
        if ($nedele1 >= '22' and $nedele1 <= '31') {
            $datum = $rok . '-03-' . $nedele1;
        } elseif ($nedele2 == '25' && $d == '28' && $e == '6' && $a > 10) {
            $datum = $rok . '-04-18';
        } elseif ($nedele2 <= '25') {
            $datum = $rok . '-04-';
            if ($nedele2 <= 9) {
                $datum .= '0';
            }
            $datum .= $nedele2;
        } elseif ($nedele2 > 25) {
            $datum = $rok . '-04-' . $nedele2 - 7;
        } else {
            return FALSE;
        }

        return new Calendar($datum);
    }

    /**
     * @param \DateTime $date
     * @param integer $pad
     * @return string
     */
    public function sklonovaniDays($date, $pad = 1)
    {
        return $this->sklonovaniDny[$date->format('w')][$pad];
    }

    /**
     * Get workday
     * @param bool|Calendar|\DateTime|DateTime $next
     * @param bool|Calendar $date
     * @return bool|\DateTime|Calendar|DateTime
     */
    public function getWorkDay($next = FALSE, $date = FALSE)
    {
    	if (!$date) {
            $date = $this;
        }

        if ($next instanceof Calendar OR $next instanceof \DateTime OR $next instanceof DateTime) {
            $date = $next;
            $next = FALSE;
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
     * @return bool|Calendar
     */
    public function GetWorkDayLimit($workTime = TRUE, $date = FALSE)
    {
        if (!$date) {
            $date = $this;
        }

        if ($workTime == TRUE) {
            $limit = $this->getWorkTime();
            $sH = $limit[0][0];
            $sM = $limit[0][1];
            $eH = $limit[1][0];
            $eM = $limit[1][1];

            if ($this->timeBellow($eH, $eM) == FALSE) {
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
    public function setWorkTime($worktime, $startMinute = FALSE, $endHour = FALSE, $endMinute = FALSE)
    {
        if (is_array($worktime)) {

            if (is_array($worktime[0])) {

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

        } elseif (is_int( (int) $worktime)) {
            $startHour = $worktime;
            $startMinute = (int) $startMinute;
            $endHour = (int) $endHour;
            $endMinute = (int) $endMinute;
        } else {
            throw new \Exception( "Value '$worktime' is not allowed, use array (full list) or int (hour)" );
        }

        if ($startHour < 0 OR $startHour > 23) {
           throw new \Exception( "Try set bad value of start work time hour ('$startHour'), use 0-23." );
        }

        if ($endHour < 0 OR $endHour > 23) {
           throw new \Exception( "Try set bad value of end work time hour ('$endHour'), use 0-23." );
        }

        if ($startMinute < 0 OR $startMinute > 59) {
           throw new \Exception( "Try set bad value of start work time minute ('$startMinute'), use 0-59." );
        }

        if ($endMinute < 0 OR $endMinute > 59) {
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
    public function getWorkTime($type = FALSE)
    {
        if ($type === FALSE) {
            return $this->working_time;
        }

        $type = (int) $type;

        if ($type == self::WORKTIME_START) {
            return $this->working_time[0];
        } elseif ($type == self::WORKTIME_END) {
            return $this->working_time[1];
        }

        throw new \Exception( "Value '$type' is not allowed, you can use (FALSE, 1, 2)" );
    }

    /**
     * Enable Shipping at weekend
     * @return Calendar
     */
    public function enableShippingWeekend()
    {
        $this->shippingWeekend = TRUE;
        return $this;
    }

    /**
     * Disable Shipping at weekend
     * @return Calendar
     */
    public function disableShippingWeekend()
    {
        $this->shippingWeekend = FALSE;
        return $this;
    }

    /**
     * Set Shipping time
     * @param int $endHour
     * @param int $endMinute
     * @return Calendar
     */
    public function setShippingTime($endHour, $endMinute)
    {
        $this->shipping_time['hour'] = $endHour;
        $this->shipping_time['minute'] = $endMinute;
        return $this;
    }

    /**
     * Get Shipping Date
     * @return Calendar
     */
    public function getShippingDate()
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

    /**
	 * Get Shipping time
	 * @param int|boolean $hour default FALSE
	 * @param int $minute default 0
     * @deprecated Please Use setShippingTime and getShippingDate
	 * @return Calendar
	 */
    public function getShippingTime($hour = FALSE, $minute = 0)
    {
        trigger_error('getShippingTime is deprecated, use setShippingTime($hour, $minute) and getShippingDate().', E_USER_DEPRECATED);
        return $this->getShippingDate();
    }
    /**
     * Help for Shipping time
     * @param int|boolean $hour
     * @param int $minute
     * @deprecated Please Use setShippingTime and getShippingDate
     * @return Calendar
     */
 	public function getShippingTimeTest($hour = FALSE, $minute = 0, $date = NULL)
    {
        trigger_error('getShippingTimeTest is deprecated, use setShippingTime($hour, $minute) and getShippingDate().', E_USER_DEPRECATED);
        return $this->getShippingDate();
 	}
}
