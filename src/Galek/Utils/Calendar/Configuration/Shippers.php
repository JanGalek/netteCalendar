<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Configuration;


use Galek\Utils\Calendar\Business\IShipper;
use Galek\Utils\Calendar\Business\Shipper;


class Shippers
{
	/**
	 * @var Shipper[]
	 */
	protected $list;

	/**
	 * @var Localization
	 */
	protected $localization;


	public function __construct(array $shippers = [], Localization $localization)
	{
		$this->localization = $localization;
		$this->setShippers($shippers, $localization);
	}


	public function setShippers(array $shippers, Localization $localization): void
	{
		foreach ($shippers as $name => $shipper) {
			$this->list[$name] = new Shipper($name, $localization, $shipper['endHour'], $shipper['endMinute'], $shipper['weekend'], $shipper['deliveryTime']);
		}
	}

	public function getLocalization(): Localization
	{
		return $this->localization;
	}


	public function getShipper(string $name): IShipper
	{
		return $this->list[$name];
	}


	public function getShippers()
	{
		return $this->list;
	}

}
