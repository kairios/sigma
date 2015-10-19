<?php
/**
 * @Author: Anthony
 * @Date:   2015-08-27 11:35:01
 * @Last Modified by:   Anthony
 * @Last Modified time: 2015-08-27 11:35:01
 */

namespace Facture\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// EntityManager
use Doctrine\ORM\EntityManager;
// Session
use Zend\Session\Container;
// Entity
use Devis\Entity\LigneDevis;
use Devis\Form\DevisForm;





class IndexController extends AbstractActionController {

	/**
     * Entity Manager
     * @var DoctrineORMEntityManager
     */
    protected $em;


    /* Permet la redirection en cas d'utilisateur non authentifié à l'envoi
    On utilise cette méthode car ce n'est pas possible de le faire dans le constructeur du controller
    Faire en sorte de centraliser la méthode verifierConnexion() plutôt que la réécrire dans chaque controller, grâce aux gestionnaires d'évènement dans Module.php */
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {

	    $this->verifierConnexion();
	    return parent::onDispatch($e);
	}

	private function verifierConnexion($redirection = true) {
        
        // Récupération de la session utilisateur
        $utilisateur = new Container('utilisateur');

        if($utilisateur->offsetGet('connecte', false)) {

            return true;
        }
        else if($redirection) {

            $this->redirect()->toRoute('application_login');
            header('location:/authentification');
        }
        else {
            
            return false;
        }
    }



	public function getEntityManager() {

        if(null === $this->em) {

            $this->em=$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }

        return $this->em;
    }

    public function setEntityManager(EntityManager $em) {

        $this->em = $em;
    }

    public function indexAction() {
    	

    }




    // ACTIONS

    public function SaisieFacture() {


    }



}