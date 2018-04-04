<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 4.4.2018
 */
declare(strict_types=1);
namespace GalekTests\Calendar\Models;

class Shipper extends \Galek\Utils\Calendar\Business\Shipper
{
	public $date;

	public function setCurrentDate(\Galek\Utils\Calendar\Calendar $date): void
	{
		$this->date = $date;
	}

	public function getCurrentDate(): \Galek\Utils\Calendar\Calendar
	{
		if (!$this->date) {
			return parent::getCurrentDate();
		}

		return $this->date;
	}
}
