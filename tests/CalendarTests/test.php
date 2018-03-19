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

$config = [
	'CzechRepublic' => [
		'shippers' => [
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
		],
	],
	'Slovakia' => [
		'shippers' => [
			'Geis' => [
				'endHour' => 14,
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
		],
	],
];


$configuration = new \Galek\Utils\Calendar\Configuration\Configurator($config);


$czDelivery = $configuration->getCountry(\Galek\Utils\Calendar\Enum\Country::CZ);
dump($czDelivery->getShipper('Geis'));

$geis = $czDelivery->getShipper('Geis');

dump($geis->getDate());



$local = new \Galek\Utils\Calendar\Localization('cs');

//dump($local->getInflexion(0, 1));


$date3 = new \Galek\Utils\Calendar\Calendar();
$date3->modify('+2 days');

//dump($date3->werbDif());