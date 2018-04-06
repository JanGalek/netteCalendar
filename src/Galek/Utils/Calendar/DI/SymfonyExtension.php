<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 6.4.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\DI;


use Galek\Utils\Calendar\Configuration\Configurator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


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
		$configuration = $this->getConfiguration($configs, $container);
		$config = $this->processConfiguration($configuration, $configs);

		dump($config);

		$this->checkConfig($configs);

		//$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config/'));

		$container->register('galek.calendar', Configurator::class)
			->addArgument($configs);
	}
}
