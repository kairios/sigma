<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-30 09:31:09
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-13 17:50:04
 */

namespace Affaire\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
// EntityManager
use Doctrine\ORM\EntityManager;
// Session
use Zend\Session\Container;
// Entity
use Affaire\Entity\Affaire;
use Affaire\Form\AffaireForm;

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

    /**
     * Action qui permet d'avoir un listing des clients et des interlocuteurs
     */
    public function listeaffaireAction()
    {
        $affaire = new Affaire();

        //Si la requète n'est pas de type AJAX, on n'effectue pas de recherche
        if(!$this->getRequest()->isXmlHttpRequest())
        {
            //Assignation de variables au layout
            $this->layout()->setVariables(array(
                'headTitle'         =>  $this->getServiceLocator()->get('Translator')->translate('Affaires'),
                'breadcrumbActive'  =>  $this->getServiceLocator()->get('Translator')->translate('Affaires'),
                'route'             =>  array('Affaires'),
                'action'            =>  'listeaffaire',
                'module'            =>  'affaire',
                'plugins'           =>  array('dataTable','chosen'),
                //'userId'          =>  $userId,
                //'login'           =>  $login,                                 
            ));

            // $types          = $this->getEntityManager()->getRepository('Client\Entity\TypeSegment')->findBy(array(), array('intituleTypeSegment'=>'ASC'));
            // $segments       = $this->getEntityManager()->getRepository('Client\Entity\Segment')->findBy(array(), array('intituleSegment'=>'ASC'));
            // $produitsFinis  = $this->getEntityManager()->getRepository('Client\Entity\ProduitFini')->findBy(array(), array('intituleProduitFini'=>'ASC'));
            $etats = $affaire->getEtatsAffaire($this->getServiceLocator());
            $centres = $this->getEntityManager()->getRepository('Affaire\Entity\CentreDeProfit')->findBy(array(),array('numero'=>'ASC'));

            return new ViewModel(array(
                'affaires'           => $affaire->getListeAffaire($this->getServiceLocator()),
                // 'types_segment'     => $types,
                // 'segments'          => $segments,
                // 'produits_finis'    => $produitsFinis
                'etats' => $etats,
                'centres' => $centres
            ));
        }

        // S'il s'agit d'une recherche

        $resultat   = array();
        // $motCle     = isset($_GET['motCle']) ? $_GET['motCle'] : null;

        // // Avec type de segment

        // if (isset($_GET['produitsFinis']))
        // {
        //     $arrayProduits = $_GET['produitsFinis'];

        //     $resultat = $client->getClientsByProduitsFinisAndMotCle(
        //         $this->getServiceLocator(),
        //         $arrayProduits,
        //         $motCle
        //     );
        // }
        // else if(isset($_GET['segments']))
        // {
        //     $arraySegments = $_GET['segments'];

        //     $resultat = $client->getClientsBySegmentsAndMotCle(
        //         $this->getServiceLocator(),
        //         $arraySegments,
        //         $motCle
        //     );
        // }
        // else if(isset($_GET['typesSegment']))
        // {
        //     $arrayTypes = $_GET['typesSegment'];

        //     $resultat = $client->getClientsByTypesSegmentAndMotCle(
        //         $this->getServiceLocator(),
        //         $arrayTypes,
        //         $motCle
        //     );
        // }
        // else if(!is_null($motCle))
        // {
        //     $resultat = $client->getClients(
        //         $this->getServiceLocator(),
        //         '%'.addslashes($motCle).'%',
        //         intval($_GET['maxRows'])
        //     );
        // }
        // else
        // {
        //     $resultat = $client->getListeClient($this->getServiceLocator());
        // }

        return new JsonModel(array(
            'resultat'  => json_encode($resultat),
        ));
    }

    public function formulaireaffaireAction()
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

        /****************************** Initialisation du fournisseur ******************************/

        $affaire = null;
        $id = (int)$this->params()->fromRoute('id');

        if(!empty($id))
        {
            // Récupération de l'affaire
            $affaire = $em->getRepository('Affaire\Entity\Affaire')->find($id);
            if($affaire==null)
                throw new \Exception($translator->translate('Cette affaire n\'existe pas'));

            //Assignation de variables au layout
            $this->layout()->setVariables(array(
                'headTitle'         =>  $translator->translate('Modifier une affaire'),
                'breadcrumbActive'  =>  $affaire->getDesignationAffaire(),
                'action'            =>  'formulaireaffaire',                            
                'module'            =>  'affaire',
                'plugins'           =>  array(),
            ));
        }
        else
        {
            // On crée une nouvelle affaire
            $id = null;
            $affaire = new Affaire();
            //Assignation de variables au layout
            $this->layout()->setVariables(array(
                'headTitle'         =>  $translator->translate('Nouvelle affaire'),
                'breadcrumbActive'  =>  $translator->translate('Nouvelle affaire'),
                'action'            =>  'formulaireaffaire',                            
                'module'            =>  'affaire',
                'plugins'           =>  array('summernote'),
            ));
        }

        // Creation du formulaire du affaire
        $form = new AffaireForm($translator,$sm,$em,$request,$affaire);   
        if($request->isPost())
        {
            //$adresse=new \Application\Entity\Adresse;
            $form->setData($request->getPost());
            if($form->isValid())
            {
                /* Hydratation de l'objet affaire avec les données du formulaire */

                $affaire->exchangeArray($form->getData(),$em);

                try
                {
                    $em->persist($affaire); // Persiste les adresses et les interlocuteurs en cascade avec le affaire
                    $em->flush();
                }
                catch(\Exception $e)
                {
                    $erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde du affaire. Vérifiez que tous les champs sont valides (Informations générales, interlocuteurs, adresses..).')/*.$e->getMessage()*/;
                    $messagesFlash = $this->flashArray;
                    $messagesFlash['errors'][] = $erreurMessage;
                    $utilisateur->offsetSet('messagesFlash', $messagesFlash);

                    return new ViewModel(array(
                        'affaire'=>$affaire,
                        'form'=>$form,
                        'id'=>$id
                    ));
                }
                
                return $this->redirect()->toRoute('affaire/consulter_affaire',array('id'=>$affaire->getId()));
            }
        }

        return new ViewModel(array(
            'affaire'=>$affaire,
            'form'=>$form,
            'id'=>$id
        ));
    }
    
    public function consulteraffaireAction()
    {

    }
}

?>