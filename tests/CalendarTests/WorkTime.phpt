<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar;

/**
 * @testCase
 */
class WorkTimeTest extends \Tester\TestCase
{
    public function test01()
    {
        $date = new Calendar();
        $date->setWorkTime(8, 0, 16, 30);
        $workTime = $date->getWorkTime();
        Assert::equal([[8,0],[16,30]], $workTime, 'Get Work Time in params');
    }

    public function test02()
    {
        $date = new Calendar();
        $time = [[8,0],[16,30]];
        $date->setWorkTime($time);
        $worktime = $date->getWorkTime();
        Assert::equal([[8,0],[16,30]], $worktime, 'Get Work Time in array');
    }

	public function test03()
	{
		$date = new Calendar();
		$time = [[8,0,16,30]];
		$date->setWorkTime($time);
		$worktime = $date->getWorkTime();
		Assert::equal([[8,0],[16,30]], $worktime, 'Get Work Time in array');
	}

    public function testMismash()
    {
        $date = new Calendar();
        $time = [[8,00],[16,30]];
        $date->setWorkTime($time);
        $worktime = $date->getWorkTime();
        Assert::equal([[8,0],[16,30]], $worktime, 'Mishmash Work Time in array');
    }

    public function testMismash2()
    {
        $date = new Calendar();
        $date->setWorkTime(8, '0', 16, 30);
        $worktime = $date->getWorkTime();
        Assert::equal([[8,0],[16,30]], $worktime, 'Mishmash Work Time in params');
    }


	public function testMismash3()
	{
		$date = new Calendar();
		$date->setWorkTime([8, 0, 16, 30]);
		$worktime = $date->getWorkTime();
		Assert::equal([[8,0],[16,30]], $worktime, 'Mishmash Work Time in params, data: '.$worktime[0][0].', '.$worktime[0][1].', '.$worktime[1][0].', '.$worktime[1][1]);
	}


	public function testTimeFormat()
	{
		$date = new Calendar();
		Assert::equal((new DateTime())->format('d.m.Y'), $date->getDateFormat(), 'timeformat: '.$date->getDateFormat());
	}


    public function testWorkday1()
    {
        $date = new Calendar(DATE_RELEASE . ' 14:02');
        $date->setWorkTime(8, 0, 16, 30);
        $date2 = $date;
        $date3 = $date;
        $date4 = $date;

        $date->GetWorkDayLimit(false);
        Assert::equal(DATE_RELEASE, $date->format('d.m.Y'), 'dneska pracovni den 2');
        Assert::equal(TRUE, $date->isWorkDay());
        Assert::equal(TRUE, $date->isWorkTime());

        $date2->GetWorkDayLimit();
        Assert::equal('29.04.2016', $date2->format('d.m.Y'), 'dalsi pracovni den 4');

        $date3->GetWorkDayLimit(false);
        Assert::equal('29.04.2016', $date3->format('d.m.Y'), 'dalsi pracovni den 5');

        $date4->GetWorkDayLimit(TRUE);
        Assert::equal('29.04.2016', $date4->format('d.m.Y'), 'dalsi pracovni den 3');

        // Work time checking
        $date5 = new Calendar(DATE_RELEASE . ' 08:02');

        $date5->setWorkTime(8, 0, 16, 30);
        Assert::equal(TRUE, $date5->isWorkTime());

        $date5->setWorkTime(9, 0, 16, 30);
        Assert::equal(FALSE, $date5->isWorkTime());

        $date6 = new Calendar('25.4.2017 08:02');
        $date6->setWorkTime(23, 0, 9, 30);
        Assert::equal(TRUE, $date6->isWorkTime());

    }

    public function testWorkday2()
    {
        $date = new Calendar(DATE_RELEASE . ' 16:32');
        $date->setWorkTime(8, 0, 16, 30);
        $date2 = new Calendar(DATE_RELEASE . ' 16:32');
        $date2->setWorkTime(8, 0, 16, 30);

        $date3 = new Calendar(DATE_RELEASE . ' 16:32');
        $date3->setWorkTime(8, 0, 16, 30);

        $date4 = new Calendar(DATE_RELEASE . ' 16:32');
        $date4->setWorkTime(8, 0, 16, 30);

        $date5 = new Calendar(DATE_RELEASE . ' 18:11');
        $date5->setWorkTime(8, 0, 16, 30);

        //$date6 = $date5;

        $date->GetWorkDayLimit(FALSE);
        Assert::equal(DATE_RELEASE, $date->format('d.m.Y'), 'dneska pracovni den 2');
        Assert::equal(TRUE, $date->isWorkDay());

        $date3->GetWorkDayLimit(TRUE);
        Assert::equal('02.05.2016', $date3->format('d.m.Y'), 'dalsi pracovni den 5');

        $date4->GetWorkDayLimit(FALSE);
        Assert::equal('29.04.2016', $date4->format('d.m.Y'), 'dalsi pracovni den 3');

        $date5->GetWorkDayLimit(TRUE);
        $date6 = $date5;
        $time = $date5->getWorkTime();
        Assert::equal(8, $time[0][0], 'Test GetWorkTime() start hour');
        Assert::equal(0, $time[0][1], 'Test GetWorkTime() start minute');
        Assert::equal(16, $time[1][0], 'Test GetWorkTime() end hour');
        Assert::equal(30, $time[1][1], 'Test GetWorkTime() end minute');
        Assert::equal(18, $date6->getHour(), 'Test hour');
        Assert::equal(11, $date6->getMinute(), 'Test minute');
        Assert::equal(FALSE, $date6->timeBellow($time[1][0], $time[1][1]), 'Time bellow ....');
        Assert::equal('02.05.2016', $date5->format('d.m.Y'), 'Test minut');
    }


    public function testWerbDif()
	{
		$date = new Calendar();
		Assert::equal('dnes', $date->werbDif());
		$date2 = new Calendar();
		$date2->modify('+1 days');
		Assert::equal('zítra', $date2->werbDif());
		$date3 = new Calendar();
		$date3->modify('+2 days');
		Assert::equal('pozítří', $date3->werbDif());
		$date4 = new Calendar();
		$date4->modify('+3 days');
		Assert::equal('za 3 dny', $date4->werbDif());
		$date5 = new Calendar();
		$date5->modify('+4 days');
		Assert::equal('za 4 dny', $date5->werbDif());
		$date6 = new Calendar();
		$date6->modify('+5 days');
		Assert::equal('za 5 dnů', $date6->werbDif());

	}


	public function testHolidays()
	{
		$date = new Calendar('28.03.2016');
		Assert::equal(TRUE, $date->isHoliday());
		$date2 = new Calendar('25.03.2016');
		Assert::equal(TRUE, $date2->isHoliday());
	}


	public function testNotWorkTIme()
	{
		$date = new Calendar('09.12.2017 18:00:00');
		$date->setWorkTime(8,0,16,30);
		Assert::equal(FALSE, $date->isWorkTime());
	}
}

$testCase = new WorkTimeTest();
$testCase->run();
