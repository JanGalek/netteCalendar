<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class CalendarTest extends CalendarTestCase{
    
    
    public function testBasic(){
		$date2 = new Calendar();
		$date2->modify('+1 days');
		$date2->getWorkDay(TRUE);

		Assert::equal(FALSE, $date2->isWeekend());
		$date2->modify('+1 days');
		Assert::equal(FALSE, $date2->isWeekend());

		Assert::equal(TRUE, $date2->isWorkDay());
    }
	
	public function testHoliday(){
		$date = new Calendar('30.04.2016 14:02');
		Assert::equal(FALSE, $date->isHoliday(),'Test holiday '.$date->format( 'd.m.Y H:i').' ?');
		
		$date2 = new Calendar('31.04.2016 01:00');
		Assert::equal(TRUE, $date2->isHoliday(),'Test holiday '.$date2->format( 'd.m.Y H:i').' ?');
	}
    
    public function testShippingtime(){
		$date = new Calendar('29.04.2016 11:02');

		Assert::equal(11, $date->getHour(),'Time Hour: 11 == 1 ?');
		Assert::equal(2, $date->getMinute(),'Time Min: 02 == 2 ?');

		$date->getShippingTime();
		Assert::equal('02.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());

		$date->getShippingTime(12,0);
		Assert::equal('03.05.2016', $date->format('d.m.Y'), 'dneska pracovni den 2');
		Assert::equal(TRUE, $date->isWorkDay());


		$date2 = new Calendar('29.04.2016 15:50');

		$date2->getShippingTime();
		Assert::equal('02.05.2016', $date2->format('d.m.Y'), 'dneska pracovni den 3');
		Assert::equal(TRUE, $date2->isWorkDay());

		$date2->getShippingTime(12,0);
		Assert::equal('04.05.2016', $date2->format('d.m.Y'), 'dneska pracovni den 4');
		Assert::equal(TRUE, $date2->isWorkDay());
	
    }
}

$testCase = new CalendarTest();
$testCase->run();