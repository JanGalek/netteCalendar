<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\Configuration;


class Work
{

	public function __construct(array $settings, Localization $localization)
	{
		$this->startUp($settings);
	}


	protected function startUp(array $settings): void
	{

	}
}
