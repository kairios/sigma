<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-30 09:31:09
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-02 15:06:12
 */

namespace Affaire\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
// EntityManager
use Doctrine\ORM\EntityManager;
// Session
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    /**
     * Entity Manager
     * @var DoctrineORMEntityManager
     */
    protected $em;

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
            header('location:/authentification');
        }
        else
        {
            return false;
        }
    }

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

    public function indexAction()
    {
    	//Assignation de variables au layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Affaires'),
			'breadcrumbActive'	=>	$this->getServiceLocator()->get('Translator')->translate('Affaires'),
			'route'				=>	array('Affaires'),
			'action'			=>	'index',
			'module'			=>	'affaire',
			'plugins'			=>	array('slimscroll','jquery-ui','footable'),
			//'userId'			=>	$userId,
			//'login'			=>	$login,									
		));
    }        
}

?>