<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-30 09:23:52
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-13 14:05:08
 */

// module\Affaire\config\module.config.php

namespace Affaire;

use Zend\Session\Container;

// On récupère la langue de l'utilisateur
$utilisateurCourant=new Container('utilisateur');
if(isset($_GET['lang']))
    $utilisateurCourant->offsetSet('lang',$_GET['lang']);
if(null==$utilisateurCourant->offsetGet('lang'))
    $utilisateurCourant->offsetSet('lang','fr_FR');

return array(
	// Cette ligne ouvre la configuration pour le RouteManager
	'router'=>array(
		// Permet de définir une multitude de routes
		'routes'=>array(
			// Première route appelée "client"
			'affaire'=>array(
				// Définit le type de la route qui est ici "Zend\Mvc\Router\Http\Literal",
				// ainsi on pourra faire correspondre une action à un nom de route spécifique, une chaine prédéfinie
				'type'=>'Literal',
				// Configuration de la route
				'options'=>array(
					// Écoute les URI "/clients"
					'route'=>'/affaires',
					// Définit le controller et l'action par défaut à exécuter quand la route correspond à l'URL
					'defaults'=>array(
						'__NAMESPACE__'	=>'Affaire\Controller',
						'controller'	=>'Index',
						'action'		=>'listeaffaire',
					),
				),
				'may_terminate'=>true,
				'child_routes'=>array(
					'affaire'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'[/:action][/:id]',
							'constraints'=>array(
								'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
								'id'=>'[0-9]+',
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Affaire\Controller',
                        		'controller'    => 'Index',
                        		'action'        => 'listeaffaire',
                        	),
						),
					),
					'consulter_affaire'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/affaire-:id',
							'constraints'=>array(
								'id'=>'[0-9]+'
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Affaire\Controller',
								'controller'=>'Index',
								'action'=>'consulteraffaire',
							),
						),
					),
				),
			),
			'formulaire_affaire'=>array(
				'type'=>'Segment',
				'options'=>array(
					'route'=>'/formulaire-affaire[/:id]',
					'constraints'=>array(
						'id'=>'[0-9]+'
					),
					'defaults'=>array(
						'__NAMESPACE__' => 'Affaire\Controller',
						'controller'=>'Index',
						'action'=>'formulaireaffaire',
					)
				),
			),
			'supprimer_affaire'=>array(
				'type'=>'Segment',
				'options'=>array(
					'route'=>'/supprimer-affaire/:id',
					'constraints'=>array(
						'id'=>'[0-9]+',
					),
					'defaults'=>array(
						'__NAMESPACE__' => 'Affaire\Controller',
						'controller'=>'Index',
						'action'=>'index',
					)
				)
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
			'Affaire\Controller\Index'=>'Affaire\Controller\IndexController'
		)
	),
	// Permet à l'application de connaitre l'emplacement des fichiers de vue du module
	'view_manager'=>array(
		'template_map' => array(
            'affaire/index'           					=> __DIR__ . '/../view/affaire/index/index.phtml',
            'affaire/affaire'			 				=> __DIR__ . '/../view/affaire/index/listeaffaire.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
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
    'session' => array(
        'remember_me_seconds'   => 1800,
        'use_cookies'           => true,
        'cookie_httponly'       => true,
        //'cookie_domain'        => 'local.sigma.com',
        'cookie_domain'         =>  'dev.sigma.kairios.fr'
    ),
);

?>