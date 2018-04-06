<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 6.4.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\DI;


use Galek\Utils\Calendar\Configuration\Configurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class SymfonyExtension extends \Symfony\Component\DependencyInjection\Extension\Extension
{
	use TExtension;

	/**
	 * Loads a specific configuration.
	 *
	 * @throws \InvalidArgumentException When provided tag is not defined in this extension
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$this->checkConfig($configs);

		$container->register('galek.calendar', Configurator::class)
			->addArgument($configs);
	}
}
