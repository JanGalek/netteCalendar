<?php

$container = require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../src/Galek/Utils/Calendar/Calendar.php';

abstract class CalendarTestCase extends Tester\TestCase {
    
    function __construct(){
    }
}