<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-22 16:18:51
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-19 15:02:33
 */

// module\Produit\src\Produit\Controller\IndexController.php

namespace Produit\Controller;


// Controller
use Zend\Mvc\Controller\AbstractActionController;
// View
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// Session
use Zend\Session\Container;
// Response
use Zend\Http\Response;
// EntityManager
use Doctrine\ORM\EntityManager;
// Entity
use Produit\Entity\Produit;

class IndexController extends AbstractActionController
{
	/**
	 * Entity Manager
	 * @var DoctrineORMEntityManager
	 */
	protected $em;

	protected $flashArray = array('errors'=>array(),'success'=>array()); // Permet de créer des messages flash : cf. <!-- Notifications --> dans layout.phtml

	public function getEntityManager()
	{
		if(null===$this->em)
		{
			$this->em=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}
		return $this->em;
	}

    private function setEntityManager(EntityManager $em)
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

	public function listeproduitAction()
	{
		$translator = $this->getServiceLocator()->get('Translator');
		//Assignation de variables au layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $translator->translate('Biblithèque produits'),
			'breadcrumbActive'	=>	$translator->translate('Biblithèque produits'),
			'route'				=>	array(),
			'action'			=>	'listeproduit',							
			'module'			=>	'produit',
			'plugins'			=>	array(),
		));

		return new ViewModel(array(
			'produits' => array()
		));
	}

	public function autocompletionproduitAction()
	{
		//Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
        	$list = array();
            $produit = new Produit();
            $utilisateur = new Container('utilisateur');

            $codeProduit = isset($_GET['codeProduit']) ? $_GET['codeProduit'] : null;
            $intituleProduit = isset($_GET['intituleProduit']) ? $_GET['intituleProduit'] : null;

            $list = $produit->getIntitulesProduits($this->getServiceLocator(),$utilisateur->offsetGet('lang','fr_FR'), $codeProduit, $intituleProduit, 10);            

            return new JsonModel(array(
                'resultat'=>json_encode($list)
            ));
        }

        return $this->redirect()->toRoute('home'); // Ou on redirige l'utilisateur vers une autre page
	}
}

?>