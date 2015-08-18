<?php
/**
 * @Author: Ophelie
 * @Date:   2015-08-18 16:36:01
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-18 17:15:42
 */

// module\Facture\Module.php

namespace Facture;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements ConfigProviderInterface,AutoloaderProviderInterface
{
	/**
	 * Retourne la configuration à inclure avec celle de l'application
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