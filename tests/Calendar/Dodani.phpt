<?php

require_once __DIR__ . '/CalendarTestCase.php';

use Tester\Assert;
use Galek\Utils\Calendar;

class DodaniTest extends CalendarTestCase{

    private $container;

    function __construct(){
    }

    public function testRenderPoup()
    {
    		$testTime1 = new Calendar(self::daterelease.' 14:02');
    		$testTime1->modify('+4 days');

    		Assert::equal('2', $testTime1->format('w'), 'Test dne v tydnu');
    		$testTime2 = new Calendar(self::daterelease.' 14:02');

    		$testTime2->modify('+2 days');
    		Assert::equal('0', $testTime2->format('w'), 'Test Nedele');
    }

    public function testDodaniShipping()
    {
    		$testTime1 = new Calendar(self::daterelease.' 11:00');
    		Assert::equal(true, $testTime1->timeBellow(14, 0), 'Time 11:00 bellow 14:00');
    		$testTime1->getShippingTime(14, 0);
    		Assert::equal('02.05.2016', $testTime1->format('d.m.Y'), 'Time 11:00 to 14:00');

    		$testTime2 = new Calendar(self::daterelease.' 14:01');
    		Assert::equal(false, $testTime2->timeBellow(14, 0), 'Time 11:00 bellow 14:00');
    		$testTime2->getShippingTime(14, 0);
    		Assert::equal('03.05.2016', $testTime2->format('d.m.Y'), 'Time 14:01 to 14:00');

    		$testTime3 = new Calendar(self::daterelease.' 15:12');
    		Assert::equal(false, $testTime3->timeBellow(14, 0), 'Time 15:12 bellow 14:00');
    		$testTime3->getShippingTime(14, 0);
    		Assert::equal('03.05.2016', $testTime3->format('d.m.Y'), 'Time 15:12 to 14:00');

    		$testTime4 = new Calendar('30.04.2016 11:12');
    		Assert::equal(true, $testTime4->timeBellow(14, 0), '+1D Time 11:12 bellow 14:00');
    		$testTime4->getShippingTime(14, 0);
    		Assert::equal('03.05.2016', $testTime4->format('d.m.Y'), '+1D Time 11:12 to 14:00');

    		$testTime5 = new Calendar('30.04.2016 15:12');
    		Assert::equal(false, $testTime5->timeBellow(14, 0), '+1D Time 15:12 bellow 14:00');
    		$testTime5->getShippingTime(14, 0);
    		Assert::equal('03.05.2016', $testTime5->format('d.m.Y'), '+1D Time 15:12 to 14:00');

    		$testTime6 = new Calendar('01.05.2016 11:12');
    		Assert::equal(true, $testTime6->timeBellow(14, 0), '+2D Time 11:12 bellow 14:00');
    		$testTime6->getShippingTime(14, 0);
    		Assert::equal('03.05.2016', $testTime6->format('d.m.Y'), '+2D Time 11:12 to 14:00');

    		$testTime7 = new Calendar('01.05.2016 15:12');
    		Assert::equal(false, $testTime7->timeBellow(14, 0), '+2D Time 15:12 bellow 14:00');
    		$testTime7->getShippingTime(14, 0);
    		Assert::equal('03.05.2016', $testTime7->format('d.m.Y'), '+2D Time 15:12 to 14:00');

    		$testTime8 = new Calendar('30.04.2016 23:25');
    		Assert::equal(false, $testTime8->timeBellow(16, 20), '+1D Time 23:25 bellow 16:20');
    		$testTime8->getShippingTime(16, 20);
    		Assert::equal('03.05.2016', $testTime8->format('d.m.Y'), '+1D Time 23:25 to 16:20');

    		$testTime9 = new Calendar(self::daterelease.' 23:25');
    		Assert::equal(false, $testTime9->timeBellow(16, 20), 'Time 23:25 bellow 16:20');
    		$testTime9->getShippingTime(16, 20);
    		Assert::equal('03.05.2016', $testTime9->format('d.m.Y'), 'Time 23:25 to 16:20');

    		$testTime10 = new Calendar(self::daterelease.' 15:25');
    		Assert::equal(true, $testTime10->timeBellow(16, 20), 'Time 15:25 bellow 16:20');
    		$testTime10->getShippingTime(16, 20);
    		Assert::equal('02.05.2016', $testTime10->format('d.m.Y'), 'Time 15:25 to 16:20');
    }

	public function testShippingAnotherTime()
  {
  		$testTime1 = new Calendar(self::daterelease.' 11:00');
  		$testTime1->setShippingDays(2);
  		$testTime1->getShippingTime(14, 0);
  		Assert::equal('03.05.2016', $testTime1->format('d.m.Y'), 'Time 11:00 to 14:00 +2D');

  		$testTime3 = new Calendar(self::daterelease.' 11:00');
  		$testTime3->setShippingDays(3);
  		$testTime3->getShippingTime(14, 0);
  		Assert::equal('04.05.2016', $testTime3->format('d.m.Y'), 'Time 11:00 to 14:00 +3D');

  		$testTime2 = new Calendar(self::daterelease.' 14:01');
  		$testTime2->setShippingDays(3);
  		$testTime2->getShippingTime(14, 0);
  		Assert::equal('05.05.2016', $testTime2->format('d.m.Y'), 'Time 14:01 to 14:00 +3D');

  		$testTime4 = new Calendar(self::daterelease.' 14:01');
  		$testTime4->setShippingDays(2);
  		$testTime4->getShippingTime(14, 0);
  		Assert::equal('04.05.2016', $testTime4->format('d.m.Y'), 'Time 14:01 to 14:00 +3D');
	}
}

$testCase = new DodaniTest();
$testCase->run();
