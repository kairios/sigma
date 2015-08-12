<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-29 17:40:56
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-12 15:11:43
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
use FicheHeure\Entity\SaisieHeureJournee;
use FicheHeure\Entity\SaisieHeureProjet;
use FicheHeure\Form\SaisieHeureJourneeForm;

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
        // Récupération de l'EntityManager
        $em=$this->getEntityManager();
        // Récupération du Service Manager
        $sm=$this->getServiceLocator();
         // Récupération du traducteur
        $translator=$sm->get('Translator');
        // Récupération de la requete
        $request=$this->getRequest();

        $utilisateur = new Container('utilisateur');
        // $utilisateurCourant = $utilisateur->offsetGet('identite');

        $id = $utilisateur->offsetGet('id');
        // $utilisateurCourant = $em->getRepository('Personnel\Entity\Personnel')->find($id);
        // if($utilisateurCourant == null)
        //     throw new \Exception($translator->translate('Une erreur est survenue au chargement des heures.'));

        $saisie = new SaisieHeureProjet();
        $saisiesHoraires = $saisie->getSaisiesHeureCalendar($id,$sm); // a transformer en array compréhensible par la conversion JSON.

        //Assignation de variables au layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $translator->translate('Fiche d\'heures'),
            'breadcrumbActive'  =>  $id,
            'route'             =>  array(),
            'action'            =>  'editer_fiche_heure',
            'module'            =>  'fiche_heure',
            'plugins'           =>  array('fullcalendar'),
        ));

        return new ViewModel(array(
            'saisiesJson' => $saisiesHoraires
        ));
    }

    

    public function formulairesaisiehoraireAction()
    {
        if($this->getRequest()->isXmlHttpRequest())
        {
            /************************************** Initialisation de variables **************************************/

            $statusForm=null;
            // Récupération de l'EntityManager
            $em = $this->getEntityManager();
            // Récupération du Service Manager
            $sm = $this->getServiceLocator();
             // Récupération du traducteur
            $translator = $sm->get('Translator');
            // Récupération de la requete
            $request = $this->getRequest();

            $utilisateur = new Container('utilisateur');

            /*********************************** Initialisation de la saisie heure ***********************************/

            $saisieHoraire = null;

            // On recupère la date en timestamp
            $date = $this->params()->fromRoute('date');
            list($y,$m,$d) = explode('-', $date); // Split day, month and year in chaines
            $timestamp = mktime(4, 0, 0, (int) $m, (int) $d, (int) $y); // Retourne un timestamp
            
            // On reccupère l'utilisateur courant
            $idPersonnel = $utilisateur->offsetGet('id');
            $utilisateurCourant = $em->getRepository('Personnel\Entity\Personnel')->find($idPersonnel);
            if($utilisateurCourant == null)
                throw new \Exception($translator->translate('Une erreur est survenue au chargement des horaires.'));

            // On recupère la saisie à partir de la date et du personnel
            $saisieHoraire = $em->getRepository('FicheHeure\Entity\SaisieHeureJournee')->findOneBy(array('date'=>$timestamp,'refPersonnel'=>$idPersonnel));
            if($saisieHoraire==null)
            {
                // On crée une nouvelle saisie d'horaires
                $saisieHoraire = new SaisieHeureJournee($utilisateurCourant,$date);
            }

            /******************************* Creation du formulaire de saisie d'heure *******************************/
            
            $form = new SaisieHeureJourneeForm($translator,$sm,$em,$request,$saisieHoraire);
            if($request->isPost())
            {
                $form->setData($request->getPost());

                if($form->isValid())
                {
                    $statusForm = true;
                    $saisieHoraire->exchangeArray($form->getData(),$em);

                    $saisieHeure = new SaisieHeureProjet;
                    $saisieHeure->exchangeArrayFromSaisieHoraire($form->getData(),$em);
                    $saisieHeure->setRefSaisieHoraire($saisieHoraire);

                    $em->persist($saisieHoraire);
                    $em->persist($saisieHeure);
                    $em->flush();

                    return new JsonModel(array(
                        'statut'    => $statusForm
                    ));
                }
                else // Sinon, on retourne les erreurs au formulaire qui les affiche
                {
                    $statusForm = false;
                    $errors     = $form->getMessages();

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'reponse'=>$errors,
                    ));
                }
            }

            /************************** Affichage du formulaire sans le layout (en modal) **************************/

            $viewModel=new ViewModel;
            // $view->setTemplate('fiche_heure/formulairesaisiehoraire');
            $viewModel->setVariables(array(
                'saisieHoraire'=>$saisieHoraire,
                'date'=>$date,
                'form'=>$form,
                // 'id'=>$saisieHoraire->getId()
            ))->setTerminal(true);

            return $viewModel;
        }
        return $this->redirect()->toRoute('home');
    }

    public function formulairesaisieheureAction()
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

            /* Initialisation de la saisie heure */
            $saisieHeure = null;
            $id = $this->params()->fromRoute('id');
            if(!empty($id)) // Si l'ID de la saisie d'heures est transmis, on réccupère celui-ci
            {
                // Récupération de la saisie d'heures en BD
                $saisieHeure = $em->getRepository('FicheHeure\Entity\SaisieHeure')->find($id);
                if($saisieHeure==null)
                    throw new \Exception($translator->translate('Une erreur est survenue au chargement des heures.'));
            }
            else // Sinon on crée une nouvelle saisie d'heures
            {
                $id = null;
                $saisieHeure = new SaisieHeure;
            }

            /* Creation du formulaire de saisie d'heure */
            
            $form = new SaisieHeureForm($translator,$sm,$em,$request,$saisieHeure);
            if($request->isPost())
            {
                $form->setData($request->getPost());

                if($form->isValid())
                {
                    $statusForm = true;
                    $saisieHeure->exchangeArray($form->getData(),$em);
                    $em->persist($saisieHeure);
                    $em->flush($saisieHeure);

                    return new JsonModel(array(
                        'statut'    => $statusForm,
                        'idSaisie' => $saisieHeure->getId(),
                    ));
                }
                else // Sinon, on retourne les erreurs au formulaire qui les affiche
                {
                    $statusForm = false;
                    $errors     = $form->getMessages();

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'reponse'=>$errors,
                    ));
                }
            }

            /* Affichage du formulaire sans le layout (en modal) */

            $viewModel=new ViewModel;
            $viewModel->setVariables(array(
                'saisieHeure'=>$saisieHeure,
                'form'=>$form,
                'id'=>$id
            ))->setTerminal(true);

            return $viewModel;
        }
        return $this->redirect()->toRoute('home');
    }
}

?>