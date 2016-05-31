<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class WorkTimeTest extends CalendarTestCase
{
    public function test01()
    {
          $date = new Calendar();
          $date->setWorkTime(8, 0, 16, 30);
          $worktime = $date->getWorkTime();
          Assert::equal([[8,0],[16,30]], $worktime, 'Get Work Time in params');
    }

    public function test02()
    {
          $date = new Calendar();
          $time = [[8,0],[16,30]];
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
          Assert::equal([[8,0],[16,30]], $worktime, 'Mishmash Work Time in params, data: '.$worktime[0][0].', '.$worktime[0][1].', '.$worktime[0][2].', '.$worktime[0][3]);
    }

    public function testWorkday1()
    {
    		$date = new Calendar(self::daterelease.' 14:02');
        $date->setWorkTime(8, 0, 16, 30);
        $date2 = $date;
        $date3 = $date;
        $date4 = $date;

    		$date->GetWorkDayLimit(false);
    		Assert::equal(self::daterelease, $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());

    		$date2->GetWorkDayLimit();
    		Assert::equal('29.04.2016', $date2->format('d.m.Y'), 'dalsi pracovni den 4');

    		$date3->GetWorkDayLimit(false);
    		Assert::equal('29.04.2016', $date3->format('d.m.Y'), 'dalsi pracovni den 5');

    		$date4->GetWorkDayLimit(true);
    		Assert::equal('29.04.2016', $date4->format('d.m.Y'), 'dalsi pracovni den 3');
    }

    public function testWorkday2()
    {
    		$date = new Calendar(self::daterelease.' 16:32');
        $date->setWorkTime(8, 0, 16, 30);
    		$date2 = new Calendar(self::daterelease.' 16:32');
        $date2->setWorkTime(8, 0, 16, 30);

    		$date3 = new Calendar(self::daterelease.' 16:32');
        $date3->setWorkTime(8, 0, 16, 30);

    		$date4 = new Calendar(self::daterelease.' 16:32');
        $date4->setWorkTime(8, 0, 16, 30);

    		$date->GetWorkDayLimit(false);
    		Assert::equal(self::daterelease, $date->format('d.m.Y'), 'dneska pracovni den 2');
    		Assert::equal(true, $date->isWorkDay());
        
    		$date3->GetWorkDayLimit(true);
    		Assert::equal('02.05.2016', $date3->format('d.m.Y'), 'dalsi pracovni den 5');

    		$date4->GetWorkDayLimit(false);
    		Assert::equal('29.04.2016', $date4->format('d.m.Y'), 'dalsi pracovni den 3');
    }

}

$testCase = new WorkTimeTest();
$testCase->run();
