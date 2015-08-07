<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-09 13:34:06
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-24 12:29:50
 */

namespace Adresse;

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
            'autocompletion_adresse'=>array(
                'type'=>'Literal',
                'options'=>array(
                    'route'=>'/autocompletion_adresse',
                    'defaults'=>array(
                        'controller'=>'Adresse\Controller\Index',
                        'action'=>'autocompletionadresse'
                    ),
                ),
            ),
            'formulaire_adresse'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/formulaire-adresse[/:id]',
                    'constraints'=>array(
                        //'id'=>'[0-9]+'
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__' => 'Adresse\Controller',
                        'controller'=>'Index',
                        'action'=>'formulaireadresse',
                    )
                ),
            ),
            'formulaire_adresse_session'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/formulaire-adresse-session[/:id]',
                    'constraints'=>array(
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__' => 'Adresse\Controller',
                        'controller'=>'Index',
                        'action'=>'formulaireadressesession',
                    )
                ),
            ),
            'supprimer_adresse_session'=>array(
                'type'=>'Segment',
                'options'=>array(
                    'route'=>'/supprimer-adresse-session/:id',
                    'constraints'=>array(
                    ),
                    'defaults'=>array(
                        'controller'=>'Adresse\Controller\Index',
                        'action'=>'supprimeradressesession',
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
            'Adresse\Controller\Index' => 'Adresse\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'adresse/index'           => __DIR__ . '/../view/adresse/index/index.phtml',
            'adresse/formulaireadresse' => __DIR__ . '/../view/adresse/index/formulaireadresse.phtml',
            'adresse/formulaireadressesession' => __DIR__ . '/../view/adresse/index/formulaireadressesession.phtml',
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