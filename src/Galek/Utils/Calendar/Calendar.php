<?php

namespace Galek\Utils;
use \Nette\Utils\DateTime;

date_default_timezone_set('Europe/Prague');
/**
 * @author Galek
 */
class Calendar extends DateTime{
    
    /** @var \DateTime */
    private $curDate;
    
    /** @var \DateTime */
    public $date;
    
    /**
     *	Werbs for different between current Date and setted Date (@var $date)
     * @example 0 today
     * @example 1 tomorrow
     * @example 2 after tomorrow
     * @example <5> 'after'
     * @example <5 X days
     * @example >=5 X days
     * @example 0 dnes
     * @example 1 zítra
     * @example 2 pozítří
     * @example <5> 'za'
     * @example <5 X dny
     * @example >=5 X dnů
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
     * @param $time [optional]
     * @param $object [optional]
     */
    public function __construct($time=NULL,$object=NULL) {
		parent::__construct($time, $object);
		
		$this->curDate = new \DateTime();
		
		if(!isset($this->date)){
			$this->date = $this->curDate;
		}
    }
    /**
     * Get Day
     * @return int
     */
    public function getDay(){
		return $this->format("d");
    }
    
    /**
     * Get Month
     * @return int
     */
    public function getMon(){
		return $this->format("m");
    }
    
    /**
     * Get Year
     * @return int
     */
    public function getYear(){
		return (int) $this->format('Y');
    }
    
    /**
     * Get Hour
     * @return int
     */
    public function getHour(){
		return (int) $this->format("H");
    }
    
    /**
     * Get Minute
     * @return int
     */
    public function getMinute(){
		return (int) $this->format("i");
    }
    
    /**
     * Get time Second
     * @return int
     */
    public function getSecond(){
		return $this->format("s");
    }
    
    /**
     * Check Weekend
     * @return boolean
     */
    public function isWeekend(){
		return ($this->dayNumber() >= 6 || $this->dayNumber() == 0 ? TRUE : FALSE);
    }
    /**
     * Check Weekday
     * @return boolean
     */
    public function isWeekday(){
		return ($this->dayNumber() <= 5 && $this->dayNumber() >= 1);
    }
    
    /**
     * Check Monday / Pondělí
     * @return boolean
     */
    public function isMonday(){
		return ($this->dayNumber() == 1);
    }
    
    /**
     * Check Tuesday / Úterý
     * @return boolean
     */
    public function isTuesday(){
		return ($this->dayNumber() == 2);
    }
    
    /**
     * Check Wednesday / Středa
     * @return boolean
     */
    public function isWednesday(){
		return ($this->dayNumber() == 3);
    }
    /**
     * Check Thursday / Čtvrtek
     * @return boolean
     */
    public function isThursday(){
		return ($this->dayNumber() == 4);
    }
    
    /**
     * Check Friday / Pátek
     * @return boolean
     */
    public function isFriday(){
		return ($this->dayNumber() == 5);
    }
    
    /**
     * Check Saturday / Sobota
     * @return boolean
     */
    public function isSaturday(){
		return ($this->dayNumber() == 6);
    }
    
    /**
     * Check Sunday / Neděle
     * @return boolean
     */
    public function isSunday(){
		return ($this->dayNumber() == 0);
    }
    
    /**
     * Check Holiday
     * @return boolean
     */
    public function isHoliday(){
		$date = $this;
		if($this->getEasterMonday()->diff($this)->days == 0){ return TRUE;}
		if($this->getBigFriday()->diff($this)->days == 0){ return TRUE; }

		foreach ($this->svatky as $svatek){
			$testdate = $date->getYear().'-'.$svatek;
			if($this->format('Y-m-d') == $testdate){
				return TRUE;
			}
		}
		return FALSE;
    }
    /**
	 * Check if is Workday
	 * @return boolean
	 */
    public function isWorkDay(){
		if($this->isHoliday()){
			return FALSE;
		}
		if($this->isWeekend()){
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
    public function timeBellow($hour,$minute=0){
		if($this->getHour() <= $hour){
			if($this->getHour() == $hour){
				if($this->getMinute() <= $minute){
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}
		return FALSE;
    }

    /**
     * Get Number of Day
     * @return string
     */
    public function dayNumber(){
		return (int) $this->format('w');
    }
	
    /**
	 * Get formated date d.m.Y
	 * @return type
	 */
    public function getDateFormat(){
		return $this->format('d.m.Y');
    }
	
	/**
	 * Get different between today and $date by world
	 * @param type $werb
	 * @param type $date
	 * @return boolean|string
	 */
    public function werbDif($werb=array(),$date=NULL){
		$curDate = new DateTime();
		$date2 = ($date ? $date : $this);
		$diff = $date2->diff($curDate)->days;

		$werbs = (empty($werb) ? $this->difWerbs : $werb);

		if($diff <= 2){
			$format = $werbs[$diff];
		}elseif ($diff <5) {
			$format = $werbs['<5>'].' '.$diff.' '.$werbs['<5'];
		}elseif ($diff >=5) {
			$format = $werbs['<5>'].' '.$diff.' '.$werbs['>=5'];
		}else{
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
    public function werbDif2($date=NULL,$date2=NULL){
		$curDate = ($date ? $date : new \DateTime());
		$date2 = ($date2 ? $date2 : $this->date);
		$diff = $date2->diff($curDate)->days;

		$werbs = (empty($werb) ? $this->difWerbs : $werb);

		if($diff <= 2){
			$format = $werbs[$diff];
		}elseif ($diff <5) {
			$format = $werbs['<5>'].' '.$diff.' '.$werbs['<5'];
		}elseif ($diff >=5) {
			$format = $werbs['<5>'].' '.$diff.' '.$werbs['>=5'];
		}else{
			return FALSE;
		}
		return $format;
    }

	/**
	 * Get Easter Monday
	 * @param type $rok
	 * @return type
	 */
    public function getEasterMonday($rok=FALSE){
		$velNe = $this->getVelikonoce($rok);
		$day = DateTime::from($velNe);
		$day->modify('+1 day');
		return $day;
    }

	/**
	 * Get Easter Monday
	 * @param type $rok
	 * @return type
	 */
    public function getEaster($rok=FALSE){
		return $this->getVelikonoce($rok);
    }
	
    /**
	 * Is Big Friday (friday before Easter, Czech republic = Holiday) ? 
	 * @param type $rok
	 * @return type
	 */
    public function getBigFriday($rok=FALSE){
		$velNe = $this->getVelikonoce($rok);
		$day = DateTime::from($velNe);
		$day->modify('-2 day');
		return $day;
    }
	
	/**
	 * Function for calculation Easter
	 * @param type $rok
	 * @return type
	 */
    private function getVelikonoce($rok = FALSE){
		if(!$rok){ $rok = $this->getYear();}

		$a=($rok % 19);	    // cyklus stejnych dnu
		$b = ($rok % 4);    // cyklus prestupnych roku
		$c = ($rok % 7);    // dorovnani dne v tydnu

		if($rok >= '1800' and $rok <='1899'){
			$m = 23;
			$n = 4;
		}else if($rok >= '1900' and $rok <= '2099'){
			$m = 24;
			$n = 5;
		}

		$d = (((19 * $a) + $m) % 30);
		$e = (($n + (2 * $b) + (4 * $c) + (6 * $d)) % 7);

		$nedele1 = (22 + $d + $e);
		$nedele2 = ($d + $e - 9);

		return $this->velikonoceCalcDate($rok, $nedele1, $nedele2,$d,$e,$a);
    }
    /**
	 * Checking Easter
	 * @param type $rok
	 * @param type $nedele1
	 * @param type $nedele2
	 * @param type $d
	 * @param type $e
	 * @param type $a
	 * @return boolean
	 */
    private function velikonoceCalcDate($rok,$nedele1,$nedele2,$d,$e,$a){
	
		if($nedele1 >= '22' and $nedele1 <= '31'){
			$datum = $rok.'-03-'.$nedele1;
		}elseif($nedele2 == '25' && $d == '28' && $e == '6' && $a > 10){
			$datum = $rok.'-04-18';
		}elseif($nedele2 <= '25'){
			$datum = $rok.'-04-';
			if($nedele2 <= 9){$datum .='0';}
			$datum .= $nedele2;
		}elseif($nedele2 > 25){
			$datum = $rok.'-04-'.$nedele2-7;
		}else{
			return FALSE;
		}

		return $datum;
    }
    
    /**
     * 
     * @param \DateTime $date
     * @param type $pad
     * @return string
     */
    public function sklonovaniDays($date,$pad=1){
		return $this->sklonovaniDny[$date->format('w')][$pad];
    }

	/**
	 * Get workday
	 * @param boolean $next Get next workday
	 * @param \Galek\Utils\Calendar $date
	 * @return \Galek\Utils\Calendar
	 */
    public function getWorkDay($next=FALSE,$date=FALSE){
		if(!$date){ $date = $this; }

		if($next){
			$date->modify('+1 days');
		}

		if($date->isWeekend()){
			if($date->isSunday()){
				$date->modify('+1 days');
			}else{
				$date->modify('+2 days');
			}
		}else{
			if($date->isHoliday()){
			$date->modify('+1 days');
			}
		}

		return $date;
    }
    /**
	 * Get Shipping time
	 * @param int $hour default FALSE
	 * @param int $minute default 0
	 * @return type
	 */
    public function getShippingTime($hour=FALSE,$minute=0){
		
		$date = $this->getShippingTimeTest($hour, $minute);
		if($date->isWeekend()){
			$date->modify('+1 days');
		}
		$date->getWorkDay(TRUE);
		
		return $date;
    }
	/**
	 * Help for Shipping time
	 * @param int $hour
	 * @param int $minute
	 * @return \Galek\Utils\Calendar
	 */
	public function getShippingTimeTest($hour=FALSE,$minute=0){
		$date = $this;
		if($hour){
			if(!$date->timeBellow($hour, $minute)){
				$date->modify('+1 days');
			}
			if($this->isFriday() || $this->isWeekend()){
				$date->modify('+1 days');
			}
		}
		return $date;
	}
}
