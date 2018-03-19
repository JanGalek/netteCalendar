<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\DI;


use Galek\Utils\Calendar\Calendar;
use Nette\DI\CompilerExtension;


class Extension extends CompilerExtension
{
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig([
			'transports' => [],
			''
		]);

		$transports = $config['transports'];

		foreach ($transports as $index => $tConfig) {
			//$builder->addDefinition()
		}


		$builder->addDefinition($this->prefix('galek.calendar'))
			->setType(Calendar::class, [

			]);
	}
}
