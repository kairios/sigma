<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-20 10:28:42
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-14 13:55:08
 */

// module\Client\config\module.config.php

namespace Client;

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
			'client'=>array(
				// Définit le type de la route qui est ici "Zend\Mvc\Router\Http\Literal",
				// ainsi on pourra faire correspondre une action à un nom de route spécifique, une chaine prédéfinie
				'type'=>'Literal',
				// Configuration de la route
				'options'=>array(
					// Écoute les URI "/clients"
					'route'=>'/clients',
					// Définit le controller et l'action par défaut à exécuter quand la route correspond à l'URL
					'defaults'=>array(
						'__NAMESPACE__'=>'Client\Controller',
						'controller'=>'Index',
						'action'=>'listeclient',
					),
				),
				'may_terminate'=>true,
				'child_routes'=>array(
					'client'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'[/:action][/:id]',
							'constraints'=>array(
								'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
								'id'=>'[0-9]+',
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
                        		'controller'    => 'Index',
                        		'action'        => 'listeclient',
                        	),
						),
					),
					'consulter_client'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/:id',
							'constraints'=>array(
								'id'=>'[0-9]+',
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
                        		'controller'    => 'Index',
                        		'action'        => 'consulterclient',
                        	),
                        ),
                    ),
					'interlocuteur'=>array(
						'type'=>'Literal',
						'options'=>array(
							'route'=>'/interlocuteurs',
							'constraints'=>array(
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
                        		'controller'    => 'Index',
                        		'action'        => 'listeinterlocuteur',
                        	),
						),
					),
					'consulter_interlocuteur'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/interlocuteurs/:id',
							'constraints'=>array(
								'id'=>'[0-9]+',
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
                        		'controller'    => 'Index',
                        		'action'        => 'consulterinterlocuteur',
                        	),
						),
					),
					'formulaire_interlocuteur'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/formulaire-interlocuteur[/:id]',
							'constraints'=>array(
								'id'=>'[0-9]+'
							),
							'defaults'=>array(
								'controller'=>'Index',
								'action'=>'formulaireinterlocuteur'
							)
						)
					),
					'supprimer_interlocuteur'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/supprimer-interlocuteur/:id',
							'constraints'=>array(
								'id'=>'[0-9]+',
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
								'controller'=>'Index',
								'action'=>'supprimerinterlocuteur'
							)
						)
					),
					'formulaire_interlocuteur_session'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/formulaire-interlocuteur-session[/:id]',
							'constraints'=>array(
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
								'controller'=>'Index',
								'action'=>'formulaireinterlocuteursession'
							)
						)
					),
					'supprimer_interlocuteur_session'=>array(
						'type'=>'Segment',
						'options'=>array(
							'route'=>'/supprimer-interlocuteur-session/:id',
							'constraints'=>array(
							),
							'defaults'=>array(
								'__NAMESPACE__' => 'Client\Controller',
								'controller'=>'Index',
								'action'=>'supprimerinterlocuteursession'
							)
						)
					),
				),
			),
			'formulaire_client'=>array(
				'type'=>'Segment',
				'options'=>array(
					'route'=>'/formulaire-client[/:id]',
					'constraints'=>array(
						'id'=>'[0-9]+'
					),
					'defaults'=>array(
						'__NAMESPACE__' => 'Client\Controller',
						'controller'=>'Index',
						'action'=>'formulaireclient',
					)
				),
			),
			'supprimer_client'=>array(
				'type'=>'Segment',
				'options'=>array(
					'route'=>'/supprimer-client/:id',
					'constraints'=>array(
						'id'=>'[0-9]+',
					),
					'defaults'=>array(
						'__NAMESPACE__' => 'Client\Controller',
						'controller'=>'Index',
						'action'=>'supprimerclient',
					)
				)
			),
			'autocompletion_client'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/autocompletion_client',
                    'defaults'=>array(
                        'controller'=>'Client\Controller\Index',
                        'action'=>'autocompletionclient'
                    ),
                ),
            ),
            'autocompletion_interlocuteur'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/autocompletion_interlocuteur',
                    'defaults'=>array(
                        'controller'=>'Client\Controller\Index',
                        'action'=>'autocompletioninterlocuteur'
                    ),
                ),
            ),
            'segment'=>array(
            	'type'=>'Literal',
            	'options'=>array(
            		'route'=>'/segments',
            		'defaults'=>array(
            			'controller'=>'Client\Controller\Index',
            			'action'=>'listesegment'
            		),
            	),
            ),
            'produit_fini'=>array(
            	'type'=>'Literal',
            	'options'=>array(
            		'route'=>'/produits_finis',
            		'defaults'=>array(
            			'controller'=>'Client\Controller\Index',
            			'action'=>'listeproduitfini'
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
	
	// 'doctrine' => array(
 //        'driver' => array(
 //            'Client_driver' => array(
 //                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
 //                'cache' => 'array',
 //                'paths' => array(__DIR__ . '/../src/Client/Entity')
 //            ),
 //            'orm_default' => array(
 //                'drivers' => array(
 //                     'Client\Entity' =>  'Client_driver'
 //                ),
 //            ),
 //        ),
 //    ),
	
    // Liste les controllers
	'controllers'=>array(
		// Controllers sans paramètres, qui n'ont pas besoin de passer par des factories
		'invokables'=>array(
			'Client\Controller\Index'=>'Client\Controller\IndexController'
		)
	),
	// Permet à l'application de connaitre l'emplacement des fichiers de vue du module
	'view_manager'=>array(
		'template_map' => array(
            'client/index'           					=> __DIR__ . '/../view/client/index/index.phtml',
            'client/client'			 					=> __DIR__ . '/../view/client/index/listeclient.phtml',
            'client/interlocuteur'   					=> __DIR__ . '/../view/client/index/listeinterlocuteur.phtml',
            'client/nouveau_client'	 					=> __DIR__ . '/../view/client/index/nouveauclient.phtml',
            'client/modifier_client' 					=> __DIR__ . '/../view/client/index/modifierclient.phtml',
            'client/consulter_client'					=> __DIR__ . '/../view/client/index/consulterclient.phtml',
            'client/formulaire_interlocuteur'			=> __DIR__ . '/../view/client/index/formulaireinterlocuteur.phtml',
            'client/formulaire_interlocuteur_session'	=> __DIR__ . '/../view/client/index/formulaireinterlocuteursession.phtml',
            'client/suppression_client'					=> __DIR__ . '/../view/client/modal/overlay-confirmation-suppression-client.phtml',
            'client/suppression_interlocuteur'			=> __DIR__ . '/../view/client/modal/overlay-confirmation-suppression-interlocuteur.phtml',
            'client/overlay_formulaire_interlocuteur'	=> __DIR__ . '/../view/client/modal/overlay-formulaire-interlocuteur.phtml',
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