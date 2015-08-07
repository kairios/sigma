<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-22 16:18:02
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-22 17:03:00
 */

// module\Produit\config\module.config.php

namespace Produit;

use Zend\Session\Container;

// On récupère la langue de l'utilisateur
$utilisateurCourant = new Container('utilisateur');
if(isset($_GET['lang']))
    $utilisateurCourant->offsetSet('lang',$_GET['lang']);
if(null==$utilisateurCourant->offsetGet('lang'))
    $utilisateurCourant->offsetSet('lang','fr_FR');


return array(
	'router'=>array(
		'routes'=>array(
			'produit'=>array(
				'type'=>'Literal',
				'options'=>array(
					'route'=>'/produits',
					'defaults'=>array(
						'__NAMESPACE__'=>'Produit\Controller',
						'controller'=>'Index',
						'action'=>'index',
					),
				),
                'may_terminate'=>true,
                'child_routes'=>array(
                    'fournisseur'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'[/:action][/:id]',
                            'constraints'=>array(
                                'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'Produit\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                ),
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
    // Liste les controllers
	'controllers'=>array(
		// Controllers sans paramètres, qui n'ont pas besoin de passer par des factories
		'invokables'=>array(
			'Produit\Controller\Index'=>'Produit\Controller\IndexController'
		)
	),
	// Permet à l'application de connaitre l'emplacement des fichiers de vue du module
	'view_manager'=>array(
		'template_map' => array(
            'produit/index'                                     => __DIR__ . '/../view/produit/index/index.phtml',
            // 'produit/produit'			                    => __DIR__ . '/../view/produit/index/listeproduit.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        // 'strategies' => array(
        //     'ViewJsonStrategy',
        // ),
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
    'session' => array(
        'remember_me_seconds'   => 1800,
        'use_cookies'           => true,
        'cookie_httponly'       => true,
        //'cookie_domain'        => 'local.sigma.com',
        'cookie_domain'         =>  'dev.sigma.kairios.fr'
    ),
);

?>