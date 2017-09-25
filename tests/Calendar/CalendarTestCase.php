<?php

$container = require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../src/Galek/Utils/Calendar/Calendar.php';

/**
 * @testCase
 */
abstract class CalendarTestCase extends Tester\TestCase
{

    const daterelease = '29.04.2016';

  	public function __construct(){}

}
