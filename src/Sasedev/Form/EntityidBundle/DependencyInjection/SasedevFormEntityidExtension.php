<?php

namespace Sasedev\Form\EntityidBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 *
 * @author sasedev <seif.salah@gmail.com>
 *         This is the class that loads and manages your bundle configuration
 *         To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SasedevFormEntityidExtension extends Extension
{

	/**
	 *
	 * {@inheritDoc} @see ExtensionInterface::load()
	 */
	public function load(array $configs, ContainerBuilder $container)
	{

		$configuration = new Configuration();
		// $config = $this->processConfiguration($configuration, $configs);
		$this->processConfiguration($configuration, $configs);

		$loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yml');

	}

}
