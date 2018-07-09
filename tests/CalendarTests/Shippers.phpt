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
		'en' => [
			'country' => 'Poland',
			'work' => self::workTime,
			'shippers' => self::SHIPPERS,
		],
	];


	public function testCustom1(): void
	{
		$configurator = new \Galek\Utils\Calendar\Configuration\CalendarManager(self::CONFIG);

		$date = new Calendar('2018-03-29 12:00');

		$geis = $configurator->getShipper('cz', 'Geis');
		$geis->setCurrentDate($date);

		Assert::equal('2018-04-03', $geis->getDate()->format('Y-m-d'));
	}


	public function testDeliveryTextDayCZ(): void
	{
		$configurator = new \Galek\Utils\Calendar\Configuration\CalendarManager(self::CONFIG);

		$date = new Calendar('2018-04-06 12:00');

		$geis = $configurator->getShipper('cz', 'Geis');
		$geis->setCurrentDate($date);


		Assert::equal('v pondělí 2018-04-09', $geis->getDeliveryTextDate('Y-m-d'));
	}


	public function testDeliveryTextDaySK(): void
	{
		$configurator = new \Galek\Utils\Calendar\Configuration\CalendarManager(self::CONFIG);

		$date = new Calendar('2018-04-06 12:00');

		$geis = $configurator->getShipper('sk', 'Geis');
		$geis->setCurrentDate($date);


		Assert::equal('v pondelok 2018-04-09', $geis->getDeliveryTextDate('Y-m-d'));
	}


	public function testDeliveryTextDayEN(): void
	{
		$configurator = new \Galek\Utils\Calendar\Configuration\CalendarManager(self::CONFIG);

		$date = new Calendar('2018-04-06 12:00');

		$geis = $configurator->getShipper('en', 'Geis');
		$geis->setCurrentDate($date);


		Assert::equal('at monday 2018-04-09', $geis->getDeliveryTextDate('Y-m-d'));
	}

}

(new ShippersTest())->run();
