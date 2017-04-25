Usage
-----

```php
    use \Galek\Utils\Calendar;

    $date = new Calendar();

    if($date->isWorkday()){
        echo "Today is workday :/";
    }

    if($date->isHoliday()){
        echo "Today is holiday :)";
    }

// Easter
    echo "Easter of this year is: ".$date->getEaster();
    echo "Easter of 2020 year is: ".$date->getEaster(2020);
    echo "Easter Monday of this year is: ".$date->getEasterMonday();
    echo "Easter Big Friday of this year is: ".$date->getBigFriday();

    echo "Today or next workday:".$date->getWorkday()->format('d.m.Y');
    echo "Next workday:".$date->getWorkday(true)->format('d.m.Y');

// Something for e-shops ;)
    $date->setShippingTime(14, 20);
    echo "Date for shipping to some Hour and minute:".$date->getShippingDate()->format('d.m.Y');
    
    /**
     * $date->setShippingTime(14, 20);
     * $date->getShippingDate()
     * Friday 9:30 < 14:20 = Monday
     * Friday 14:30 > 14:20 = Wednesday (Monday send)
     * etc...
     **/

     $date->enableShippingWeekend();
     $date->setShippingTime(14, 20);
     echo "Date for shipping to some Hour and minute include weekend:".$date->getShippingDate()->format('d.m.Y');
     
     $date->setShippingDays(3); // Default 1
     $date->setShippingTime(14, 20);
     echo "Date for shipping to some Hour and minute with delay:".$date->getShippingDate()->format('d.m.Y');
```

Example #1
```php
    use \Galek\Utils\Calendar;

    $date = new Calendar();
    
    //              Hour, Minute
    $date->timeBellow(14, 20); // check if time is bellow or equal 
    
    //            Hour, Minute
    $date->timeOver(15, 30); // check if time is over or equal 
    
    //           Hour, Minute, Hour, Minute
    $date->timeBetween(14, 20, 15, 30); // check if time is between (or equal) 
```

Example #2
```php
    use \Galek\Utils\Calendar;

    $date = new Calendar();
    
    //         Hour, Minute, Hour, Minute
    $date->setWorkTime(8, 0, 16, 30); // set work time
    
    if ($date->isWorkTime() { // Check if is work time
        // your code ...
    }
```