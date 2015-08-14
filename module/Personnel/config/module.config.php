<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-23 13:34:29
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-14 13:56:52
 */

// module\Personnel\config\module.config.php

namespace Personnel;

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
            'personnel'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/utilisateurs',
                    'constraints'=>array(
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__' => 'Personnel\Controller',
                        'controller'    => 'Index',
                        'action'        => 'listepersonnel',
                    ),
                ),
                'may_terminate'=>true,
                'child_routes'=>array(
                    'personnel'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'[/:action][/:id]',
                            'constraints'=>array(
                                'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),
                            'defaults'=>array(
                                'controller'    => 'Index',
                                'action'        => 'listepersonnel',
                            ),
                        ),
                    ),
                ),
            ),
			// Première route appelée "client"
			'profil'=>array(
				// Définit le type de la route qui est ici "Zend\Mvc\Router\Http\Literal",
				// ainsi on pourra faire correspondre une action à un nom de route spécifique, une chaine prédéfinie
				'type'=>'Literal',
				// Configuration de la route
				'options'=>array(
					// Écoute les URI "/clients"
					'route'=>'/profil',
					// Définit le controller et l'action par défaut à exécuter quand la route correspond à l'URL
					'defaults'=>array(
						'__NAMESPACE__'=>'Personnel\Controller',
						'controller'=>'Index',
						'action'=>'profil',
					),
                    'constraints'=>array(
                    ),
				),
                'may_terminate'=>true,
                'child_routes'=>array(
                    'formulaire_password'=>array(
                        'type'=>'Literal',
                        'options'=>array(
                            'route'=>'/formulaire-password',
                            'defaults'=>array(
                                'action'=>'formulairepassword',
                            ),
                        ),
                    ),
                ),
			),
            'formulaire_personnel'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/formulaire-utilisateur[/:id]',
                    'constraints'=>array(
                        'id'=>'[0-9]+'
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__'=>'Personnel\Controller',
                        'controller'=>'Index',
                        'action'=>'formulairepersonnel',
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
			'Personnel\Controller\Index'=>'Personnel\Controller\IndexController'
		)
	),
	// Permet d'appeler des vues plus simplement
	'view_manager'=>array(
		'template_map' => array(
            'personnel/index'                               => __DIR__ . '/../view/personnel/index/listepersonnel.phtml',
            'personnel/profil'	                            => __DIR__ . '/../view/personnel/index/profil.phtml',
            'personnel/formulaire-password'                 => __DIR__ . '/../view/personnel/index/formulairepassword.phtml',
            'personnel/overlay_formulaire_personnel'        => __DIR__ . '/../view/personnel/modal/overlay-formulaire-personnel.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
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