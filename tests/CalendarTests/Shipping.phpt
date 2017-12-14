<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class ShippingTest extends \Tester\TestCase
{

    public function testDay1()
    {
        $date = new Calendar(DATE_RELEASE . ' 14:02');
        $date->setShippingDays(3);

        Assert::equal(3, $date->getShippingDays(), 'dneska pracovni den 1');
    }

	public function testDay2()
	{
		$date = new Calendar(DATE_RELEASE . ' 14:02');
		$date->disableShippingWeekend();
		Assert::equal($date, $date);

	}

}

$testCase = new ShippingTest();
$testCase->run();
