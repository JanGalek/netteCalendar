Použití
-------

```php
    use \Galek\Utils\Calendar;

    $date = new Calendar();

    if($date->isWorkday()){
        echo "Today is workday :/";
    }

    if($date->isHoliday()){
        echo "Today is holiday :)";
    }

// Velikonoce
    echo "Velikonoce tento rok jsou: ".$date->getEaster();
    echo "Velikonoce roku 2020 jsou: ".$date->getEaster(2020);
    echo "Velikonoční pondělí je tento rok: ".$date->getEasterMonday();
    echo "Velký pátek je tento rok: ".$date->getBigFriday();

    echo "Dnes nebo příští pracovní den je:".$date->getWorkday()->format('d.m.Y');
    echo "Další pracovní den je:".$date->getWorkday(true)->format('d.m.Y');
    
// Něco pro e-shopy ;)
    $date->setShippingTime(14, 20);
    echo "Datum dopravy v určitou hodinu a minutu:".$date->getShippingDate()->format('d.m.Y');
    
    /**
     * $date->setShippingTime(14, 20);
     * $date->getShippingDate()
     * Pátek 9:30 < 14:20 = Pondělí
     * Pátek 14:30 > 14:20 = Středa (V pondělí se odesílá)
     * etc...
     **/
     
     $date->enableShippingWeekend();
     $date->setShippingTime(14, 20);
     echo "Datum dopravy v určitou hodinu a minutu a to i o výkendu:".$date->getShippingDate()->format('d.m.Y');
     
     $date->setShippingDays(3); // Default 1
     $date->setShippingTime(14, 20);
     echo "Datum dopravy v určitou hodinu a minutu s prodlevou:".$date->getShippingDate()->format('d.m.Y');
```

Ukázka #1
```php
    use \Galek\Utils\Calendar;

    $date = new Calendar();
    
    //            Hodina, Minuta
    $date->timeBellow(14, 20); // kontrola jestli je čas nižší nebo rovno 
    
    //          Hodina, Minuta
    $date->timeOver(15, 30); // kontrola jestli je čas vyšší nebo rovno 
    
    //         Hodina, Minuta, Hodina, Minuta
    $date->timeBetween(14, 20, 15, 30); // kontrola jestli je čas mezi (nebo rovno) 
```

Ukázka #2
```php
    use \Galek\Utils\Calendar;

    $date = new Calendar();
    
    //           Hodina, Minuta, Hodina, Minuta
    $date->setWorkTime(8, 0, 16, 30); // nastaví pracovní dobu 
    
    if ($date->isWorkTime() { // Zkontroluje jestli je pracovní doba
        // váš kód ...
    }
```