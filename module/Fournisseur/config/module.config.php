<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-05 10:41:54
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-03 15:43:05
 */

// module\Fournisseur\config\module.config.php

namespace Fournisseur;

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
			'fournisseur'=>array(
				// Définit le type de la route qui est ici "Zend\Mvc\Router\Http\Literal",
				// ainsi on pourra faire correspondre une action à un nom de route spécifique, une chaine prédéfinie
				'type'=>'Literal',
				// Configuration de la route
				'options'=>array(
					// Écoute les URI "/clients"
					'route'=>'/fournisseurs',
					// Définit le controller et l'action par défaut à exécuter quand la route correspond à l'URL
					'defaults'=>array(
						'__NAMESPACE__'=>'Fournisseur\Controller',
						'controller'=>'Index',
						'action'=>'listefournisseur',
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
                                '__NAMESPACE__' => 'Fournisseur\Controller',
                                'controller'    => 'Index',
                                'action'        => 'listefournisseur',
                            ),
                        ),
                    ),
                    'consulter_fournisseur'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'/:id',
                            'constraints'=>array(
                                'id'=>'[0-9]+',
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'Fournisseur\Controller',
                                'controller'    => 'Index',
                                'action'        => 'consulterfournisseur',
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
                                '__NAMESPACE__' => 'Fournisseur\Controller',
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
                                '__NAMESPACE__' => 'Fournisseur\Controller',
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
                                '__NAMESPACE__' => 'Fournisseur\Controller',
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
                                '__NAMESPACE__' => 'Fournisseur\Controller',
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
                                '__NAMESPACE__' => 'Fournisseur\Controller',
                                'controller'=>'Index',
                                'action'=>'supprimerinterlocuteursession'
                            )
                        )
                    ),
                ),
            ),
            'formulaire_fournisseur'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/formulaire-fournisseur[/:id]',
                    'constraints'=>array(
                        'id'=>'[0-9]+'
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__' => 'Fournisseur\Controller',
                        'controller'=>'Index',
                        'action'=>'formulairefournisseur',
                    )
                ),
            ),
            'supprimer_fournisseur'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/supprimer-fournisseur/:id',
                    'constraints'=>array(
                        'id'=>'[0-9]+',
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__' => 'Fournisseur\Controller',
                        'controller'=>'Index',
                        'action'=>'supprimerfournisseur',
                    )
                )
            ),
            'autocompletion_fournisseur'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/autocompletion_fournisseur',
                    'defaults'=>array(
                        'controller'=>'Fournisseur\Controller\Index',
                        'action'=>'autocompletionfournisseur'
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
			'Fournisseur\Controller\Index'=>'Fournisseur\Controller\IndexController'
		)
	),
	// Permet à l'application de connaitre l'emplacement des fichiers de vue du module
	'view_manager'=>array(
		'template_map' => array(
            'fournisseur/index'                                     => __DIR__ . '/../view/fournisseur/index/index.phtml',
            'fournisseur/fournisseur'			                    => __DIR__ . '/../view/fournisseur/index/listefournisseur.phtml',
            'fournisseur/interlocuteur'                             => __DIR__ . '/../view/fournisseur/index/listeinterlocuteur.phtml',
            'fournisseur/nouveau_fournisseur'                       => __DIR__ . '/../view/fournisseur/index/nouveaufournisseur.phtml',
            'fournisseur/modifier_fournisseur'                      => __DIR__ . '/../view/fournisseur/index/modifierfournisseur.phtml',
            'fournisseur/consulter_fournisseur'                     => __DIR__ . '/../view/fournisseur/index/consulterfournisseur.phtml',         
            'fournisseur/formulaire_interlocuteur'                  => __DIR__ . '/../view/fournisseur/index/formulaireinterlocuteur.phtml',
            'fournisseur/formulaire_interlocuteur_session'          => __DIR__ . '/../view/fournisseur/index/formulaireinterlocuteursession.phtml',
            'fournisseur/suppression_fournisseur'                   => __DIR__ . '/../view/fournisseur/modal/overlay-confirmation-suppression-fournisseur.phtml',
            'fournisseur/suppression_interlocuteur'                 => __DIR__ . '/../view/fournisseur/modal/overlay-confirmation-suppression-interlocuteur.phtml',
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