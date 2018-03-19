<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar\Calendar;

class HolidaysTest extends \Tester\TestCase
{


    public function testBasic()
    {
        $holidays = new \Galek\Utils\Calendar\Holidays(\Galek\Utils\Calendar\Enum\Country::CZ);
        Assert::type('array', $holidays->getHolidays());

        Assert::equal(true, $holidays->allowedGoodFriday());

		Assert::equal(true, $holidays->allowedEaster());
    }


	public function testGetter()
	{
		$date = new Calendar();

		Assert::type(\Galek\Utils\Calendar\Holidays::class, $date->getHolidays());

		Assert::type(\Galek\Utils\Calendar\Localization::class, $date->getLocalization());
	}
}

(new HolidaysTest())->run();