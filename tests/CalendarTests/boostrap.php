<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

use Tester\Environment;

if (@!include __DIR__ . '/../../vendor/autoload.php') {
    echo 'Install Nette Tester using `composer update --dev`';
    exit(1);
}

define('DATE_RELEASE', '29.04.2016');

const daterelease = '29.04.2016';

Environment::setup();
date_default_timezone_set('Europe/Prague');