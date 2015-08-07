<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-29 17:40:56
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-03 13:47:26
 */

// module\FicheHeure\src\FicheHeure\Controller\IndexController.php

namespace FicheHeure\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// EntityManager
use Doctrine\ORM\EntityManager;
// Session
use Zend\Session\Container;
use Personnel\Entity\Personnel;

class IndexController extends AbstractActionController
{
    /**
     * Entity Manager
     * @var DoctrineORMEntityManager
     */
    protected $em;

    public function getEntityManager()
    {
        if(null===$this->em)
        {
            $this->em=$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em=$em;
    }

    // Permet la redirection en cas d'utilisateur non authentifié à l'envoi
    // On utilise cette méthode car ce n'est pas possible de le faire dans le constructeur du controller
    // Faire en sorte de centraliser la méthode verifierConnexion() plutôt que la réécrire dans chaque controller, grâce aux gestionnaires d'évènement dans Module.php
	public function onDispatch(\Zend\Mvc\MvcEvent $e)
	{
	    $this->verifierConnexion();
	    return parent::onDispatch($e);
	}

	private function verifierConnexion($redirection=true)
    {
        // Récupération de la session utilisateur
        $utilisateur=new Container('utilisateur');

        if($utilisateur->offsetGet('connecte', false))
        {
            return true;
        }
        elseif($redirection)
        {
           $this->redirect()->toRoute('application_login');
           
        }
        else
        {
            return false;
        }
    }

    public function indexAction()
    {

    }

    public function editerficheheureAction()
    {
        $translator = $this->getServiceLocator()->get('Translator');

        $utilisateur = new Container('utilisateur');
        $utilisateurCourant = $utilisateur->offsetGet('identite');

        //Assignation de variables au layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $translator->translate('Fiche d\'heures'),
            'breadcrumbActive'  =>  $utilisateurCourant,
            'route'             =>  array(),
            'action'            =>  'editer_fiche_heure',
            'module'            =>  'fiche_heure',
            'plugins'           =>  array('fullcalendar'),
        ));

        return new ViewModel();
    }
}

?>