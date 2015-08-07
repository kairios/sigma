<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-23 13:34:48
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-23 13:37:46
 */

// module\Personnel\Module.php

namespace Personnel;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements ConfigProviderInterface,AutoloaderProviderInterface
{
	/**
	 * Retourne la configuration à inclure avec celle du module
	 * @return array|\Traversable
	 */
	public function getConfig()
	{
		return include __DIR__.'/config/module.config.php';
	}

	/**
	 * Retourne un tableau transmis à Zend\Loader\AutoloaderFactory
	 * @return array 
	 */
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader'=>array(
				'namespaces'=>array(
					__NAMESPACE__=>__DIR__.'/src/'.__NAMESPACE__,
				)
			)
		);
	}
}


?>