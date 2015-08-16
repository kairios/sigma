<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-29 17:42:02
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-12 17:31:15
 */

// module\FicheHeure\config\module.config.php

namespace FicheHeure;

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
            'editer_fiche_heures'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/editer-fiche-heures',
                    'defaults'=>array(
                        'controller'=>'FicheHeure\Controller\Index',
                        'action'=>'editerficheheure'
                    ),
                ),
                'may_terminate'=>true,
                'child_routes'=>array(
                    'fiche_heure'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'[/:action][/:id]',
                            'constraints'=>array(
                                'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'FicheHeure\Controller',
                                'controller'    => 'Index',
                                'action'        => 'editerficheheure',
                            ),
                        ),
                    ),
                    'formulaire_saisie_horaire'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'/formulaire-saisie-horaire/:date',
                            'constraints'=>array(
                                'date'=>'[0-9]{4}-[0-9]{2}-[0-9]{2}'
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'FicheHeure\Controller',
                                'controller'=>'Index',
                                'action'=>'formulairesaisiehoraire'
                            )
                        )
                    ),
                    'formulaire_saisie_heure'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'/formulaire-saisie-heure/:id',
                            'constraints'=>array(
                                'id'=>'[0-9]+'
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'FicheHeure\Controller',
                                'controller'=>'Index',
                                'action'=>'formulairesaisieheure'
                            )
                        )
                    ),
                    'supprimer_saisie_heure'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'/supprimer-saisie-heure/:id',
                            'constraints'=>array(
                                'id'=>'[0-9]+'
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'FicheHeure\Controller',
                                'controller'=>'Index',
                                'action'=>'supprimersaisieheure'
                            )
                        ),
                    ),
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
            'FicheHeure\Controller\Index' => 'FicheHeure\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'fiche_heure/index'                     => __DIR__ . '/../view/fiche-heure/index/index.phtml',
            'fiche_heure/editer-fiche-heure'          => __DIR__ . '/../view/fiche-heure/index/editerficheheure.phtml',
            'fiche_heure/formulaire-saisie-horaire'   => __DIR__ . '/../view/fiche-heure/index/formulairesaisiehoraire.phtml',
            'fiche_heure/formulaire-saisie-heure'     => __DIR__ . '/../view/fiche-heure/index/formulairesaisieheure.phtml',
            'fiche_heure/recapitulatif-personnel'    => __DIR__ . '/../view/fiche-heure/index/recapitulatifpersonnel.phtml',
            'fiche_heure/recapitulatif-projet'    => __DIR__ . '/../view/fiche-heure/index/recapitulatifprojet.phtml',
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

?>