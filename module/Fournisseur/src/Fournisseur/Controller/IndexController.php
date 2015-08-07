<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-05 10:45:58
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-24 19:28:02
 */

// module\Fournisseur\src\Fournisseur\Controller\IndexContoller.phtml

namespace Fournisseur\Controller;

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
use Adresse\Entity\Adresse;
use Fournisseur\Entity\Fournisseur;
use Fournisseur\Entity\InterlocuteurFournisseur;

use Fournisseur\Form\FournisseurForm;
use Fournisseur\Form\InterlocuteurFournisseurForm;

class IndexController extends AbstractActionController
{
	/**
	 * Entity Manager
	 * @var DoctrineORMEntityManager
	 */
	protected $em;

	protected $flashArray = array('errors'=>array(),'success'=>array());

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

	/**
	 * Action qui permet d'avoir un listing des fournisseur et des interlocuteurs
	 */
	public function listefournisseurAction()
	{
		$fournisseur=new Fournisseur;

		//Si la requète n'est pas de type AJAX, on n'effectue pas de recherche
        if(!$this->getRequest()->isXmlHttpRequest())
        {
			//Assignation de variables au layout
			$this->layout()->setVariables(array(
				'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Liste des fournisseurs'),
				'breadcrumbActive'	=>	$this->getServiceLocator()->get('Translator')->translate('Liste des fournisseurs'),
				'route'				=>	array('Fournisseurs'),
				'action'			=>	'listefournisseur',
				'module'			=>	'fournisseur',
				'plugins'			=>	array('dataTable','chosen'),
				//'userId'			=>	$userId,
				//'login'			=>	$login,									
			));

			$activites 		= $this->getEntityManager()->getRepository('Fournisseur\Entity\ActiviteFournisseur')->findBy(array(), array('intituleActivite'=>'asc'));
			$categories 	= $this->getEntityManager()->getRepository('Fournisseur\Entity\CategorieFournisseur')->findAll();

			return new ViewModel(array(
				'fournisseurs'	=>$fournisseur->getListeFournisseur($this->getServiceLocator()),
				'activites' 	=> $activites,
				'categories' 	=> $categories
			));
		}

		// S'il s'agit d'une recherche

		$resultat 	= array();
		$activites 	= isset($_GET['activites']) ? $_GET['activites'] : null;
		$categories = isset($_GET['categories']) ? $_GET['categories'] : null;
		$motCle 	= isset($_GET['motCle']) ? $_GET['motCle'] : null;

		// Avec type de segment

		if ($categories || $activites || $motCle)
        {
    		$resultat = $fournisseur->getFournisseurssByActivitiesAndCategories(
    			$this->getServiceLocator(),
				$activites,
				$categories,
				$motCle
    		);
        }
        else
        {
        	$resultat = $fournisseur->getListeFournisseur($this->getServiceLocator());
        }

		return new JsonModel(array(
            'resultat'=>json_encode($resultat)
        ));
	}

	/**
	 * Action qui est censée retourner du texte mais qui ne marche pas
	 */
	public function listeinterlocuteurAction()
	{
		//Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
        	$interlocuteur=new InterlocuteurFournisseur;
        	$resultat=array();
        	if(isset($_GET['motCle'])&&(isset($_GET['maxRows'])))
        	{
        		$resultat=$interlocuteur->getInterlocuteurs(
					$this->getServiceLocator(),
					'%'.addslashes($_GET['motCle']).'%',
					intval($_GET['maxRows'])
				);
        	}
        	else
        	{
	        	$resultat=$interlocuteur->getListeInterlocuteur(
					$this->getServiceLocator()
				);
        	}
			return new JsonModel(array(
				'resultat'=>json_encode($resultat)
			));
		}
		/*
		$response = new \Zend\Http\Response;
		$response->setContent('Accès interdit');
		$response->setStatusCode(\Zend\Http\Response::STATUS_CODE_403);
		return $response;
		*/
		return $this->redirect()->toRoute('home');
	}

	/**
	 * Permet la creation ou la modificaton d'un fournisseur
	 */
	public function formulairefournisseurAction()
	{
		/* Initialisation de variables */

		// Récupération du traducteur
		$translator=$this->getServiceLocator()->get('Translator');
		// Récupération de l'EntityManager
		$em=$this->getEntityManager();
		// Récupération de la requete
		$request=$this->getRequest();
		// Récupération de la session du fournisseur
		$session=new Container('societeSession');
		$utilisateur=new Container('utilisateur');

		/* Initialisation du fournisseur */

		$fournisseur=null;
		$id=(int)$this->params()->fromRoute('id');

		if(!empty($id))
		{
			// Récupération du fournisseur
			$fournisseur=$em->getRepository('Fournisseur\Entity\Fournisseur')->find($id);
			if($fournisseur==null)
				throw new \Exception($translator->translate('Ce fournisseur n\'existe pas'));

			//Assignation de variables au layout
			$this->layout()->setVariables(array(
				'headTitle'			=>  $translator->translate('Modifier un fournisseur'),
				'breadcrumbActive'	=>	$fournisseur->getRaisonSociale(),
				'route'				=>	array('Fournisseurs','Modification'),
				'action'			=>	'formulairefournisseur',							
				'module'			=>	'fournisseur',
				'plugins'			=>	array('jquery-ui','mask'),
			));
		}
		else
		{
			// On crée un nouveau fournisseur
			$id=null;
			$fournisseur=new Fournisseur;
			//Assignation de variables au layout
			$this->layout()->setVariables(array(
				'headTitle'			=>  $translator->translate('Nouveau fournisseur'),
				'breadcrumbActive'	=>	$translator->translate('Nouveau fournisseur'),
				'route'				=>	array('Fournisseurs'),
				'action'			=>	'formulairefournisseur',							
				'module'			=>	'fournisseur',
				'plugins'			=>	array('jquery-ui','mask'),
			));
		}

		// Mise en session des adresses du fournisseur
		$array1=array();
		if(!$request->isPost())
		{
			$adresses=$fournisseur->getAdresses();
			foreach($adresses as $a)
			{
				$uniqid=uniqid('',true);
				$array1[$uniqid]=$a->getArrayCopy();
			}
		}
		else
		{
			$array1=$session->offsetGet('adresses',array());
		}
		$session->offsetSet('adresses',$array1);

		// Mise en session des interlocuteurs du fournisseur
		$array2=array();
		if(!$request->isPost())
		{
			$interlocuteurs=$fournisseur->getInterlocuteurs();
			foreach($interlocuteurs as $i)
			{
				$uniqid=uniqid('',true);
				$array2[$uniqid]=$i->getArrayCopy();
			}
		}
		else
		{
			$array2=$session->offsetGet('interlocuteurs',array());
		}
		$session->offsetSet('interlocuteurs',$array2);

		// Creation du formulaire du fournisseur
		$form=new FournisseurForm($translator,$em,$request,$fournisseur);	
		if($request->isPost())
		{
			//$adresse=new \Application\Entity\Adresse;
			$form->setData($request->getPost());
			if($form->isValid())
			{
				/* Hydratation de l'objet fournisseur avec les données du formulaire */

				$fournisseur->exchangeArray($form->getData(),$em);

				/* Remplacement des adresses du fournisseur par celles en Session */

				$adresses=$session->offsetGet('adresses',array());
				
				foreach($fournisseur->getAdresses() as $a1)
				{
					$fournisseur->removeAdresse($a1);
				}
				foreach($adresses as $a2)
				{
					$nouvelleAdresse=new Adresse;
					$nouvelleAdresse->exchangeArray($a2,$em);
					$fournisseur->addAdresse($nouvelleAdresse);
				}

				/* Remplacement des interlocuteurs du fournisseur par ceux en Session */

				$interlocuteurs=$session->offsetGet('interlocuteurs',array());
				
				foreach($fournisseur->getInterlocuteurs() as $i1)
				{
					$fournisseur->removeInterlocuteur($i1);
				}
				foreach($interlocuteurs as $i2)
				{
					$nouvelInterlocuteur=new InterlocuteurFournisseur;
					$nouvelInterlocuteur->exchangeArray($i2,$em);
					$fournisseur->addInterlocuteur($nouvelInterlocuteur);
				}

				try
				{
					$em->persist($fournisseur); // Persiste les adresses et les interlocuteurs en cascade avec le fournisseur
					$em->flush();
				}
				catch(\Exception $e)
				{
					$erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde du fournisseur. Vérifiez que tous les champs sont valides (Informations générales, interlocuteurs, adresses..).')/*.$e->getMessage()*/;
					$messagesFlash = $this->flashArray;
					$messagesFlash['errors'][] = $erreurMessage;
					$utilisateur->offsetSet('messagesFlash', $messagesFlash);

					return new ViewModel(array(
						'fournisseur'=>$fournisseur,
						'form'=>$form,
						'id'=>$id
					));
				}
				
				return $this->redirect()->toRoute('fournisseur/consulter_fournisseur',array('id'=>$fournisseur->getId()));
			}
		}

		return new ViewModel(array(
			'fournisseur'=>$fournisseur,
			'form'=>$form,
			'id'=>$id
		));
	}

	/**
	 * Permet d'afficher les informations d'un fournisseur
	 */
	public function consulterfournisseurAction()
	{
		$id=(int)$this->params()->fromRoute('id');
		$fournisseur=$this->getEntityManager()->getRepository('Fournisseur\Entity\Fournisseur')->find($id);

		if($fournisseur==null)
		{
			throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Ce fournisseur n\'existe pas'));
		}

		//Assign variables to layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Fiche fournisseur'),
			'breadcrumbActive'	=>	'Détails fournisseur : '.$fournisseur->getRaisonSociale(),
			'route'				=>	array('Fournisseurs'),
			'action'			=>	'consulterfournisseur',
			'module'			=>	'fournisseur',
			'plugins'			=>	array('jquery-ui'),
			//'userId'			=>	$userId,
			//'login'			=>	$login,									
		));
		
		return new ViewModel(array(
			'id'=>$id,
			'fournisseur'=>$fournisseur
		));
	}

	/**
	 * Permet de supprimer un clietn existant
	 */
	public function supprimerfournisseurAction()
	{
		$request = $this->getRequest();
		
		if($request->isXmlHttpRequest())
        {
    		$id =(int)$this->params()->fromRoute('id');
    		$em = $this->getEntityManager();
			$fournisseur=$em->getRepository('Fournisseur\Entity\Fournisseur')->find($id);

			if($fournisseur==null)
			{
				throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Ce fournisseur n\'existe pas'));
			}

			if($request->isPost())
			{
				// On supprime le fournisseur ainsi que ses adresses et interlocuteurs
				$em->remove($fournisseur);
				$em->flush();

				return new JsonModel(array(
					'statut' => true
				));
			}

			return new JsonModel(array(
				'statut' 		=> false,
				'fournisseur'		=> $fournisseur->getRaisonSociale().' ('.$fournisseur->getCodeFournisseur().')'
			));
        }
        return $this->redirect()->toRoute('fournisseur');
	}

	/**
	 * Permet la creation ou la modification d'un interlocuteur fournisseur
	 */
	public function formulaireinterlocuteurAction()
	{
		if($this->getRequest()->isXmlHttpRequest())
        {
        	/* Initialisation de variables */

            $statusForm=null;
            // Récupération de l'EntityManager
            $em=$this->getEntityManager();
            // Récupération du Service Manager
            $sm=$this->getServiceLocator();
             // Récupération du traducteur
            $translator=$sm->get('Translator');
            // Récupération de la requete
            $request=$this->getRequest();

            /* Initialisation de l'interlocuteur */
            $interlocuteur=null;
            $id=$this->params()->fromRoute('id');
            if(!empty($id)) // Si l'ID de l'interlocuteur est transmis, on réccupère celui-ci
            {
                // Récupération de l'interlocuteur en BD
                $interlocuteur=$em->getRepository('Fournisseur\Entity\InterlocuteurFournisseur')->find($id);
                if($interlocuteur==null)
                    throw new \Exception($translator->translate('Cet interlocuteur n\'existe pas'));
            }
            else // Sinon on crée un nouvel interlocuteur
            {
                $id=null;
                $interlocuteur=new InterlocuteurFournisseur;
            }

            /* Creation du formulaire d'interlocuteur */
            
            $form=new InterlocuteurFournisseurForm($translator,$sm,$em,$request,$interlocuteur);
            if($request->isPost())
            {
                $form->setData($request->getPost());

                if($form->isValid())
                {
                    $statusForm=true;
                    $interlocuteur->exchangeArray($form->getData(),$em);
                    $em->persist($interlocuteur);
                    $em->flush($interlocuteur);

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'motCle'=>$interlocuteur->getNom(),
                    ));
                }
                else // Sinon, on retourne les erreurs au formulaire qui les affiche
                {
                    $statusForm=false;
                    $errors=$form->getMessages();

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'reponse'=>$errors,
                    ));
                }
            }

            /* Affichage du formulaire sans le layout (en modal) */

            $viewModel=new ViewModel;
            $viewModel->setVariables(array(
                'interlocuteur'=>$interlocuteur,
                'form'=>$form,
                'id'=>$id
            ))->setTerminal(true);

            return $viewModel;
		}
		return $this->redirect()->toRoute('home');
	}

	/**
	 * Permet la creation ou la modification d'un interlocuteur fournisseur en session
	 */
	public function formulaireinterlocuteursessionAction()
	{
		if($this->getRequest()->isXmlHttpRequest())
        {
        	/* Initialisation de variables */

            $statusForm=null;
            // Récupération de l'EntityManager
            $em=$this->getEntityManager();
            // Récupération du Service Manager
            $sm=$this->getServiceLocator();
             // Récupération du traducteur
            $translator=$sm->get('Translator');
            // Récupération de la requete
            $request=$this->getRequest();
            // Récupération de la session
            $session=new Container('societeSession');
            $interlocuteurs=$session->offsetGet('interlocuteurs',array());

            /* Initialisation de l'interlocuteur */
            $interlocuteur=new InterlocuteurFournisseur;
            $uniqid=$this->params()->fromRoute('id');
            if(!empty($uniqid)) // Si l'ID de l'interlocuteur est transmis, on réccupère celui-ci
            {
                // Récupération de l'interlocuteur depuis la session
                $i=$interlocuteurs[$uniqid];
                if($i==null)
                    throw new \Exception($translator->translate('Cet interlocuteur n\'existe pas'));
                $interlocuteur->exchangeArray($i,$em);
            }
            else // Sinon on crée une nouvelle interlocuteur
            {
                $uniqid=null;
            }

            /* Creation du formulaire d'adresse */
            $form=new InterlocuteurFournisseurForm($translator,$sm,$em,$request,$interlocuteur);    
            if($request->isPost())
            {
                $form->setData($request->getPost());

                
                if(!$form->isValid()) // Test obligatoire pour obtenir les erreurs du formulaire
                {
                	$errors=$form->getMessages();
                	unset($errors['ref_societe_fournisseur']);
                	
                	if(sizeof($errors)>0)
                	{
                		$statusForm=false;

	                    return new JsonModel(array(
	                        'statut'=>$statusForm,
	                        'reponse'=>$errors,
	                    ));
                	}
                	// Si la seule erreur du formulaire est celle provoquée par le validateur de ref_societe_fournisseur
                	// on l'enlève et on fait comme si tout s'était bien passé 
                	else 
                	{
                		$statusForm=true;
	                    $interlocuteur->exchangeArray($form->getData(),$em);

	                    if(is_null($uniqid))
	                        $uniqid=uniqid('',true);
	                    $interlocuteurs[$uniqid]=$interlocuteur->getArrayCopy();
	                    $session->offsetSet('interlocuteurs',$interlocuteurs);

	                    $spanInterlocuteur=$this->creationSpanInterlocuteur($interlocuteur,$uniqid);

	                    return new JsonModel(array(
	                        'statut'=>$statusForm,
	                        'uniqid'=>$uniqid,
	                        'reponse'=>$spanInterlocuteur
	                    ));
                	}
                }
                else // De même ici tout s'est bien passé (a priori on ne rentre jamais dans cette boucle)
                {
                	$statusForm=true;
                    $interlocuteur->exchangeArray($form->getData(),$em);

                    if(is_null($uniqid))
                        $uniqid=uniqid('',true);
                    $interlocuteurs[$uniqid]=$interlocuteur->getArrayCopy();
                    $session->offsetSet('interlocuteurs',$interlocuteurs);

                    $spanInterlocuteur=$this->creationSpanInterlocuteur($interlocuteur,$uniqid);

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'uniqid'=>$uniqid,
                        'reponse'=>$spanInterlocuteur
                    ));
                }
            }

            /* Affichage du formulaire sans le layout (en modal) */

            $viewModel=new ViewModel;
            $viewModel->setVariables(array(
                'interlocuteur'=>$interlocuteur,
                'form'=>$form,
                'id'=>$uniqid
            ))->setTerminal(true);

            return $viewModel;
        }
		return $this->redirect()->toRoute('home');
	}

	/**
     * Permet de créer un span réutilisable dans le formulaire du fournisseur
     * @param  InterlocuteurFournisseur $interlocuteur [description]
     * @param  [type]              $uniqId        [description]
     * @return string                             Un span avec les informations de l'interlocuteur
     */
    public function creationSpanInterlocuteur(InterlocuteurFournisseur $interlocuteur,$uniqId)
    {
        // Récupération du traducteur
        $translator=$this->getServiceLocator()->get('Translator');

        $spanInterlocuteur='<span class="entite interlocuteur">';

        if($interlocuteur->getEnvoiVersOutlook()==true)
        {
            $spanInterlocuteur.='<small class="label label-warning">'.$translator->translate('Outlook').'</small> ';
        }
        $spanInterlocuteur.=  $interlocuteur->getTitreCivilite().' '.$interlocuteur->getPrenom().' '.$interlocuteur->getNom();

        if(!empty($interlocuteur->getRefFonction()))
        {
        	$spanInterlocuteur.= ' - '.$interlocuteur->getRefFonction()->getIntituleFonction();
        }

        $spanInterlocuteur.= 	'<input type="hidden" value="'.$uniqId.'"/>
        						<i class="fa fa-times pull-right" title="'.$translator->translate('Supprimer').'"></i>
        					</span>';

        return $spanInterlocuteur;
    }

	/**
	 * Permet de supprimer un interlocuteur en session
	 */
	public function supprimerinterlocuteursessionAction()
    {
        if($this->getRequest()->isXmlHttpRequest())
        {
            $statut=null;
            $uniqid=$this->params()->fromRoute('id');
            if(!empty($uniqid))
            {
                // Suppression de l'interlocuteur en session
                $session=new Container('societeSession');
                $interlocuteurs=$session->offsetGet('interlocuteurs',array());
                unset($interlocuteurs[$uniqid]);
                $session->offsetSet('interlocuteurs',$interlocuteurs);
                $statut=true;
            }
            else
            {
                $statut=false;
            }

            return new JsonModel(array(
                'statut'=>$statut,
                'uniqid'=>$uniqid // Transmis afin de supprimer la span
            ));
        }
        return $this->redirect()->toRoute('fournisseur');
    }

    /**
     * Permet de consulter un interlocuteur via Modal
     */
    public function consulterinterlocuteurAction()
    {
    	//Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
        	$id=(int)$this->params()->fromRoute('id');
			$interlocuteur=$this->getEntityManager()->getRepository('Fournisseur\Entity\InterlocuteurFournisseur')->find($id);

			if($interlocuteur==null)
			{
				throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Cet interlocuteur n\'existe pas'));
				//http://stackoverflow.com/questions/20528862/zend-framework-2-set-reason-phrase-for-error-404 // to set an error code
			}
			
			/* Affichage du formulaire sans le layout (en modal) */

            $viewModel=new ViewModel;
            $viewModel->setVariables(array(
                'interlocuteur'=>$interlocuteur,
                'id'=>$id
            ))->setTerminal(true);

            return $viewModel;
		}
		return $this->redirect()->toRoute('fournisseur');
    }

	/**
	 * Permet de trouver la liste des sociétés ayant pour code fournisseur celui spécifié en paramètre
	 */
	public function autocompletionfournisseurAction()
	{
		//Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
            $fournisseur=new Fournisseur;
            $fournisseurs=array();

            if(isset($_GET["codeFournisseur"]))
            {
                $value=$_GET["codeFournisseur"];
                if(!empty($value))
                	$fournisseurs=$fournisseur->getFournisseursFromForms($this->getServiceLocator(),$value);
                else
                	$fournisseurs=$fournisseur->getFournisseursFromForms($this->getServiceLocator(),null);
            }
            else
            {
                $fournisseurs=$fournisseur->getFournisseursFromForms($this->getServiceLocator());
            }

            return new JsonModel(array(
                'resultat'=>json_encode($fournisseurs)
            ));
        }

        return $this->redirect()->toRoute('home'); // Ou on redirige l'utilisateur vers une autre page
	}

	/**
	 * Permet de supprimer un interlocuteur définitivement
	 */
	public function supprimerinterlocuteurAction()
	{
		$request 	= $this->getRequest();
		
		if($request->isXmlHttpRequest())
        {
    		$id=(int)$this->params()->fromRoute('id');
    		$em 		= $this->getEntityManager();
			$interlocuteur=$em->getRepository('Fournisseur\Entity\InterlocuteurFournisseur')->find($id);

			if($interlocuteur==null)
			{
				throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Cet interlocuteur n\'existe pas'));
			}

			if($request->isPost())
			{
				// On supprime l'interlocuteur du fournisseur puis on enregistre le fournisseur
				$fournisseur = $interlocuteur->getRefSocieteFournisseur();
				$fournisseur->removeInterlocuteur($interlocuteur); 
				$em->persist($fournisseur);
				$em->flush();

				return new JsonModel(array(
					'statut' => true
				));
			}

			return new JsonModel(array(
				'statut' 			=> false,
				'interlocuteur'		=> 	$interlocuteur->getTitreCivilite().' '.
										$interlocuteur->getPrenom().' '.
										$interlocuteur->getNom().' - '.
										$interlocuteur->getRefSocieteFournisseur()->getRaisonSociale().' ('.
										$interlocuteur->getRefSocieteFournisseur()->getCodeFournisseur().')'
			));
        }
        return $this->redirect()->toRoute('fournisseur');
	}
}

?>