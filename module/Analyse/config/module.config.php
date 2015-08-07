<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-11 11:13:05
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-24 12:30:42
 */

namespace Analyse;

use Zend\Session\Container;

// On récupère la langue de l'utilisateur
$utilisateurCourant=new Container('utilisateur');
if(isset($_GET['lang']))
    $utilisateurCourant->offsetSet('lang',$_GET['lang']);
if(null==$utilisateurCourant->offsetGet('lang'))
    $utilisateurCourant->offsetSet('lang','fr_FR');

return array(
    'router' => array(
        'routes' => array(
        	'analyse'=>array(
        		'type'=>'Literal',
        		'options'=>array(
        			'route'=>'/analyses',
        			'defaults'=>array(
        				'__NAMESPACE__'=>'Analyse\Controller',
        				'controller'=>'Index',
        				'action'=>'index'
        			)
        		),
        	),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => $utilisateurCourant->offsetGet('lang'),
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Analyse\Controller\Index' => 'Analyse\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'analyse/index'           => __DIR__ . '/../view/analyse/index/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'layout'                   => 'layout/layout',
        'display_not_found_reason' => true,
        'not_found_template'       => 'error/404',
        'display_exceptions'       => true,
        'exception_template'       => 'error/index',
        'doctype'                  => 'HTML5',
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    // Doctrine configuration
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__.'_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/'.__NAMESPACE__.'/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                     __NAMESPACE__.'\Entity' =>  __NAMESPACE__.'_driver'
                ),
            ),
        ),
    ),
    'session' => array(
        'remember_me_seconds'   => 1800,
        'use_cookies'           => true,
        'cookie_httponly'       => true,
        //'cookie_domain'        => 'local.sigma.com',
        'cookie_domain'         =>  'dev.sigma.kairios.fr'
    ),
);