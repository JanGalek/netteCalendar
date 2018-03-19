<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar\Calendar;

/**
 * @testCase
 */
class ExceptionsTest extends \Tester\TestCase
{
    public function test01()
    {
        $date = new Calendar();
        Assert::exception(function () use($date) {
        	$date->setWorkTime(25);
		}, Exception::class, 'Try set bad value of start work time hour (\'25\'), use 0-23.');

		Assert::exception(function () use($date) {
			$date->setWorkTime(23, 60);
		}, Exception::class, 'Try set bad value of start work time minute (\'60\'), use 0-59.');

		Assert::exception(function () use($date) {
			$date->setWorkTime(23, 59, 24, 0);
		}, Exception::class, 'Try set bad value of end work time hour (\'24\'), use 0-23.');

		Assert::exception(function () use($date) {
			$date->setWorkTime(23, 59, 23, 60);
		}, Exception::class, 'Try set bad value of end work time minute (\'60\'), use 0-59.');

		Assert::exception(function () use($date) {
			$date->getWorkTime(3);
		}, Exception::class, 'Value \'3\' is not allowed, you can use (false, 1, 2)');

		Assert::exception(function () use($date) {
			$date->setWorkTime('t');
		}, Exception::class, 'Value \'t\' is not allowed, use array (full list) or int (hour)');
    }
}

$testCase = new ExceptionsTest();
$testCase->run();
