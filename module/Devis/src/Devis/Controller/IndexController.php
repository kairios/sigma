<?php
/**
 * @Author: Ophelie
 * @Date:   2015-08-11 18:01:01
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-20 17:41:52
 */

namespace Devis\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// EntityManager
use Doctrine\ORM\EntityManager;
// Session
use Zend\Session\Container;
// Entity
use Devis\Entity\Devis;
use Devis\Form\DevisForm;

class IndexController extends AbstractActionController
{
    /**
     * Entity Manager
     * @var DoctrineORMEntityManager
     */
    protected $em;

    protected $flashArray = array('errors'=>array(),'success'=>array());

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
    	
    }

    /**
     * Action qui permet d'avoir un listing des clients et des interlocuteurs
     */
    public function listedevisAction()
    {
        //Assignation de variables au layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $this->getServiceLocator()->get('Translator')->translate('Devis'),
            'breadcrumbActive'  =>  $this->getServiceLocator()->get('Translator')->translate('Devis'),
            'route'             =>  array('Devis'),
            'action'            =>  'listedevis',
            'module'            =>  'devis',
            'plugins'           =>  array('dataTable','chosen'),
        ));

        // $etats = $this->getEntityManager()->getRepository('Affaire\Entity\EtatAffaire')->findAll();
        // $centres = $this->getEntityManager()->getRepository('Affaire\Entity\CentreDeProfit')->findBy(array(),array('numero'=>'ASC'));

        return new ViewModel(array(
            // 'affaires'  => $affaire->getListeAffaire($this->getServiceLocator()),
            // 'etats'     => $etats,
            // 'centres'   => $centres
        ));
    }

    public function formulairedevisAction()
    {
        /******************************* Initialisation de variables *******************************/

        // Récupération de l'EntityManager
        $em             =$this->getEntityManager();
        // Récupération du Service Manager
        $sm             = $this->getServiceLocator();
        // Récupération de la requete
        $request        =$this->getRequest();
        // Récupération du traducteur
        $translator     = $this->getServiceLocator()->get('Translator');
        // Récupération de la session de l'utilisateur
        $utilisateur    = new Container('utilisateur');
        $session        = new Container('affaire');

        /****************************** Initialisation du fournisseur ******************************/

        $affaire = $devis = null;
        $id = (int)$this->params()->fromRoute('id');

        if(!empty($id))
        {
            // Récupération de l'devis
            $devis = $em->getRepository('Devis\Entity\Devis')->find($id);
            if($devis==null)
                throw new \Exception($translator->translate('Ce devis n\'existe pas'));            
        }
        else
        {
        	if(!is_null($session->offsetGet('id',null)))
        	{
        		$affaire = $em->getRepository('Affaire\Entity\Affaire')->find((int) $session->offsetGet('id'));
        	}

            // On crée une nouvelle devis
            $id = null;
            $devis = new Devis($affaire);

            //Assignation de variables au layout
            $this->layout()->setVariables(array(
                'headTitle'         =>  $translator->translate('Nouveau devis'),
                'breadcrumbActive'  =>  $translator->translate('Nouveau devis'),
                'action'            =>  'formulairedevis',                            
                'module'            =>  'devis',
                'plugins'           =>  array(),
            ));
        }

        //Assignation de variables au layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $translator->translate('Modifier une devis'),
            'breadcrumbActive'  =>  $devis->getCodeDevis(),
            'action'            =>  'formulairedevis',
            'module'            =>  'devis',
            'plugins'           =>  array(),
        ));

        // Creation du formulaire du devis
        $form = new DevisForm($translator,$sm,$em,$request,$devis);   
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                /* Hydratation de l'objet devis avec les données du formulaire */

                $devis->exchangeArray($form->getData(),$sm,$em);
                
                // try
                // {
                //     $em->persist($devis);
                //     $em->flush();
                // }
                // catch(\Exception $e)
                // {
                //     $erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde du devis. Vérifiez que tous les champs sont valides.').$e->getMessage();
                //     $messagesFlash = $this->flashArray;
                //     $messagesFlash['errors'][] = $erreurMessage;
                //     $utilisateur->offsetSet('messagesFlash', $messagesFlash);

                //     return new ViewModel(array(
                //         'devis'=>$devis,
                //         'form'=>$form,
                //         'id'=>$id
                //     ));
                // }
                
                return $this->redirect()->toRoute('devis/consulter_devis',array('id'=>$devis->getId()));
            }
        }

        return new ViewModel(array(
        	'lignesAffaire'=>$em->getRepository('Affaire\Entity\LigneAffaire')->findBy(array('refAffaire'=>$affaire)),
            'devis'=>$devis,
            'form'=>$form,
            'id'=>$id
        ));
    }
    
    public function consulterdevisAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        $devis = $this->getEntityManager()->getRepository('Devis\Entity\Devis')->find($id);

        if($devis==null)
        {
            throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Ce devis n\'existe pas'));
        }

        //Assign variables to layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $this->getServiceLocator()->get('Translator')->translate('Fiche devis'),
            'breadcrumbActive'  =>  'Devis n°'.$devis->getCodeDevis(),
            'route'             =>  array(),
            'action'            =>  'consulterdevis',
            'module'            =>  'devis',
            'plugins'           =>  array(),
        ));
        
        return new ViewModel(array(
            'id'=>$id,
            'devis'=>$devis
        ));
    }
}

?>