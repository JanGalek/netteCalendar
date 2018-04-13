<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 6.4.2018
 */
declare(strict_types = 1);

namespace Galek\Utils\Calendar\DI;


trait TExtension
{
	protected $defaultWork = [
		'start' => [
			'hour' => 8,
			'minute' => 0,
		],
		'end' => [
			'hour' => 16,
			'minute' => 30,
		],
		'weekend' => false,
	];

	protected $defaultShipper = [
		'endHour' => 14,
		'endMinute' => 0,
		'weekend' => false,
		'deliveryTime' => 1,
	];


	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$config = $this->getConfig();

		$this->checkConfig($config);

		$builder->addDefinition($this->prefix('galek.calendar'))
			->setFactory(Configurator::class, [$config]);
	}


	protected function checkConfig(array & $config): void
	{
		$this->checkCountry($config);
	}


	protected function checkCountry(array & $config): void
	{
		foreach ($config as $group => $setting) {
			if (!array_key_exists('country', $setting)) {
				$config[$group]['country'] = 'CzechRepublic';
			}
		}
	}
}
