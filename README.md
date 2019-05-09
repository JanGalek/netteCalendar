# nette Calendar

[![Travis](https://travis-ci.org/JanGalek/netteCalendar.svg?branch=master)](https://travis-ci.org/JanGalek/netteCalendar)
[![Total Downloads](https://poser.pugx.org/galek/nette-calendar/downloads)](https://packagist.org/packages/galek/nette-calendar)
[![Latest Stable Version](https://poser.pugx.org/galek/nette-calendar/v/stable)](https://packagist.org/packages/galek/nette-calendar)
[![License](https://poser.pugx.org/galek/nette-calendar/license)](https://packagist.org/packages/galek/nette-calendar)
[![Monthly Downloads](https://poser.pugx.org/galek/nette-calendar/d/monthly)](https://packagist.org/packages/galek/nette-calendar)
[![Coverage Status](https://coveralls.io/repos/github/JanGalek/netteCalendar/badge.svg?branch=master)](https://coveralls.io/github/JanGalek/netteCalendar?branch=master)


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
```

Documentation
-------------

Learn more in the [documentation](https://github.com/JanGalek/netteCalendar/blob/master/docs/en/index.md) and [czech version of documentation](https://github.com/JanGalek/netteCalendar/blob/master/docs/cs/index.md).

Migration and changelog 1.x -> 2.x [documentation](https://github.com/JanGalek/netteCalendar/blob/master/docs/en/migration-1.x-to-2.x.md) and [czech version of documentation](https://github.com/JanGalek/netteCalendar/blob/master/docs/cs/migration-1.x-to-2.x.md).


Future
------

This repository will be rewrite to https://github.com/DateTi for smallest repositories and will use more interfaces ;)
