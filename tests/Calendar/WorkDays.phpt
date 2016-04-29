<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class WorkDaysTest extends CalendarTestCase{

    public function testWorkday1(){
	
		$date = new Calendar(self::daterelease.' 14:02');

		Assert::equal(self::daterelease, $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal(self::daterelease, $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(5, $date->dayNumber(),'Start is Day number 5 ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(FALSE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isHoliday(),'Start is holday ?');
		Assert::equal(FALSE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(TRUE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal(self::daterelease, $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }
    public function testWorkday2(){
	
		$date = new Calendar('30.04.2016 14:02');

		Assert::equal('30.04.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal('30.04.2016', $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(2016, $date->getYear(),'Start is year 2016 ?');
		Assert::equal(6, $date->dayNumber(),'Start is Day number 6 ?');
		Assert::equal(TRUE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(FALSE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isHoliday(),'Start is holiday '.$date->format( 'd.m.Y H:i').' ?');
		Assert::equal(TRUE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(FALSE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }
    public function testWorkday3(){
	
		$date = new Calendar('01.05.2016 14:02');

		Assert::equal('01.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal('01.05.2016', $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(0, $date->dayNumber(),'Start is Day number 0 ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(TRUE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Sunday ?');
		Assert::equal(TRUE, $date->isHoliday(),'Start is holiday ?');
		Assert::equal(TRUE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(FALSE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }
    public function testWorkday4(){
	
		$date = new Calendar('02.05.2016 14:02');

		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal('02.05.2016', $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(1, $date->dayNumber(),'Start is Day number 1 ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(FALSE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isHoliday(),'Start is holday ?');
		Assert::equal(FALSE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(TRUE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }
    public function testWorkday5(){
	
		$date = new Calendar('03.05.2016 14:02');

		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal('03.05.2016', $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(2, $date->dayNumber(),'Start is Day number 2 ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(FALSE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isHoliday(),'Start is holday ?');
		Assert::equal(FALSE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(TRUE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('04.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }
    public function testWorkday6(){
	
		$date = new Calendar('04.05.2016 14:02');

		Assert::equal('04.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal('04.05.2016', $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(3, $date->dayNumber(),'Start is Day number 3 ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(FALSE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isHoliday(),'Start is holday ?');
		Assert::equal(FALSE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(TRUE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal('04.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('05.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }
    public function testWorkday7(){
	
		$date = new Calendar('05.05.2016 14:02');

		Assert::equal('05.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
		Assert::equal('05.05.2016', $date->getDateFormat(), 'dneska pracovni den');
		Assert::equal(4, $date->dayNumber(),'Start is Day number 4 ?');
		Assert::equal(FALSE, $date->isSaturday(),'Start is Saturday ?');
		Assert::equal(FALSE, $date->isSunday(),'Start is Sunday ?');
		Assert::equal(FALSE, $date->isHoliday(),'Start is holday ?');
		Assert::equal(FALSE, $date->isWeekend(),'Start is weekend ?');
		Assert::equal(TRUE, $date->isWorkDay(),'Start is workday ?');

		$date->getWorkDay();
		Assert::equal('05.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getWorkDay(TRUE);
		Assert::equal('06.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

}

$testCase = new WorkDaysTest();
$testCase->run();