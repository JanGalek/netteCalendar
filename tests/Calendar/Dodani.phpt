<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class DodaniTest extends CalendarTestCase
{

    public function testRenderPoup()
    {
        $testTime1 = new Calendar(self::daterelease . ' 14:02');
        $testTime1->modify('+4 days');

        Assert::equal('2', $testTime1->format('w'), 'Test dne v tydnu');
        $testTime2 = new Calendar(self::daterelease . ' 14:02');

        $testTime2->modify('+2 days');
        Assert::equal('0', $testTime2->format('w'), 'Test Nedele');
    }

    public function testDodaniShipping()
    {
        $testTime1 = new Calendar(self::daterelease . ' 11:00');
        Assert::equal(TRUE, $testTime1->timeBellow(14, 0), 'Time 11:00 bellow 14:00');
        $testTime1->setShippingTime(14, 0);
        $shipping = $testTime1->getShippingDate();
        Assert::equal('02.05.2016', $shipping->format('d.m.Y'), 'Time 11:00 to 14:00');
        /*$testTime1->getShippingTime(14, 0);
        Assert::equal('02.05.2016', $testTime1->format('d.m.Y'), 'Time 11:00 to 14:00');*/

        //29.4.2016 - Friday
        $testTime2 = new Calendar(self::daterelease . ' 14:01');
        Assert::equal(FALSE, $testTime2->timeBellow(14, 0), 'Time 11:00 bellow 14:00');
        $testTime2->setShippingTime(14, 0);
        $shipping = $testTime2->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), 'Time 14:01 to 14:00');

        $testTime3 = new Calendar(self::daterelease . ' 15:12');
        Assert::equal(FALSE, $testTime3->timeBellow(14, 0), 'Time 15:12 bellow 14:00');
        $testTime3->setShippingTime(14, 0);
        $shipping = $testTime3->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), 'Time 15:12 to 14:00');

        $testTime4 = new Calendar('30.04.2016 11:12');
        Assert::equal(TRUE, $testTime4->timeBellow(14, 0), '+1D Time 11:12 bellow 14:00');
        $testTime4->setShippingTime(14, 0);
        $shipping = $testTime4->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), '+1D Time 11:12 to 14:00');

        $testTime5 = new Calendar('30.04.2016 15:12');
        Assert::equal(FALSE, $testTime5->timeBellow(14, 0), '+1D Time 15:12 bellow 14:00');
        $testTime5->setShippingTime(14, 0);
        $shipping = $testTime5->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), '+1D Time 15:12 to 14:00');

        $testTime6 = new Calendar('01.05.2016 11:12');
        Assert::equal(TRUE, $testTime6->timeBellow(14, 0), '+2D Time 11:12 bellow 14:00');
        $testTime6->setShippingTime(14, 0);
        $shipping = $testTime6->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), '+2D Time 11:12 to 14:00');

        $testTime7 = new Calendar('01.05.2016 15:12');
        Assert::equal(FALSE, $testTime7->timeBellow(14, 0), '+2D Time 15:12 bellow 14:00');
        $testTime7->setShippingTime(14, 0);
        $shipping = $testTime7->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), '+2D Time 15:12 to 14:00');

        $testTime8 = new Calendar('30.04.2016 23:25');
        Assert::equal(FALSE, $testTime8->timeBellow(16, 20), '+1D Time 23:25 bellow 16:20');
        $testTime8->setShippingTime(16, 20);
        $shipping = $testTime8->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), '+1D Time 23:25 to 16:20');

        $testTime9 = new Calendar(self::daterelease . ' 23:25');
        Assert::equal(FALSE, $testTime9->timeBellow(16, 20), 'Time 23:25 bellow 16:20');
        $testTime9->setShippingTime(16, 20);
        $shipping = $testTime9->getShippingDate();
        Assert::equal('03.05.2016', $shipping->format('d.m.Y'), 'Time 23:25 to 16:20');

        $testTime10 = new Calendar(self::daterelease . ' 15:25');
        Assert::equal(TRUE, $testTime10->timeBellow(16, 20), 'Time 15:25 bellow 16:20');
        $testTime10->setShippingTime(16, 20);
        $shipping = $testTime10->getShippingDate();
        Assert::equal('02.05.2016', $shipping->format('d.m.Y'), 'Time 15:25 to 16:20');

        $testTime11 = new Calendar('25.4.2017 15:30');
        Assert::equal(FALSE, $testTime11->timeBellow(15, 00), 'Time 15:30 bellow 15:00');

        $testTime11->setShippingTime(15, 0);
        $shipping = $testTime11->getShippingDate();
        Assert::equal('27.04.2017', $shipping->format('d.m.Y'), 'Time 15:25 to 16:20');
    }

    public function testDodaniShipping2()
    {
        $testTime1 = new Calendar('19.4.2017 11:00');
        Assert::equal(TRUE, $testTime1->timeBellow(14, 0), 'Time 11:00 bellow 14:00');
        $testTime1->setShippingTime(14, 0);
        $shipping = $testTime1->getShippingDate();
        Assert::equal('20.04.2017', $shipping->format('d.m.Y'), 'Time 11:00 to 14:00');

        $testTime1->setShippingTime(10, 0);
        $shipping = $testTime1->getShippingDate();
        Assert::equal('21.04.2017', $shipping->format('d.m.Y'), 'Time 11:00 to 10:00');

        $testTime2 = new Calendar('21.4.2017 11:00');
        $testTime2->setShippingTime(10, 0);
        $testTime2->enableShippingWeekend();
        $shipping = $testTime2->getShippingDate();
        Assert::equal('23.04.2017', $shipping->format('d.m.Y'), 'Enabled Weekend shipping, Time 11:00 to 10:00');

        $testTime2->setShippingTime(12, 0);
        $shipping = $testTime2->getShippingDate();
        Assert::equal('22.04.2017', $shipping->format('d.m.Y'), 'Enabled Weekend shipping, Time 11:00 to 12:00');


        $testTime3 = new Calendar('21.4.2017 11:00');
        $testTime3->setShippingDays(3);
        $testTime3->setShippingTime(10, 0);
        $testTime3->enableShippingWeekend();
        $shipping = $testTime3->getShippingDate();
        Assert::equal('25.04.2017', $shipping->format('d.m.Y'), 'Enabled Weekend shipping, Shipping days 3, Time 11:00 to 10:00');

        $testTime3->setShippingDays(2);
        $testTime3->setShippingTime(12, 0);
        $shipping = $testTime3->getShippingDate();
        Assert::equal('23.04.2017', $shipping->format('d.m.Y'), 'Enabled Weekend shipping, Shipping days 2, Time 11:00 to 12:00');
    }

    public function testShippingAnotherTime()
    {
  		$testTime1 = new Calendar(self::daterelease . ' 11:00');
  		$testTime1->setShippingDays(2);
  		$testTime1->setShippingTime(14, 0);
        $shipping = $testTime1->getShippingDate();
  		Assert::equal('02.05.2016', $shipping->format('d.m.Y'), 'Time 11:00 to 14:00 +2D');

  		$testTime3 = new Calendar(self::daterelease . ' 11:00');
  		$testTime3->setShippingDays(3);
  		$testTime3->setShippingTime(14, 0);
        $shipping = $testTime3->getShippingDate();
  		Assert::equal('02.05.2016', $shipping->format('d.m.Y'), 'Time 11:00 to 14:00 +3D');

  		$testTime2 = new Calendar(self::daterelease . ' 14:01');
  		$testTime2->setShippingDays(3);
  		$testTime2->setShippingTime(14, 0);
        $shipping = $testTime2->getShippingDate();
  		Assert::equal('05.05.2016', $shipping->format('d.m.Y'), 'Time 14:01 to 14:00 +3D');

  		$testTime4 = new Calendar(self::daterelease . ' 14:01');
  		$testTime4->setShippingDays(2);
  		$testTime4->setShippingTime(14, 0);
        $shipping = $testTime4->getShippingDate();
  		Assert::equal('04.05.2016', $shipping->format('d.m.Y'), 'Time 14:01 to 14:00 +3D');
	}
}

$testCase = new DodaniTest();
$testCase->run();
