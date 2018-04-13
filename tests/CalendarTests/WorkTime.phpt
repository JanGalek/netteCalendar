<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar\Calendar;

/**
 * @testCase
 */
class WorkTimeTest extends \Tester\TestCase
{
    public function testWerbDif()
	{
		$date = new Calendar();
		$localization = $date->getLocalization();
		Assert::equal('dnes', $localization->getTranslateDifference($date));
		$date2 = new Calendar();
		$date2->modify('+1 days');
		$localization = $date2->getLocalization();
		Assert::equal('zítra', $localization->getTranslateDifference($date2));
		$date3 = new Calendar();
		$date3->modify('+2 days');
		$localization = $date3->getLocalization();
		Assert::equal('pozítří', $localization->getTranslateDifference($date3));
		$date4 = new Calendar();
		$date4->modify('+3 days');
		$localization = $date4->getLocalization();
		Assert::equal('za 3 dny', $localization->getTranslateDifference($date4));
		$date5 = new Calendar();
		$date5->modify('+4 days');
		$localization = $date5->getLocalization();
		Assert::equal('za 4 dny', $localization->getTranslateDifference($date5));
		$date6 = new Calendar();
		$date6->modify('+5 days');
		$localization = $date6->getLocalization();
		Assert::equal('za 5 dnů', $localization->getTranslateDifference($date6));

	}


	public function testHolidays()
	{
		$date = new Calendar('28.03.2016');
		Assert::equal(TRUE, $date->isHoliday());
		$date2 = new Calendar('25.03.2016');
		Assert::equal(TRUE, $date2->isHoliday());
	}

}

$testCase = new WorkTimeTest();
$testCase->run();
