<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class LocalizationTest extends \Tester\TestCase
{


    public function testBasic()
    {
        $local = new \Galek\Utils\Localization('cs');
        Assert::equal(null, $local->setLocalization('cs'));

        Assert::equal('cs', $local->getLocalization());
    }


	public function testEn()
	{
		$local = new \Galek\Utils\Localization('cs');
		$local->setLocalization('en');

		Assert::equal('en', $local->getLocalization());
	}
}

(new LocalizationTest())->run();