<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar\DI;


use Galek\Utils\Calendar\Configuration\CalendarManager;
use Nette\DI\CompilerExtension;


class Extension extends CompilerExtension
{
	use TExtension;

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$config = $this->getConfig();

		$this->checkConfig($config);

		$builder->addDefinition($this->prefix('galek.calendar'))
			->setFactory(CalendarManager::class, [$config]);
	}
}
