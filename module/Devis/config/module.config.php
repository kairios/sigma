<?php

// module\Devis\config\module.config.php

namespace Devis;

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
            'devis'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/devis',
                    'defaults'=>array(
                        'controller'=>'Devis\Controller\Index',
                        'action'=>'listedevis'
                    ),
                ),
                'may_terminate'=>true,
                'child_routes'=>array(
                    'devis'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'[/:action][/:id]',
                            'constraints'=>array(
                                'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'Devis\Controller',
                                'controller'    => 'Index',
                                'action'        => 'listedevis',
                            ),
                        ),
                    ),
                    'consulter_devis'=>array(
                        'type'=>'Segment',
                        'options'=>array(
                            'route'=>'/:id',
                            'constraints'=>array(
                                'id'=>'[0-9]+'
                            ),
                            'defaults'=>array(
                                '__NAMESPACE__' => 'Devis\Controller',
                                'controller'=>'Index',
                                'action'=>'consulterdevis',
                            ),
                        ),
                    ),
                ),
            ),
            'formulaire_devis'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/formulaire-devis[/:id]',
                    'constraints'=>array(
                        'id'=>'[0-9]+'
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__' => 'Devis\Controller',
                        'controller'=>'Index',
                        'action'=>'formulairedevis',
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
            'Devis\Controller\Index' => 'Devis\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'devis/index'                     => __DIR__ . '/../view/fiche-heure/index/index.phtml',
            // 'devis/editerficheheure'          => __DIR__ . '/../view/fiche-heure/index/editerficheheure.phtml',
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