<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 9.3.2018
 */
declare(strict_types=1);

if (@!include __DIR__ . '/../../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer update --dev`';
	exit(1);
}

use Tracy\Debugger;

Debugger::enable();
Debugger::$maxDepth = 6;

$shippers = [
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

$workTime = [
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

$config = [
	'cz' => [
		'country' => 'CzechRepublic',
		'work' => $workTime,
		'shippers' => $shippers,
	],
	'sk' => [
		'country' => 'Slovakia',
		'work' => $workTime,
		'shippers' => $shippers,
	],
];


$configuration = new \Galek\Utils\Calendar\Configuration\CalendarManager($config);

bdump($configuration);

$geis = $configuration->getShipper('cz','Geis');
$testDate = new \Galek\Utils\Calendar\Calendar('2018-03-29 12:00:00');
$geis->setCurrentDate($testDate);

dump($geis);

dump($geis->getDate());






$local = new \Galek\Utils\Calendar\Localization('cs');
//$dd = new \Galek\Utils\Calendar\Calendar('2018-03-29');
//dump($dd);

//dump($dd->getWorkDay(true));

//dump($local->getInflexion(0, 1));


$date3 = new \Galek\Utils\Calendar\Calendar();
$date3->modify('+2 days');

//dump($date3->werbDif());