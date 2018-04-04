<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 4.4.2018
 */
declare(strict_types=1);

namespace GalekTests\Calendar\Models;


use Galek\Utils\Calendar\Localization;


class Configurator extends \Galek\Utils\Calendar\Configuration\Configurator
{
	protected function setShippers(string $group, array $shippers, \Galek\Utils\Calendar\Configuration\Localization $localization): void
	{
		$this->shippers[$group] = new Shippers($shippers, $localization);
	}

}
