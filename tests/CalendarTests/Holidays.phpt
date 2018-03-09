<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class HolidaysTest extends \Tester\TestCase
{


    public function testBasic()
    {
        $holidays = new \Galek\Utils\Holidays(Calendar\Enum\Country::CZ);
        Assert::type('array', $holidays->getHolidays());

        Assert::equal(true, $holidays->allowedGoodFriday());

		Assert::equal(true, $holidays->allowedEaster());
    }


	public function testGetter()
	{
		$date = new Calendar();

		Assert::type(\Galek\Utils\Holidays::class, $date->getHolidays());

		Assert::type(\Galek\Utils\Localization::class, $date->getLocalization());
	}
}

(new HolidaysTest())->run();