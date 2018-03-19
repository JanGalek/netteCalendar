<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 19.3.2018
 */
declare(strict_types=1);

namespace Galek\Utils\Calendar\DI;


use Galek\Utils\Calendar\Configuration\Configurator;
use Nette\DI\CompilerExtension;


class Extension extends CompilerExtension
{
	private $defaultWork = [
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

	private $defaultShipper = [
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


	private function checkConfig(array & $config): void
	{
		$this->checkCountry($config);
		$this->checkShippers($config);
		$this->checkWork($config);
	}


	private function checkCountry(array & $config): void
	{
		foreach ($config as $group => $setting) {
			if (!array_key_exists('country', $setting)) {
				$config[$group][ 'country' ] = 'CzechRepublic';
			}
		}
	}


	private function checkShippers(array & $config): void
	{
		foreach ($config as $group => $setting) {
			if (!array_key_exists('shippers', $setting)) {
				$config[$group]['shippers'] = [];
			} else {
				foreach ($setting['shippers'] as $name => $shipper) {
					if (!array_key_exists('endHour', $shipper)) {
						$config[$group]['shippers'][$name]['endHour'] = $this->defaultShipper['endHour'];
					}
					if (!array_key_exists('endMinute', $shipper)) {
						$config[$group]['shippers'][$name]['endMinute'] = $this->defaultShipper['endMinute'];
					}
					if (!array_key_exists('weekend', $shipper)) {
						$config[$group]['shippers'][$name]['weekend'] = $this->defaultShipper['weekend'];
					}
					if (!array_key_exists('deliveryTime', $shipper)) {
						$config[$group]['shippers'][$name]['deliveryTime'] = $this->defaultShipper['deliveryTime'];
					}
				}
			}
		}
	}


	private function checkWork(array & $config): void
	{
		foreach ($config as $group => $setting) {
			if (!array_key_exists('work', $setting)) {
				$config[$group]['work'] = $this->defaultWork;
			} else {
				if (!array_key_exists('start', $setting['work'])) {
					$config[$group]['work']['start'] = $this->defaultWork['start'];
				} else {
					if (!array_key_exists('hour', $setting['work']['start'])) {
						$config[$group]['work']['start']['hour'] = $this->defaultWork['start']['hour'];
					}
					if (!array_key_exists('minute', $setting['work']['start'])) {
						$config[$group]['work']['start']['minute'] = $this->defaultWork['start']['minute'];
					}
				}
				if (!array_key_exists('end', $setting['work'])) {
					$config[$group]['work']['end'] = $this->defaultWork['end'];
				} else {
					if (!array_key_exists('hour', $setting['work']['end'])) {
						$config[$group]['work']['end']['hour'] = $this->defaultWork['end']['hour'];
					}
					if (!array_key_exists('minute', $setting['work']['start'])) {
						$config[$group]['work']['end']['minute'] = $this->defaultWork['end']['minute'];
					}
				}
				if (!array_key_exists('weekend', $setting['work'])) {
					$config[$group]['work']['weekend'] = $this->defaultWork['weekend'];
				}
			}
		}
	}


}
