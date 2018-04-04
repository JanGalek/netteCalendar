<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 4.4.2018
 */
declare(strict_types=1);

namespace GalekTests\Calendar\Models;

use Galek\Utils\Calendar\Configuration\Localization;


class Shippers extends \Galek\Utils\Calendar\Configuration\Shippers
{

	public function setShippers(array $shippers, Localization $localization): void
	{
		foreach ($shippers as $name => $shipper) {
			$this->list[$name] = new Shipper($name, $localization, $shipper['endHour'], $shipper['endMinute'], $shipper['weekend'], $shipper['deliveryTime']);
		}
	}
}
