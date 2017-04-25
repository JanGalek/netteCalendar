<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class CalendarTest extends CalendarTestCase
{

    public function testBasic()
    {
        $date2 = new Calendar(self::daterelease);
        Assert::equal(true, $date2->isWorkDay());
        $date2->modify('+1 days');
        $date2->getWorkDay(true);

        Assert::equal(false, $date2->isWeekend(), 'basic 1');
        $date2->modify('+1 days');
        Assert::equal(false, $date2->isWeekend(), 'basic 2');

        Assert::equal(true, $date2->isWorkDay());
    }

  	public function testDays()
    {
        $date = new Calendar(self::daterelease);
        Assert::equal(false, $date->isMonday());
        Assert::equal(false, $date->isTuesday());
        Assert::equal(false, $date->isWednesday());
        Assert::equal(false, $date->isThursday());
        Assert::equal(true, $date->isFriday());
        Assert::equal(false, $date->isSaturday());
        Assert::equal(false, $date->isSunday());
        Assert::equal(false, $date->isWeekend());
        Assert::equal(false, $date->isHoliday());
  	}

  	public function testHoliday()
    {
        $date = new Calendar('30.04.2016 14:02');
        Assert::equal(false, $date->isHoliday(), 'Test holiday '.$date->format( 'd.m.Y H:i').' ?');

        $date2 = new Calendar('01.05.2016 01:00');
        Assert::equal(true, $date2->isHoliday(), 'Test holiday '.$date2->format( 'd.m.Y H:i').' ?');

        //Easter
        Assert::equal('2016-03-27', $date2->getEaster()->format('Y-m-d'), 'Test Easter '.$date2->getYear().' ?');
        Assert::equal('2016-03-28', $date2->getEasterMonday()->format('Y-m-d'), 'Test Easter Monday '.$date2->getYear().' ?');
        Assert::equal('2016-03-25', $date2->getBigFriday()->format('Y-m-d'), 'Test Easter Big Friday '.$date2->getYear().' ?');
  	}

  	public function testDifWerbs()
    {
        $date = new Calendar();
        Assert::equal('dnes', $date->werbDif());
  	}

  	public function testDayNumbers()
    {
        $date = new Calendar(self::daterelease);
        Assert::equal(5, $date->dayNumber(), 'Friday');

        $date2 = new Calendar('30.04.2016');
        Assert::equal(6, $date2->dayNumber(), 'Saturday');

        $date3 = new Calendar('01.05.2016');
        Assert::equal(0, $date3->dayNumber(), 'Sunday');

        $date4 = new Calendar('02.05.2016');
        Assert::equal(1, $date4->dayNumber(), 'Monday');

        $date5 = new Calendar('03.05.2016');
        Assert::equal(2, $date5->dayNumber(), 'Tuesday');

        $date6 = new Calendar('04.05.2016');
        Assert::equal(3, $date6->dayNumber(), 'Wednesday');

        $date7 = new Calendar('05.05.2016');
        Assert::equal(4, $date7->dayNumber(), 'Thursday');

        //Weekend
        Assert::equal(false, $date->isWeekend());
        Assert::equal(true, $date2->isWeekend());
        Assert::equal(true, $date3->isWeekend());
        Assert::equal(false, $date4->isWeekend());
        Assert::equal(false, $date5->isWeekend());
        Assert::equal(false, $date6->isWeekend());
        Assert::equal(false, $date7->isWeekend());
  	}

  	public function testTimes()
    {
        $date = new Calendar(self::daterelease . ' 01:00');
        Assert::equal(1, $date->getHour(), 'Hour');
        Assert::equal(0, $date->getMinute(), 'Minute');
        Assert::equal(0, $date->getSecond(), 'Second');
        Assert::equal(29, $date->getDay(), 'Day');
        Assert::equal(4, $date->getMon(), 'Month');
        Assert::equal(2016, $date->getYear(), 'Year');
        Assert::equal(false, $date->timeBellow(0, 20), 'Time bellow 0:20 bellow 01:00');
        Assert::equal(true, $date->timeBellow(1, 20), 'Time bellow 1:20 bellow 01:00');
        Assert::equal(false, $date->timeOver(1, 1));
        Assert::equal(true, $date->timeOver(1, 0));
        Assert::equal(true, $date->timeOver(0, 20));
        Assert::equal(1, $date->getHour());
        Assert::equal(true, $date->timeOver(0, 1));

        Assert::equal(false, $date->timeBetween(0,0, 0, 59));
        Assert::equal(false, $date->timeBetween(0,20, 0, 59));
        Assert::equal(true, $date->timeBetween(1,0, 1, 59));
        Assert::equal(true, $date->timeBetween(0,0, 2, 0));

        $date2 = new Calendar(self::daterelease . ' 23:58:02');
        Assert::equal(23, $date2->getHour(), 'Hour');
        Assert::equal(58, $date2->getMinute(), 'Minute');
        Assert::equal(2, $date2->getSecond(), 'Second');
        Assert::equal(false, $date2->timeBellow(16, 20), 'Time bellow');

        Assert::equal(false, $date2->timeBetween(0,0, 0, 59));
        Assert::equal(false, $date2->timeBetween(0,20, 0, 59));
        Assert::equal(true, $date2->timeBetween(20,0, 23, 58));
        Assert::equal(true, $date2->timeBetween(20,0, 0, 59));
        Assert::equal(false, $date2->timeBetween(0,0, 2, 0));

        $date3 = new Calendar(self::daterelease.' 18:02');
        Assert::equal(false, $date2->timeBellow(16, 20), 'Time bellow 2');
  	}

  	public function testShippingtime()
    {
        $date = new Calendar(self::daterelease.' 11:02');

        Assert::equal(11, $date->getHour(),'Time Hour: 11 == 1 ?');
        Assert::equal(2, $date->getMinute(),'Time Min: 02 == 2 ?');

        $date->getShippingTime();
        Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2, notime');
        Assert::equal(true, $date->isWorkDay());

        $date->getShippingTime(12, 0);
        Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2, 12:00');
        Assert::equal(true, $date->isWorkDay());

        $date2 = new Calendar(self::daterelease.' 15:50');

        $date2->getShippingTime();
        Assert::equal('02.05.2016', $date2->format('d.m.Y'), 'dneska pracovni den 3');
        Assert::equal(true, $date2->isWorkDay());

        $date2->getShippingTime(12, 0);
        Assert::equal('04.05.2016', $date2->format('d.m.Y'), 'dneska pracovni den 4');
        Assert::equal(true, $date2->isWorkDay());
      }
}

$testCase = new CalendarTest();
$testCase->run();
