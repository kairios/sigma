<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-09 13:33:27
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-09 13:40:59
 */

namespace Adresse;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}

?>