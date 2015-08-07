<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-23 13:35:13
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-29 17:37:50
 */

// module\Client\src\Client\Controller\IndexController.php

namespace Personnel\Controller;

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
use Personnel\Entity\Personnel;
use Personnel\Form\PersonnelForm;
use Personnel\Form\PasswordForm;


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
            header('location:/authentification');
        }
        else
        {
            return false;
        }
    }

	public function indexAction()
	{

	}

	public function profilAction()
	{
		// On change le layout
        //$this->layout('layout/profil');
		//Assignation de variables au layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Votre profil Zeppelin'),
			'breadcrumbActive'	=>	$this->getServiceLocator()->get('Translator')->translate('?'),
			'route'				=>	array('Profil'),
			'action'			=>	'profil',
			'module'			=>	'personnel',
			'plugins'			=>	array(),							
		));
		return new ViewModel();
	}

	public function listepersonnelAction()
	{
		$personnel = new Personnel();
		//Assignation de variables au layout
		$this->layout()->setVariables(array(
			'headTitle'			=>  $this->getServiceLocator()->get('Translator')->translate('Utilisateurs Sigma V2.0'),
			'breadcrumbActive'	=>	$this->getServiceLocator()->get('Translator')->translate('Utilisateurs Sigma V2.0'),
			'route'				=>	array(),
			'action'			=>	'listepersonnel',
			'module'			=>	'personnel',
			'plugins'			=>	array(),
		));

		return new ViewModel(array(
			'personnels'			=> $personnel->getListeUtilisateurs($this->getServiceLocator()),
		));
	}

	/**
	 * Permet de supprimer un clietn existant
	 */
	public function formulairepasswordAction()  /* [ A COMPLETER !!!! ] */
	{
		$request = $this->getRequest();
		if($request->isXmlHttpRequest())
        {
    		$utilisateur = new Container('utilisateur');
    		$id = (int)$utilisateur->offsetGet('id');

    		$form = new PasswordForm($this->getServiceLocator()->get('Translator'));
			if($request->isPost())
			{
				$form->setData($request->getPost());

                if($form->isValid())
                {
     //            	continue;
     //            	// On test que la confirmation est la même que le mot de passe
					// // On test que le mot de passe est assez sécure
					// // On test que l'ancien mot de passe soit correcte et renvoi à un utilisateur
					// // Si tout est ok, on renvoie true après avoir mis le mot de passe à jour en session,
					// // sinon, on renvoie des erreurs personnalisées et statut à false
     //                $statusForm=true;
     //                // $interlocuteur->exchangeArray($form->getData(),$em);
     //                // $em->persist($interlocuteur);
     //                // $em->flush($interlocuteur);

     //                return new JsonModel(array(
     //                    'statut'=>$statusForm,
     //                    'motCle'=>$interlocuteur->getNom(),
     //                ));
                	
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

			// return new JsonModel(array(
			// 	'statut' 		=> false,
			// 	'id_personnel' 	=> $id,
			// 	'form' 			=> $form,
			// ));

			$viewModel = new ViewModel;
            $viewModel->setVariables(array(
				'form'=>$form,
				'id'=>$id
			))->setTerminal(true);

            return $viewModel;
        }
        return $this->redirect()->toRoute('home');
	}

	// public function formulaireprofilAction()
	// {
	// 	/* Initialisation de variables */

	// 	// Récupération du Service Manager
	// 	$sm 		= $this->getServiceLocator();
	// 	// Récupération du traducteur
	// 	$translator = $sm->get('Translator');
	// 	// Récupération de l'EntityManager
	// 	$em 		= $this->getEntityManager();
	// 	// Récupération de la requete
	// 	$request 	= $this->getRequest();

		// $utilisateur = new Container('utilisateur');

	// 	/* Initialisation du client */

	// 	$id 		= (int) $utilisateur->offsetGet('id');
	// 	$personnel 	= null;

		// if(!empty($id))
		// {
		// 	// Récupération du personnel
		// 	$personnel = $em->getRepository('Personnel\Entity\Personnel')->find($id);
		// 	if($personnel == null)
		// 		throw new \Exception($translator->translate('Cet utilisateur n\'existe pas'));

		// 	//Assignation de variables au layout
		// 	$this->layout()->setVariables(array(
		// 		'headTitle'			=>  $translator->translate('Profil utilisateur'),
		// 		'breadcrumbActive'	=>	$personnel->getPrenom().' '.$personnel->getNom(),
		// 		'route'				=>	array(),
		// 		'action'			=>	'formulairepersonnel',							
		// 		'module'			=>	'personnel',
		// 		'plugins'			=>	array(),
		// 	));
		// }
		// else
		// {
		// 	// On crée un nouvel utilisateur
		// 	$id = null;
		// 	$personnel = new Personnel();

		// 	//Assignation de variables au layout
		// 	$this->layout()->setVariables(array(
		// 		'headTitle'			=>  $translator->translate('Nouvel utilisateur'),
		// 		'breadcrumbActive'	=>	$translator->translate('Nouvel utilisateur'),
		// 		'route'				=>	array(),
		// 		'action'			=>	'formulairepersonnel',							
		// 		'module'			=>	'personnel',
		// 		'plugins'			=>	array(),
		// 	));
		// }

	// 	// Creation du formulaire du personnel
	// 	$form = new PersonnelForm($translator,$personnel,$sm,$em,$request);	
	// 	if($request->isPost())
	// 	{
	// 		$form->setData($request->getPost());

	// 		if($form->isValid()) // Si le personnel a déjà un mot de passe et qu'il y a des erreurs dans le formulaire
 //            {
 //            	$errors = $form->getMessages();

	// 			if($id == null)
	// 			{
	// 				// Génération du mot de passe
	// 				// Envoi d'un email avec le mot de passe généré
	// 			}
	// 			else // Si on modifie un utilisateur possédant déjà un mot de passe
	// 			{
	// 				if(!($form->getData()['mot_de_passe'] == $form->getData()['confirmation_mot_de_passe']))
	// 				{
	// 					//var_dump('erreur confirmation incorrecte');die();
	// 					$erreurConfirmation = array(
	// 						'UNSAME'=>'Vous devez saisir deux fois le même mot de passe.'
	// 					);
	// 					$errors['mot_de_passe'] =  $erreurConfirmation;
	// 					$errors['confirmation_mot_de_passe'] = $erreurConfirmation;

	// 					$form->setMessages($errors);
	// 				}
	// 				else
	// 				{
	// 					/* Hydratation de l'objet Personnel avec les données du formulaire */
	// 					$personnel->exchangeArray($form->getData(), $em); 
						
	// 					$motDePasse = $form->getData()['mot_de_passe'];
	// 					if(empty($motDePasse))
	// 					{
	// 						$motDePasse = $utilisateur->offsetGet('mot_de_passe');
	// 					}
						
	// 					$personnel->setMotDePasse(md5($motDePasse));

	// 					//var_dump(md5($motDePasse));die();

	// 					try
	// 					{
	// 						$em->persist($personnel);
	// 						$em->flush();

	// 						// Mettre à jour les informations du personnel en session !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	// 						$em->refresh($personnel); // Ceci permet de mettre à jour le client avec les données de la base de données (pour réccupérer l'ID par exemple)
	// 						$this->miseEnSessionUtilisateur($personnel,$motDePasse);

	// 					}
	// 					catch(\Exception $e)
	// 					{
	// 						$erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde de votre profil. Vérifiez que tous les champs sont valides.')/*.$e->getMessage()*/;
	// 						$messagesFlash = $this->flashArray;
	// 						$messagesFlash['errors'][] = $erreurMessage;
	// 						$utilisateur->offsetSet('messagesFlash', $messagesFlash);

	// 						return new ViewModel(array(
	// 							'personnel'=>$personnel,
	// 							'form'=>$form,
	// 							'id'=>$id
	// 						));
	// 					}
						
	// 					//return $this->redirect()->toRoute('client/consulter_client',array('id'=>$client->getId()));

	// 					return $this->redirect()->toRoute('profil');
	// 				}
	// 			}
	// 		}
	// 	}

	// 	return new ViewModel(array(
	// 		'personnel'=>$personnel,
	// 		'form'=>$form,
	// 		'id'=>$id
	// 	));
	// }

	public function formulairepersonnelAction()
	{
		if($this->getRequest()->isXmlHttpRequest())
        {
			/* Initialisation de variables */

			$statusForm=null;
			// Récupération du Service Manager
			$sm 		= $this->getServiceLocator();
			// Récupération du traducteur
			$translator = $sm->get('Translator');
			// Récupération de l'EntityManager
			$em 		= $this->getEntityManager();
			// Récupération de la requete
			$request 	= $this->getRequest();

			$utilisateur = new Container('utilisateur');

			/* Initialisation du client */

			$id 		= (int) $this->params()->fromRoute('id');
			$personnel 	= null;

			if(!empty($id))
			{
				// Récupération du personnel
				$personnel = $em->getRepository('Personnel\Entity\Personnel')->find($id);
				if($personnel == null)
					throw new \Exception($translator->translate('Cet utilisateur n\'existe pas'));

				//Assignation de variables au layout
				$this->layout()->setVariables(array(
					'headTitle'			=>  $translator->translate('Profil utilisateur'),
					'breadcrumbActive'	=>	$personnel->getPrenom().' '.$personnel->getNom(),
					'route'				=>	array(),
					'action'			=>	'formulairepersonnel',							
					'module'			=>	'personnel',
					'plugins'			=>	array(),
				));
			}
			else
			{
				// On crée un nouvel utilisateur
				$id = null;
				$personnel = new Personnel();

				//Assignation de variables au layout
				$this->layout()->setVariables(array(
					'headTitle'			=>  $translator->translate('Nouvel utilisateur'),
					'breadcrumbActive'	=>	$translator->translate('Nouvel utilisateur'),
					'route'				=>	array(),
					'action'			=>	'formulairepersonnel',							
					'module'			=>	'personnel',
					'plugins'			=>	array(),
				));
			}

			// Creation du formulaire du personnel
			$form = new PersonnelForm($translator,$personnel,$sm,$em,$request);	
			if($request->isPost())
			{
				$form->setData($request->getPost());

				if($form->isValid()) // Si le personnel a déjà un mot de passe et qu'il y a des erreurs dans le formulaire
	            {
	            	/* Hydratation de l'objet Personnel avec les données du formulaire */
	            	$statusForm=true;
					$personnel->exchangeArray($form->getData(), $em); 
					
					if($id == null)
					{
						$motDePasse = $this->genererMotDePasse();
						$personnel->setMotDePasse(md5($motDePasse));
					}

					try
					{
						$em->persist($personnel);
						$em->flush();

						if($personnel->getAdministrateur())
						{
							$motDePasse = $utilisateur->offsetGet('mot_de_passe');
							$em->refresh($personnel); // Ceci permet de mettre à jour le personnel avec les données de la base de données (pour réccupérer l'ID par exemple)
							$this->miseEnSessionUtilisateur($personnel, $motDePasse); // Mise à jour du personnel en session s'il s'agit de la personne connectée
						}

						return new JsonModel(array(
			                'statut'	=> $statusForm,
			                'pwd' 		=> $motDePasse
			        	));
					}
					catch(\Exception $e)
					{
						$erreurMessage = $translator->translate('Une erreur est survenue durant la sauvegarde de votre profil. Vérifiez que tous les champs sont valides.')/*.$e->getMessage()*/;
						$messagesFlash = $this->flashArray;
						$messagesFlash['errors'][] = $erreurMessage;
						$utilisateur->offsetSet('messagesFlash', $messagesFlash);

						/* Affichage du formulaire sans le layout (en modal) */

						$viewModel = new ViewModel;
			            $viewModel->setVariables(array(
							'personnel'=>$personnel,
							'form'=>$form,
							'id'=>$id
						))->setTerminal(true);

			            return $viewModel;
					}
					
					return $this->redirect()->toRoute('personnel');
				}
				else
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
				'personnel'=>$personnel,
				'form'=>$form,
				'id'=>$id
			))->setTerminal(true);

            return $viewModel;
		}

		return $this->redirect()->toRoute('home');
	}

	public function miseEnSessionUtilisateur(Personnel $personnel, $motDePasse)
    {
        $utilisateur = new Container('utilisateur');
        $utilisateur->offsetSet('id',$personnel->getId());
        $utilisateur->offsetSet('admin',$personnel->getAdministrateur());
        $utilisateur->offsetSet('identite',$personnel->getPrenom().' '.$personnel->getNom());
        $utilisateur->offsetSet('email',$personnel->getEmail());
        $utilisateur->offsetSet('mot_de_passe',$motDePasse); // Hum... Réccupérer le mot de passe en session ou celui fournit par le formulaire. Encodé en MD5 à ce moment là ou pas ?
        $utilisateur->offsetSet('taux_horaire',$personnel->getTauxHoraire());
        $utilisateur->offsetSet('date_modif',$personnel->getDateCreationModification());
        $utilisateur->offsetSet('fonction',$personnel->getRefFonction()->getIntituleFonction());
        $utilisateur->offsetSet('connecte',true);
    }

    /**
     * Génère un mot de passe alphanumérique de 10 caractères
     * @return string
     * @author  Anthony PROSPERO
     * Le 24/07/2015
     */
    public function genererMotDePasse()
    {
    	$mdp = "";
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		for($i=0;$i<10;$i++) {

		    $mdp .= substr($str, rand(0, 61), 1);
		}

		//return '1234';
		return $mdp;
    }
}

?>