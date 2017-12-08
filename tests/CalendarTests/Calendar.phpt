<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class CalendarTest extends \Tester\TestCase
{


    public function testBasic()
    {
        $date2 = new Calendar(DATE_RELEASE);
        Assert::equal(TRUE, $date2->isWorkDay());
        $date2->modify('+1 days');
        $date2->getWorkDay(TRUE);

        Assert::equal(FALSE, $date2->isWeekend(), 'basic 1');
        $date2->modify('+1 days');
        Assert::equal(FALSE, $date2->isWeekend(), 'basic 2');

        Assert::equal(TRUE, $date2->isWorkDay());
    }

  	public function testDays()
    {
        $date = new Calendar(DATE_RELEASE);
        Assert::equal(FALSE, $date->isMonday());
        Assert::equal(FALSE, $date->isTuesday());
        Assert::equal(FALSE, $date->isWednesday());
        Assert::equal(FALSE, $date->isThursday());
        Assert::equal(TRUE, $date->isFriday());
        Assert::equal(FALSE, $date->isSaturday());
        Assert::equal(FALSE, $date->isSunday());
        Assert::equal(FALSE, $date->isWeekend());
        Assert::equal(FALSE, $date->isHoliday());
  	}

  	public function testHoliday()
    {
        $date = new Calendar('30.04.2016 14:02');
        Assert::equal(FALSE, $date->isHoliday(), 'Test holiday '.$date->format( 'd.m.Y H:i').' ?');

        $date2 = new Calendar('01.05.2016 01:00');
        Assert::equal(TRUE, $date2->isHoliday(), 'Test holiday '.$date2->format( 'd.m.Y H:i').' ?');

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
        $date = new Calendar(DATE_RELEASE);
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
        Assert::equal(FALSE, $date->isWeekend());
        Assert::equal(TRUE, $date2->isWeekend());
        Assert::equal(TRUE, $date3->isWeekend());
        Assert::equal(FALSE, $date4->isWeekend());
        Assert::equal(FALSE, $date5->isWeekend());
        Assert::equal(FALSE, $date6->isWeekend());
        Assert::equal(FALSE, $date7->isWeekend());
  	}

  	public function testTimes()
    {
        $date = new Calendar(DATE_RELEASE . ' 01:00');
        Assert::equal(1, $date->getHour(), 'Hour');
        Assert::equal(0, $date->getMinute(), 'Minute');
        Assert::equal(0, $date->getSecond(), 'Second');
        Assert::equal(29, $date->getDay(), 'Day');
        Assert::equal(4, $date->getMon(), 'Month');
        Assert::equal(2016, $date->getYear(), 'Year');
        Assert::equal(FALSE, $date->timeBellow(0, 20), 'Time bellow 0:20 bellow 01:00');
        Assert::equal(TRUE, $date->timeBellow(1, 20), 'Time bellow 1:20 bellow 01:00');
        Assert::equal(FALSE, $date->timeOver(1, 1));
        Assert::equal(TRUE, $date->timeOver(1, 0));
        Assert::equal(TRUE, $date->timeOver(0, 20));
        Assert::equal(1, $date->getHour());
        Assert::equal(TRUE, $date->timeOver(0, 1));

        Assert::equal(FALSE, $date->timeBetween(0,0, 0, 59));
        Assert::equal(FALSE, $date->timeBetween(0,20, 0, 59));
        Assert::equal(TRUE, $date->timeBetween(1,0, 1, 59));
        Assert::equal(TRUE, $date->timeBetween(0,0, 2, 0));

        $date2 = new Calendar(DATE_RELEASE . ' 23:58:02');
        Assert::equal(23, $date2->getHour(), 'Hour');
        Assert::equal(58, $date2->getMinute(), 'Minute');
        Assert::equal(2, $date2->getSecond(), 'Second');
        Assert::equal(FALSE, $date2->timeBellow(16, 20), 'Time bellow');

        Assert::equal(FALSE, $date2->timeBetween(0,0, 0, 59));
        Assert::equal(FALSE, $date2->timeBetween(0,20, 0, 59));
        Assert::equal(TRUE, $date2->timeBetween(20,0, 23, 58));
        Assert::equal(TRUE, $date2->timeBetween(20,0, 0, 59));
        Assert::equal(FALSE, $date2->timeBetween(0,0, 2, 0));

        $date3 = new Calendar(DATE_RELEASE . ' 18:02');
        Assert::equal(FALSE, $date2->timeBellow(16, 20), 'Time bellow 2');
  	}

  	public function testShippingTime()
    {
        $date = new Calendar(DATE_RELEASE . ' 11:02');
        $date3 = new Calendar(DATE_RELEASE . ' 11:02');

        Assert::equal(11, $date->getHour(),'Time Hour: 11 == 1 ?');
        Assert::equal(2, $date->getMinute(),'Time Min: 02 == 2 ?');

        $date3->setShippingTime(10,0);

        Assert::equal('03.05.2016', $date3->getShippingDate()->format('d.m.Y'), 'dneska pracovni den 2, 10:00');
        Assert::equal(TRUE, $date->isWorkDay());

        /*Assert::equal('02.05.2016', $date->getShippingTime()->format('d.m.Y'), 'dneska pracovni den 2, notime');
        Assert::equal(TRUE, $date->isWorkDay());

        Assert::equal('03.05.2016', $date->getShippingTime(10, 0)->format('d.m.Y'), 'dneska pracovni den 2, 10:00');
        Assert::equal(TRUE, $date->isWorkDay());*/

        $date2 = new Calendar(DATE_RELEASE . ' 15:50');

        $date2->setShippingTime(12, 0);

        $shipping = $date2->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), 'dneska pracovni den 4');
        Assert::equal(TRUE, $shipping->isWorkDay());

        /*$date2->getShippingTime();
        Assert::equal('02.05.2016', $date2->format('d.m.Y'), 'dneska pracovni den 3');
        Assert::equal(TRUE, $date2->isWorkDay());

        $date2->getShippingTime(12, 0);
        Assert::equal('03.05.2016', $date2->format('d.m.Y'), 'dneska pracovni den 4');
        Assert::equal(TRUE, $date2->isWorkDay());*/
      }
}

(new CalendarTest())->run();