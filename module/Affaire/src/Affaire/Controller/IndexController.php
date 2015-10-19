<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-30 09:31:09
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-21 18:32:20
 */

namespace Affaire\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

// EntityManager
use Doctrine\ORM\EntityManager;

// Session
use Zend\Session\Container;





// Entity
use Affaire\Entity\Affaire;
use Affaire\Entity\LigneAffaire;
use Affaire\Entity\LigneProduit;

// Form
use Affaire\Form\AffaireForm;
use Affaire\Form\LigneAffaireForm;
use Affaire\Form\LigneProduitForm;




class IndexController extends AbstractActionController {

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

        $view = new ViewModel(array(
            'message' => 'Hello world',
        ));

        $view->setTemplate('affaire/index');
        return $view;
    }

    /**
     * Action qui permet d'avoir un listing des clients et des interlocuteurs
     */
    public function listeaffaireAction()
    {
        // die(phpinfo());
        $affaire = new Affaire();
        $session = new Container('affaire');
        $session->offsetSet('id',null);

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
            ));

            $etats = $this->getEntityManager()->getRepository('Affaire\Entity\EtatAffaire')->findAll();
            $centres = $this->getEntityManager()->getRepository('Affaire\Entity\CentreDeProfit')->findBy(array(),array('numero'=>'ASC'));

            return new ViewModel(array(
                'affaires'  => $affaire->getListeAffaire($this->getServiceLocator()),
                'etats'     => $etats,
                'centres'   => $centres
            ));
        }

        // S'il s'agit d'une recherche

        $resultat       = array();
        $centres        = isset($_GET['centres']) ? $_GET['centres'] : null;
        $etatAffaire    = isset($_GET['etat']) ? $_GET['etat'] : null;
        $projetSigne    = isset($_GET['projetSigne']) ? (bool) $_GET['projetSigne'] : null;
        $motCle         = isset($_GET['motCle']) ? $_GET['motCle'] : null;

        $resultat       = $affaire->getListeAffaire($this->getServiceLocator(), $motCle, $centres, $etatAffaire, $projetSigne);

        return new JsonModel(array(
            'resultat'=>json_encode($resultat)
        ));
    }

    public function formulaireaffaireAction() {

        /******************************* Initialisation de variables *******************************/

        // Récupération de l'EntityManager
        $em             = $this->getEntityManager();
        // Récupération du Service Manager
        $sm             = $this->getServiceLocator();
        // Récupération de la requete
        $request        = $this->getRequest();
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
                'plugins'           =>  array('summernote','awesome-bootstrap-checkbox'/*,'iCheck'*/),
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
                'plugins'           =>  array('summernote','awesome-bootstrap-checkbox'/*,'iCheck'*/),
            ));
        }

        // Creation du formulaire du affaire
        $form = new AffaireForm($translator,$sm,$em,$request,$affaire);   
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                /* Hydratation de l'objet affaire avec les données du formulaire */

                $affaire->exchangeArray($form->getData(),$sm,$em);
                
                try
                {
                    $em->persist($affaire);
                    $em->flush();
                }
                catch(\Exception $e)
                {
                    $erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde du affaire. Vérifiez que tous les champs sont valides.').$e->getMessage();
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
    
















































    // -- CONTROLLER PRINCIPAL ONGLET 'AFFAIRE'
    // -----------------------------------------------------------------------------------------------
    public function consulteraffaireAction() {

        // Récupération de l'EntityManager
        $em             = $this->getEntityManager();
        // Récupération du Service Manager
        $sm             = $this->getServiceLocator();
        // Récupération de la requete
        $request        = $this->getRequest();
        // Récupération du traducteur
        $translator     = $this->getServiceLocator()->get('Translator');
        // Récupération de la session de l'utilisateur
        $utilisateur    = new Container('utilisateur');
        $session        = new Container('affaire');

        $id = (int)$this->params()->fromRoute('id');
        $affaire = $this->getEntityManager()->getRepository('Affaire\Entity\Affaire')->find($id);

        if($affaire==null) {

            throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Cette affaire n\'existe pas'));
        }

        $session->offsetSet('id', $id);

        //Assign variables to layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $this->getServiceLocator()->get('Translator')->translate('Fiche affaire'),
            'breadcrumbActive'  =>  'Détails affaire : '.$affaire->getNumeroAffaire(),
            'route'             =>  array(),
            'action'            =>  'consulteraffaire',
            'module'            =>  'affaire',
            'plugins'           =>  array('jquery-ui'),
        ));

        $adressePrincipale = $em->getRepository('Adresse\Entity\Adresse')->findOneBy(array('refClient'=>$affaire->getRefClient()->getId(),'adressePrincipale'=>true));




        $ligne = new LigneAffaire();

        // Initialisation du formulaire
        if(true) $form = new LigneAffaireForm($translator,$sm,$em,$request,$ligne);
        else if(false) $form = new LigneAffaireForm($translator, $sm, $em, $request, $ligne);


        

        // -- Creation du formulaire Ligne-Affaire*Ligne-Produit
        // ----------------------------------------------------------------------------------------
        if($request->isPost()) {

            $form->setData($request->getPost());

            if($form->isValid()) {



                // -- FORMULAIRE DEVIS
                // -------------------------------------------------------------------------------------------
                if(true) {

                    /* Hydratation de l'objet devis avec les données du formulaire */
                    $devis->exchangeArray($form->getData(), $sm, $em);

                    $totalDevis = 0;
                    
                    try {

                        // On supprime d'abord les lignes de devis existantes
                        $lignes = $devis->getLignesDevis($sm);

                        foreach($lignes as $ligne) {

                            $devis->removeLigneDevis($sm, $ligne['id']);
                        }

                        // On ajoute les lignes de devis en fonction des lignes de l'affaire sélectionnées
                        if(isset($_POST['ligne-affaire'])) {

                            foreach($_POST['ligne-affaire'] as $key => $idLigneAffaire) {

                                // On récupère puis enregistre la ligne de devis
                                $ligneDevis = new LigneDevis();
                                $ligneDevis->exchangeProperties($em->getRepository('Affaire\Entity\LigneAffaire')->find($idLigneAffaire));
                                $ligneDevis->setRefDevis($devis);
                                $em->persist($ligneDevis);

                                // On ajoute le montant de la ligne devis créée au montant total du devis
                                $totalDevis += $ligneDevis->getTotalPrixVente();
                            }
                        }

                        // On enregistre les totaux
                        $totalDevis -= $devis->getRemise();
                        $devis->setTotalHorsPort($totalDevis);

                        $totalDevis += $devis->getFraisPort();
                        $devis->setTotalAvecPort($totalDevis);

                        if($devis->getDateSignature()) {

                            $affaire->setRefDevisSigne($devis);
                            $em->persist($affaire);
                        }

                        $em->persist($devis);
                        $em->flush();
                    }
                    catch(\Exception $e) {

                        $erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde du devis. Vérifiez que tous les champs sont valides.').$e->getMessage();
                        $messagesFlash = $this->flashArray;
                        $messagesFlash['errors'][] = $erreurMessage;
                        $utilisateur->offsetSet('messagesFlash', $messagesFlash);

                        return new ViewModel(array(
                            'devis'=>$devis,
                            'form'=>$form,
                            'id'=>$id
                        ));
                    }
                    
                    return $this->redirect()->toRoute('devis/consulter_devis', array('id'=>$devis->getId()));
                }
                // -- FORMULAIRE LIGNE PRODUIT
                // -------------------------------------------------------------------------------------------
                else if(true) {

                    $em->persist($ligneAffaire);
                    $em->flush();
                }
            }
        }
        /* ----------------------------------------------------------------------------------------
        /* -- FIN FORMULAIRE -- */





        return new ViewModel(array(

            'id'=>$id,
            'form'=>$form,
            'affaire'=>$affaire,
            'adresse'=>$adressePrincipale,
            'listeDevis'=>$affaire->getListeDevis($sm)
        ));
    }


















































    public function listeproduitAction() {

        // Si la requète n'est pas de type AJAX, on n'effectue pas de recherche
        if($this->getRequest()->isXmlHttpRequest()) {

            $statusForm=null;
            // Récupération de l'EntityManager
            $em=$this->getEntityManager();
            // Récupération du Service Manager
            $sm=$this->getServiceLocator();
             // Récupération du traducteur
            $translator=$sm->get('Translator');
            // Récupération de la requete
            $request=$this->getRequest();

            $idAffaire = (int) $this->params()->fromRoute('id');

            $affaire = null;
            $affaire = $em->getRepository('Affaire\Entity\Affaire')->find($idAffaire);
            if($affaire==null)
                throw new \Exception($translator->translate('Cette affaire n\'existe pas'));

            $form = new LigneAffaireForm($translator, $sm, $em, $request, new LigneAffaire());

            $viewModel = new ViewModel();
            $viewModel->setVariables(array(
                'id'=>$idAffaire,
                'affaire'=>$affaire,
                'lignesAffaire'=>$em->getRepository('Affaire\Entity\LigneAffaire')->findBy(array('refAffaire'=>$affaire)),
                'form'=>$form,
            ))->setTerminal(true);

            return $viewModel;
        }

        // Sinon on redirige vers l'écran d'accueil
        return $this->redirect()->toRoute('home');
    }

    public function formulaireligneaffaireAction() {

        // SI REQUÊTE AJAX
        if($this->getRequest()->isXmlHttpRequest()) {

            // Initialisation de variables
            $statusForm = null;
            // Récupération de l'EntityManager
            $em = $this->getEntityManager();
            // Récupération du Service Manager
            $sm = $this->getServiceLocator();
             // Récupération du traducteur
            $translator = $sm->get('Translator');
            // Récupération de la requete
            $request = $this->getRequest();

            // Initialisation de la ligne affaire
            $ligneAffaire = null;
            $id = $this->params()->fromRoute('ligne');
            

            // Si l'ID de la ligne est transmis, on réccupère celle-ci
            if(!empty($id)) {

                // Récupération de la ligne en BD
                $ligneAffaire = $em->getRepository('Affaire\Entity\LigneAffaire')->find($id);
                if($ligneAffaire == null)
                    throw new \Exception($translator->translate('Une erreur est survenue lors de la récupération de la ligne de l\'affaire.'));
            }
            // Sinon on crée un nouvel interlocuteur
            else {

                $id = null;
                $ligneAffaire = new LigneAffaire();
            }



            // -- Creation du formulaire de la ligne affaire
            // -------------------------------------------------------------------------------------------
            $form = new LigneAffaireForm($translator,$sm,$em,$request,$ligneAffaire);

            if($request->isPost()) {

                $form->setData($request->getPost());

                if($form->isValid()) {

                    $statusForm=true;

                    // On récuppère l'affaire
                    $idAffaire = (int) $this->params()->fromRoute('id');
                    $affaire = $em->getRepository('Affaire\Entity\Affaire')->find($idAffaire);

                    // On hydrate la ligne affaire avec les infos du formulaire
                    // et on met la référence de l'affaire dans la ligne affaire
                    $ligneAffaire->exchangeArray($form->getData(),$sm,$em);
                    $ligneAffaire->setRefAffaire($affaire);

                    $em->persist($ligneAffaire);
                    $em->flush($ligneAffaire);

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        // 'motCle'=>$ligneAffaire->getNom(),
                    ));
                }
                // Sinon, on retourne les erreurs au formulaire qui les affiche
                else {

                    $statusForm = false;
                    $errors = $form->getMessages();

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'reponse'=>$errors,
                    ));
                }
            }

            // -- Affichage du formulaire sans le layout (retour d'une sous-vue uniquement)
            // -------------------------------------------------------------------------------------------
            $viewModel=new ViewModel;
            $viewModel->setVariables(array(
                'ligneAffaire'=>$ligneAffaire,
                'form'=>$form,
                'id'=>$id
            ))->setTerminal(true);

            return $viewModel;
        }

        return $this->redirect()->toRoute('home');
    }







    // -- GESTION DE L'AFFICHAGE DU FORMULAIRE
    // -------------------------------------------------------------------------------------------
    public function formulaireligneproduitAction() {

        // SI REQUÊTE AJAX
        if($this->getRequest()->isXmlHttpRequest()) {

            // Initialisation de variables
            $statusForm = null;
            // Récupération de l'EntityManager
            $em = $this->getEntityManager();
            // Récupération du Service Manager
            $sm = $this->getServiceLocator();
            // Récupération du traducteur
            $translator = $sm->get('Translator');
            // Récupération de la requete
            $request = $this->getRequest();

            // Initialisation de la ligne affaire
            $ligneProduit = null;
            $id = $this->params()->fromRoute('ligne');
            

            // Si l'ID de la ligne est transmis, on réccupère celle-ci
            if(!empty($id)) {

                // Récupération de la ligne en BD
                $ligneProduit = $em->getRepository('Affaire\Entity\LigneProduit')->find($id);

                if($ligneProduit == null) {

                    throw new \Exception($translator->translate('Une erreur est survenue lors de la récupération de la ligne de l\'affaire.'));
                }
            }
            // Sinon on crée un nouvel interlocuteur
            else {

                $id = null;
                $ligneAffaire = new LigneAffaire();
            }

           
            $form = new LigneProduitForm($translator, $sm, $em, $request, $ligneProduit);


            if($request->isPost()) {

                $form->setData($request->getPost());

                if($form->isValid()) {

                    $statusForm = true;

                    // On récuppère l'affaire
                    $idAffaire = (int) $this->params()->fromRoute('id');
                    $affaire = $em->getRepository('Affaire\Entity\Affaire')->find($idAffaire);
                    // 

                    // On hydrate la ligne affaire avec les infos du formulaire
                    // et on met la référence de l'affaire dans la ligne affaire
                    $ligneAffaire->exchangeArray($form->getData(), $sm, $em);
                    $ligneAffaire->setRefAffaire($affaire);

                    $em->persist($ligneAffaire);
                    $em->flush($ligneAffaire);

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        // 'motCle'=>$ligneAffaire->getNom(),
                    ));
                }
                // Sinon, on retourne les erreurs au formulaire qui les affiche
                else {

                    $statusForm = false;
                    $errors = $form->getMessages();

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'reponse'=>$errors,
                    ));
                }
            }





            $viewModel = new ViewModel();
            $viewModel->setTemplate('affaire/formulaireligneproduit')
                      ->setVariables(array(
                            'form' => $form
                        ))
                      ->setTerminal(true);

            return $viewModel;
        }
    }






















    public function formulaireligneprestationAction() {


    }

    public function autocompletionaffaireAction() {

        //Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
            $affaire = new Affaire();
            $list = $affaire->getAffairesFicheHeure($this->getServiceLocator(),$_GET["motCle"]);

            return new JsonModel(array(
                'resultat'=>json_encode($list)
            ));
        }

        //Si l'utilisateur tente d'accéder à l'url de l'action, on lui envoie une erreur 404
        //$this->getResponse()->setStatusCode(404);
        //return;
        return $this->redirect()->toRoute('home'); // Ou on redirige l'utilisateur vers une autre page
    }
}

?>