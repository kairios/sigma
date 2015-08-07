<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-11 11:12:55
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-11 11:16:05
 */

namespace Analyse;

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