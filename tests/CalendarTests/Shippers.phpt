<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar\Calendar;


/**
 * @testCase
 */
class ShippersTest extends \Tester\TestCase
{

public const SHIPPERS = [
	'Geis' => [
		'endHour' => 13,
		'endMinute' => 0,
		'weekend' => false,
		'deliveryTime' => 1,
	],
	'PPL' => [
		'endHour' => 14,
		'endMinute' => 0,
		'weekend' => false,
		'deliveryTime' => 1,
	],
	'DPD' => [
		'endHour' => 14,
		'endMinute' => 0,
		'weekend' => false,
		'deliveryTime' => 1,
	],
];

public const workTime = [
	'start' => [
		'hour' => 8,
		'minute' => 0
	],
	'end' => [
		'hour' => 16,
		'minute' => 30
	],
	'weekend' => false
];

public const CONFIG = [
	'cz' => [
		'country' => 'CzechRepublic',
		'work' => self::workTime,
		'shippers' => self::SHIPPERS,
	],
	'sk' => [
		'country' => 'Slovakia',
		'work' => self::workTime,
		'shippers' => self::SHIPPERS,
	],
];

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


	public function testCustom1()
	{
		$configurator = new \GalekTests\Calendar\Models\Configurator(self::CONFIG);

		$date = new Calendar('2018-03-29 12:00');

		$geis = $configurator->getShipper('cz', 'Geis');
		$geis->setCurrentDate($date);

		Assert::equal('2018-04-03', $geis->getDate()->format('Y-m-d'));
	}

}

(new ShippersTest())->run();
