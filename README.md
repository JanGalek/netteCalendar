# nette Calendar

[![Travis] (https://travis-ci.org/JanGalek/netteCalendar.svg?branch=master)](https://travis-ci.org/JanGalek/netteCalendar)
[![Downloads this Month](https://img.shields.io/packagist/dm/galek/nette-calendar.svg)](https://packagist.org/packages/galek/nette-calendar)

Extend Nette\Utils\DateTime() for Nette framework


Package Installation
-------------------

The best way to install Nette Calendar is using [Composer](http://getcomposer.org/):

```sh
$ composer require galek/nette-calendar
```

[Packagist - Versions](https://packagist.org/packages/galek/nette-calendar)

or manual edit composer.json in your project

```json
"require": {
    "galek/nette-calendar": "^1.0"
}
```

Usage
-----

```php
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
    echo "Date for shipping:".$date->getShippingTime()->format('d.m.Y');

    echo "Date for shipping to some Hour and minute:".$date->getShippingTime(14,20)->format('d.m.Y');
    /**
    * $date->getShippingTime(14,20)
    * Friday 9:30 < 14:20 = Monday
    * Friday 14:30 > 14:20 = Wednesday (Monday send)
    * etc...
    **/
```