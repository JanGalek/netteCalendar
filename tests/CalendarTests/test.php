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

$local = new \Galek\Utils\Localization('cs');
dump($local);

dump($local->getInflexion(0, 1));


$date3 = new \Galek\Utils\Calendar();
$date3->modify('+2 days');

dump($date3->werbDif());