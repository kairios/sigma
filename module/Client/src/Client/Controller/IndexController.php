<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-20 10:29:46
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-28 10:38:39
 */

// module\Client\src\Client\Controller\IndexController.php

namespace Client\Controller;

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
use Client\Entity\Client;
use Client\Entity\InterlocuteurClient;

use Client\Form\ClientForm;
use Client\Form\InterlocuteurClientForm;

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
	 * Action qui permet d'avoir un listing des clients et des interlocuteurs
	 */
	public function listeclientAction()
	{
		$client=new Client;

		//Si la requète n'est pas de type AJAX, on n'effectue pas de recherche
        if(!$this->getRequest()->isXmlHttpRequest())
        {
			//Assignation de variables au layout
			$this->layout()->setVariables(array(
				'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Liste des clients'),
				'breadcrumbActive'	=>	$this->getServiceLocator()->get('Translator')->translate('Liste des clients'),
				'route'				=>	array('Clients'),
				'action'			=>	'listeclient',
				'module'			=>	'client',
				'plugins'			=>	array('dataTable','chosen'),
				//'userId'			=>	$userId,
				//'login'			=>	$login,									
			));

			$types 			= $this->getEntityManager()->getRepository('Client\Entity\TypeSegment')->findBy(array(), array('intituleTypeSegment'=>'ASC'));
			$segments 		= $this->getEntityManager()->getRepository('Client\Entity\Segment')->findBy(array(), array('intituleSegment'=>'ASC'));
			$produitsFinis 	= $this->getEntityManager()->getRepository('Client\Entity\ProduitFini')->findBy(array(), array('intituleProduitFini'=>'ASC'));

			return new ViewModel(array(
				'clients'			=> $client->getListeClient($this->getServiceLocator()),
				'types_segment'		=> $types,
	            'segments'			=> $segments,
	            'produits_finis'	=> $produitsFinis
			));
		}

		// S'il s'agit d'une recherche

		$resultat 	= array();
		$motCle 	= isset($_GET['motCle']) ? $_GET['motCle'] : null;

		// Avec type de segment

		if (isset($_GET['produitsFinis']))
        {
        	$arrayProduits = $_GET['produitsFinis'];

    		$resultat = $client->getClientsByProduitsFinisAndMotCle(
    			$this->getServiceLocator(),
				$arrayProduits,
				$motCle
    		);
        }
        else if(isset($_GET['segments']))
        {
        	$arraySegments = $_GET['segments'];

        	$resultat = $client->getClientsBySegmentsAndMotCle(
        		$this->getServiceLocator(),
				$arraySegments,
				$motCle
			);
        }
        else if(isset($_GET['typesSegment']))
        {
        	$arrayTypes = $_GET['typesSegment'];

        	$resultat = $client->getClientsByTypesSegmentAndMotCle(
        		$this->getServiceLocator(),
				$arrayTypes,
				$motCle
        	);
        }
        else if(!is_null($motCle))
        {
        	$resultat = $client->getClients(
				$this->getServiceLocator(),
				'%'.addslashes($motCle).'%',
				intval($_GET['maxRows'])
			);
        }
        else
        {
        	$resultat = $client->getListeClient($this->getServiceLocator());
        }

		return new JsonModel(array(
            'resultat'	=> json_encode($resultat),
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
        	$interlocuteur=new InterlocuteurClient;
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
	 * Permet la creation ou la modificaton d'un client
	 */
	public function formulaireclientAction()
	{
		/* Initialisation de variables */
		$sm=$this->getServiceLocator();
		// Récupération du traducteur
		$translator=$sm->get('Translator');
		// Récupération de l'EntityManager
		$em=$this->getEntityManager();
		// Récupération de la requete
		$request=$this->getRequest();
		// Récupération de la session du client
		$session=new Container('societeSession');
		$utilisateur=new Container('utilisateur');

		/* Initialisation du client */

		$client=null;
		$id=(int)$this->params()->fromRoute('id');

		if(!empty($id))
		{
			// Récupération du client
			$client=$em->getRepository('Client\Entity\Client')->find($id);
			if($client==null)
				throw new \Exception($translator->translate('Ce client n\'existe pas'));

			//Assignation de variables au layout
			$this->layout()->setVariables(array(
				'headTitle'			=>  $translator->translate('Modifier un client'),
				'breadcrumbActive'	=>	$client->getRaisonSociale(),
				'route'				=>	array('Clients','Modification'),
				'action'			=>	'formulaireclient',							
				'module'			=>	'client',
				'plugins'			=>	array('jquery-ui','mask','chosen'),
			));
		}
		else
		{
			// On crée un nouveau client
			$id=null;
			$client=new Client;
			//Assignation de variables au layout
			$this->layout()->setVariables(array(
				'headTitle'			=>  $translator->translate('Nouveau client'),
				'breadcrumbActive'	=>	$translator->translate('Nouveau client'),
				'route'				=>	array('Clients'),
				'action'			=>	'formulaireclient',							
				'module'			=>	'client',
				'plugins'			=>	array('jquery-ui','mask','chosen'),
			));
		}

		// Creation du formulaire du client
		$form=new ClientForm($translator,$sm,$em,$request,$client);
		//$form->get('segments')->setData($client->getSegmentsId());
		if($request->isPost())
		{
			$form->setData($request->getPost());
			if($form->isValid())
			{
				/* Hydratation de l'objet Client avec les données du formulaire */

				// var_dump($form->getData());die();
				$client->exchangeArray($form->getData(),$em);

				//$em->refresh($client); // Ceci permet de mettre à jour le client avec les données de la base de données (pour réccupérer l'ID par exemple)

				/* Remplacement des adresses du client par celles en Session */

				$segments = $form->getData()['segments'];
				$produits = $form->getData()['produits_finis'];
				// var_dump($segments);
				// var_dump($produits);
				// die();

				if(is_array($segments) && count($segments) > 0)
				{
					$client->getSegments()->clear();
					foreach($segments as $segment)
					{
						if($segment !=  "")
						{
							$client->addSegment(
								$em
								->getRepository('Client\Entity\Segment')
								->findOneBy(array('id'=>$segment))
							);
						}
					}
				}
				if(is_array($produits) && count($produits) > 0)
				{
					$client->getProduitsFinis()->clear();
					foreach($produits as $produit)
					{
						if($produit !=  "")
						{
							$client->addProduitFini(
								$em
								->getRepository('Client\Entity\ProduitFini')
								->findOneById($produit)
							);
						}
					}
				}

				$adresses=$session->offsetGet('adresses',array());
				
				foreach($client->getAdresses() as $a1)
				{
					$client->removeAdresse($a1);
				}
				// $client->getAdresses()->clear(); // Ceci ne supprime ^pas la référence de l'adresse vers le client, donc pas sûr que la persistence soit respectée des deux cotés
				foreach($adresses as $a2)
				{
					$nouvelleAdresse=new Adresse;
					$nouvelleAdresse->exchangeArray($a2,$em);
					$client->addAdresse($nouvelleAdresse);
				}

				/* Remplacement des interlocuteurs du client par ceux en Session */

				$interlocuteurs=$session->offsetGet('interlocuteurs',array());
				
				foreach($client->getInterlocuteurs() as $i1)
				{
					$client->removeInterlocuteur($i1);
				}
				// $client->getInterlocuteurs()->clear();
				foreach($interlocuteurs as $i2)
				{
					$nouvelInterlocuteur=new InterlocuteurClient;
					$nouvelInterlocuteur->exchangeArray($i2,$em);
					$client->addInterlocuteur($nouvelInterlocuteur);
				}

				try
				{
					$em->persist($client); // Persiste les adresses et les interlocuteurs en cascade avec le client
					$em->flush();
				}
				catch(\Exception $e)
				{
					$erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde du client. Vérifiez que tous les champs sont valides (Informations générales, interlocuteurs, adresses..).').$e->getMessage();
					$messagesFlash = $this->flashArray;
					$messagesFlash['errors'][] = $erreurMessage;
					$utilisateur->offsetSet('messagesFlash', $messagesFlash);

					return new ViewModel(array(
						'client'=>$client,
						'form'=>$form,
						'id'=>$id
					));
				}
				
				return $this->redirect()->toRoute('client/consulter_client',array('id'=>$client->getId()));
			}
		}

		// Mise en session des interlocuteurs et adresses du client

		$array1 = $array2 = array();
		$adresses = $client->getAdresses();
		$interlocuteurs = $client->getInterlocuteurs();

		foreach($adresses as $a)
		{
			$uniqid = uniqid('',true);
			$array1[$uniqid]=$a->getArrayCopy();
		}
		foreach($interlocuteurs as $i)
		{
			$uniqid = uniqid('',true);
			$array2[$uniqid] = $i->getArrayCopy();
		}

		$session->offsetSet('adresses',$array1);
		$session->offsetSet('interlocuteurs',$array2);

		return new ViewModel(array(
			'client' 			=> $client,
			'form' 				=> $form,
			'id' 				=> $id,
		));
	}

	/**
	 * Permet d'afficher les informations d'un client
	 */
	public function consulterclientAction()
	{
		$id=(int)$this->params()->fromRoute('id');
		$client=$this->getEntityManager()->getRepository('Client\Entity\Client')->find($id);

		if($client==null)
		{
			throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Ce client n\'existe pas'));
		}

		//Assign variables to layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Fiche client'),
			'breadcrumbActive'	=>	'Détails client : '.$client->getRaisonSociale(),
			'route'				=>	array('Clients'),
			'action'			=>	'consulterclient',
			'module'			=>	'client',
			'plugins'			=>	array('jquery-ui'),
			//'userId'			=>	$userId,
			//'login'			=>	$login,									
		));
		
		return new ViewModel(array(
			'id'=>$id,
			'client'=>$client
		));
	}

	/**
	 * Permet de supprimer un clietn existant
	 */
	public function supprimerclientAction()
	{
		$request = $this->getRequest();
		
		if($request->isXmlHttpRequest())
        {
    		$id =(int)$this->params()->fromRoute('id');
    		$em = $this->getEntityManager();
			$client=$em->getRepository('Client\Entity\Client')->find($id);

			if($client==null)
			{
				throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Ce client n\'existe pas'));
			}

			if($request->isPost())
			{
				// On supprime le client ainsi que ses adresses et interlocuteurs
				$em->remove($client);
				$em->flush();

				return new JsonModel(array(
					'statut' => true
				));
			}

			return new JsonModel(array(
				'statut' 		=> false,
				'client'		=> $client->getRaisonSociale().' ('.$client->getCodeClient().')'
			));
        }
        return $this->redirect()->toRoute('client');
	}

	/**
	 * Permet la creation ou la modification d'un interlocuteur client
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
                $interlocuteur=$em->getRepository('Client\Entity\InterlocuteurClient')->find($id);
                if($interlocuteur==null)
                    throw new \Exception($translator->translate('Cet interlocuteur n\'existe pas'));
            }
            else // Sinon on crée un nouvel interlocuteur
            {
                $id=null;
                $interlocuteur=new InterlocuteurClient;
            }

            /* Creation du formulaire d'interlocuteur */
            
            $form=new InterlocuteurClientForm($translator,$sm,$em,$request,$interlocuteur);
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

            $viewModel = new ViewModel;
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
	 * Permet la creation ou la modification d'un interlocuteur client en session
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
            $interlocuteur=new InterlocuteurClient;
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
            $form=new InterlocuteurClientForm($translator,$sm,$em,$request,$interlocuteur);    
            if($request->isPost())
            {
                $form->setData($request->getPost());
                
                if(!$form->isValid()) // Test obligatoire pour obtenir les erreurs du formulaire
                {
                	$errors=$form->getMessages();
                	unset($errors['ref_societe_client']);
                	
                	if(sizeof($errors)>0)
                	{
                		$statusForm=false;

	                    return new JsonModel(array(
	                        'statut'=>$statusForm,
	                        'reponse'=>$errors,
	                    ));
                	}
                	// Si la seule erreur du formulaire est celle provoquée par le validateur de ref_societe_client
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
     * Permet de créer un span réutilisable dans le formulaire du client
     * @param  InterlocuteurClient $interlocuteur [description]
     * @param  [type]              $uniqId        [description]
     * @return string                             Un span avec les informations de l'interlocuteur
     */
    public function creationSpanInterlocuteur(InterlocuteurClient $interlocuteur,$uniqId)
    {
        // Récupération du traducteur
        $translator=$this->getServiceLocator()->get('Translator');

        $spanInterlocuteur='<span class="entite interlocuteur">';

        if($interlocuteur->getAccepteInfos()==true)
        {
            $spanInterlocuteur.='<small class="label label-success">'.$translator->translate('Reçoit infos').'</small> ';
        }
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
        return $this->redirect()->toRoute('client');
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
			$interlocuteur=$this->getEntityManager()->getRepository('Client\Entity\InterlocuteurClient')->find($id);

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
		return $this->redirect()->toRoute('client');
    }

	/**
	 * Permet de trouver la liste des sociétés ayant pour code client celui spécifié en paramètre
	 */
	public function autocompletionclientAction()
	{
		//Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
            $client=new Client;
            $clients=array();

            if(isset($_GET["codeClient"]))
            {
            	//var_dump($_GET["codeClient"]);
                $value=$_GET["codeClient"];
                if(!empty($value))
                	$clients=$client->getClientsFromForms($this->getServiceLocator(),$value);
                else
                	$clients=$client->getClientsFromForms($this->getServiceLocator(),null);
            }
            else
            {
                $clients=$client->getClientsFromForms($this->getServiceLocator());
            }

            return new JsonModel(array(
                'resultat'=>json_encode($clients)
            ));
        }

        //Si l'utilisateur tente d'accéder à l'url de l'action, on lui envoie une erreur 404
        //$this->getResponse()->setStatusCode(404);
        //return;
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
			$interlocuteur=$em->getRepository('Client\Entity\InterlocuteurClient')->find($id);

			if($interlocuteur==null)
			{
				throw new \Exception($this->getServiceLocator()->get('Translator')->translate('Cet interlocuteur n\'existe pas'));
			}

			if($request->isPost())
			{
				// On supprime l'interlocuteur du client puis on enregistre le client
				$client = $interlocuteur->getRefSocieteClient();
				$client->removeInterlocuteur($interlocuteur); 
				$em->persist($client);
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
										$interlocuteur->getRefSocieteClient()->getRaisonSociale().' ('.
										$interlocuteur->getRefSocieteClient()->getCodeClient().')'
			));
        }
        return $this->redirect()->toRoute('client');
	}

	public function listesegmentAction()
	{

		if($this->getRequest()->isXmlHttpRequest())
		{	
			$segments = $resultat = array();
			$sm = $this->getEntityManager();

			// Si un seul type de segment est transmis en paramètre
			if(isset($_GET['typeSegment']))
			{
				$segments = $sm->getRepository('Client\Entity\Segment')->findByRefTypeSegment($_GET['typeSegment']);
			}
			// Si un tableau de types de segment est transmis en paramètre
			else if (isset($_GET['typesSegment']))
			{
				$arrayTypes = $_GET['typesSegment'];

				foreach($arrayTypes as $type)
				{
					$segments=array_merge($segments, $sm->getRepository('Client\Entity\Segment')->findByRefTypeSegment($type));
				}
			}

			// TRADUIRE LES RESULTATS AVANT DE LES RETOURNER AU JAVASCRIPT !!!!!! [VOILA]
			foreach($segments as $segment)
			{
				$resultat[] = [
					'id' 	=> $segment->getId(), 
					'text' 	=> $this->getServiceLocator()->get('Translator')->translate($segment->getIntituleSegment())
				];
			}
			
			return new JsonModel(array(
				'resultat' => $resultat
			));
		}

		return $this->redirect()->toRoute('home');
	}

	public function listeproduitfiniAction()
	{
		if($this->getRequest()->isXmlHttpRequest())
		{	
			$produits = $resultat = array();
			$sm = $this->getEntityManager();

			// Si un seul  segment est transmis en paramètre
			if(isset($_GET['segment']))
			{
				$produits = $sm->getRepository('Client\Entity\ProduitFini')->findByRefSegment($_GET['segment']);
			}
			// Si un tableau de segment est transmis en paramètre
			else if (isset($_GET['segments']))
			{
				$arraySegments = $_GET['segments'];

				foreach($arraySegments as $segment)
				{
					$produits=array_merge($produits, $sm->getRepository('Client\Entity\ProduitFini')->findByRefSegment($segment));
				}
			}

			// TRADUIRE LES RESULTATS AVANT DE LES RETOURNER AU JAVASCRIPT !!!!!! [VOILA]
			foreach($produits as $produit)
			{
				$resultat[] = [
					'id' 	=> $produit->getId(), 
					'text' 	=> $this->getServiceLocator()->get('Translator')->translate($produit->getIntituleProduitFini())
				];
			}
			
			return new JsonModel(array(
				'resultat' => $resultat
			));
		}

		return $this->redirect()->toRoute('home');
	}

	
}

//http://stackoverflow.com/questions/20528862/zend-framework-2-set-reason-phrase-for-error-404 // to set a 404 error not found

?>