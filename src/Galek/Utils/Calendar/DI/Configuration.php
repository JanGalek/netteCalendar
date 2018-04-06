<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 6.4.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\DI;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{

	/**
	 * Generates the configuration tree builder.
	 *
	 * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('galek_calendar_extension');

		// TODO: Implement getConfigTreeBuilder() method.
	}
}
