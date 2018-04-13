<?php

require_once __DIR__ . '/boostrap.php';

use Tester\Assert;
use Galek\Utils\Calendar\Calendar;

class DodaniTest extends \Tester\TestCase
{

    public function testRenderPoup()
    {
        $testTime1 = new Calendar(DATE_RELEASE . ' 14:02');
        $testTime1->modify('+4 days');

        Assert::equal('2', $testTime1->format('w'), 'Test dne v tydnu');
        $testTime2 = new Calendar(DATE_RELEASE . ' 14:02');

        $testTime2->modify('+2 days');
        Assert::equal('0', $testTime2->format('w'), 'Test Nedele');
    }

    public function testDodaniShipping()
    {
        $testTime1 = new Calendar(DATE_RELEASE . ' 11:00');
        Assert::equal(TRUE, \Galek\Utils\Calendar\Time::bellow($testTime1, 14, 0), 'Time 11:00 bellow 14:00');

        //29.4.2016 - Friday
        $testTime2 = new Calendar(DATE_RELEASE . ' 14:01');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime2, 14, 0), 'Time 11:00 bellow 14:00');

        $testTime3 = new Calendar(DATE_RELEASE . ' 15:12');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime3, 14, 0), 'Time 15:12 bellow 14:00');

        $testTime4 = new Calendar('30.04.2016 11:12');
        Assert::equal(TRUE, \Galek\Utils\Calendar\Time::bellow($testTime4, 14, 0), '+1D Time 11:12 bellow 14:00');

        $testTime5 = new Calendar('30.04.2016 15:12');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime5, 14, 0), '+1D Time 15:12 bellow 14:00');

        $testTime6 = new Calendar('01.05.2016 11:12');
        Assert::equal(TRUE, \Galek\Utils\Calendar\Time::bellow($testTime6, 14, 0), '+2D Time 11:12 bellow 14:00');

        $testTime7 = new Calendar('01.05.2016 15:12');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime7, 14, 0), '+2D Time 15:12 bellow 14:00');

        $testTime8 = new Calendar('30.04.2016 23:25');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime8, 16, 20), '+1D Time 23:25 bellow 16:20');

        $testTime9 = new Calendar(DATE_RELEASE . ' 23:25');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime9, 16, 20), 'Time 23:25 bellow 16:20');

        $testTime10 = new Calendar(DATE_RELEASE . ' 15:25');
        Assert::equal(TRUE, \Galek\Utils\Calendar\Time::bellow($testTime10, 16, 20), 'Time 15:25 bellow 16:20');

        $testTime11 = new Calendar('25.4.2017 15:30');
        Assert::equal(FALSE, \Galek\Utils\Calendar\Time::bellow($testTime11, 15, 00), 'Time 15:30 bellow 15:00');
    }

    public function testDodaniShipping2()
    {
        $testTime1 = new Calendar('19.4.2017 11:00');
        Assert::equal(TRUE, \Galek\Utils\Calendar\Time::bellow($testTime1, 14, 0), 'Time 11:00 bellow 14:00');
    }
}

$testCase = new DodaniTest();
$testCase->run();
