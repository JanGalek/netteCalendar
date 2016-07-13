<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class WorkDaysTest extends CalendarTestCase
{

    public function testWorkday1()
    {
    		$date = new Calendar(self::daterelease.' 14:02');

    		Assert::equal(self::daterelease, $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal(self::daterelease, $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(5, $date->dayNumber(),'Start is Day number 5 ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(false, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isHoliday(),'Start is holday ?');
    		Assert::equal(false, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(true, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal(self::daterelease, $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday2()
    {
    		$date = new Calendar('30.04.2016 14:02');

    		Assert::equal('30.04.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal('30.04.2016', $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(2016, $date->getYear(),'Start is year 2016 ?');
    		Assert::equal(6, $date->dayNumber(),'Start is Day number 6 ?');
    		Assert::equal(true, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(false, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isHoliday(),'Start is holiday '.$date->format( 'd.m.Y H:i').' ?');
    		Assert::equal(true, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(false, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday3()
    {
    		$date = new Calendar('01.05.2016 14:02');

    		Assert::equal('01.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal('01.05.2016', $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(0, $date->dayNumber(),'Start is Day number 0 ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(true, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Sunday ?');
    		Assert::equal(true, $date->isHoliday(),'Start is holiday ?');
    		Assert::equal(true, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(false, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday4()
    {
    		$date = new Calendar('02.05.2016 14:02');

    		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal('02.05.2016', $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(1, $date->dayNumber(),'Start is Day number 1 ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(false, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isHoliday(),'Start is holday ?');
    		Assert::equal(false, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(true, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday5()
    {
    		$date = new Calendar('03.05.2016 14:02');

    		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal('03.05.2016', $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(2, $date->dayNumber(),'Start is Day number 2 ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(false, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isHoliday(),'Start is holday ?');
    		Assert::equal(false, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(true, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('04.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday6()
    {
    		$date = new Calendar('04.05.2016 14:02');

    		Assert::equal('04.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal('04.05.2016', $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(3, $date->dayNumber(),'Start is Day number 3 ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(false, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isHoliday(),'Start is holday ?');
    		Assert::equal(false, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(true, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('04.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('05.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday7()
    {
    		$date = new Calendar('05.05.2016 14:02');

    		Assert::equal('05.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal('05.05.2016', $date->getDateFormat(), 'dneska pracovni den');
    		Assert::equal(4, $date->dayNumber(),'Start is Day number 4 ?');
    		Assert::equal(false, $date->isSaturday(),'Start is Saturday ?');
    		Assert::equal(false, $date->isSunday(),'Start is Sunday ?');
    		Assert::equal(false, $date->isHoliday(),'Start is holday ?');
    		Assert::equal(false, $date->isWeekend(),'Start is weekend ?');
    		Assert::equal(true, $date->isWorkDay(),'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('05.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('06.05.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday8()
    {
    		$date = new Calendar('06.07.2016 09:02');
    		Assert::equal(false, $date->isWorkDay(), 'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('07.07.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('08.07.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday9()
    {
    		$date = new Calendar('06.07.2016 09:02');
            $date->getShippingTime(14, 0);
    		Assert::equal('08.07.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal(true, $date->isWorkDay(), 'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('08.07.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('11.07.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday10()
    {
    		$date = new Calendar('05.07.2016 09:02');
            $date2 = new Calendar('05.07.2016 09:02');

            $date2->getWorkDay();

    		Assert::equal('07.07.2016', $date2->format('d.m.Y'), 'WORKDAY pracovni den 1');

            $date->getShippingTime(14, 0);
    		Assert::equal('08.07.2016', $date->format('d.m.Y'), 'dneska pracovni den 1');
    		Assert::equal(true, $date->isWorkDay(), 'Start is workday ?');

    		$date->getWorkDay();
    		Assert::equal('08.07.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date->getWorkDay(true);
    		Assert::equal('11.07.2016', $date->format('d.m.Y'), 'dalsi pracovni den 3');
    }

}

$testCase = new WorkDaysTest();
$testCase->run();
