<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
// Session
use Zend\Session\Container;
// EntityManager
use Doctrine\ORM\EntityManager;
use Application\Form\AuthentificationForm;
// Entités
use Personnel\Entity\Personnel;


class IndexController extends AbstractActionController
{
    /**
     * Entity Manager
     * @var DoctrineORMEntityManager
     */
    protected $em;

    private function getEntityManager()
    {
        if(null===$this->em)
        {
            $this->em=$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    private function setEntityManager(EntityManager $em)
    {
        $this->em=$em;
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
        if($this->verifierConnexion())
        {
            //Assignation de variables au layout
            $this->layout()->setVariables(array(
                'headTitle'     =>  $this->getServiceLocator()->get('Translator')->translate('Outil de gestion commerciale - Zeppelin Sytems France'),
                'route'             =>  'application',
                'action'            =>  'index',
                'module'            =>  'application',                          
            ));

            return new ViewModel();
        }
    }

    public function authentificationAction()
    {
        // On change le layout
        $this->layout('layout/login');
        //Assignation de variables au layout
        $this->layout()->setVariables(array(
            'headTitle'         =>  $this->getServiceLocator()->get('Translator')->translate('S\'authentifier'),
            'route'             =>  'application_login',
            'action'            =>  'authentification',
            'module'            =>  'application',
            'plugins'           =>  array(),
        ));

        $em = $this->getEntityManager();
        $request = $this->getRequest();
        $form = new AuthentificationForm();
        $messageForm = null;

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $email = $this->params()->fromPost('email');
                $motDePasse = $this->params()->fromPost('mot_de_passe');
                $personnel = new Personnel;

                $personnels = $personnel->loadByEmailAndPassword($em,$email,md5($motDePasse));

                if($personnels) // Si le personnel existe
                {
                    //var_dump($infos);die();

                    $this->miseEnSessionUtilisateur($personnels[0],$email,$motDePasse);

                    return $this->redirect()->toRoute('home');
                }
                else
                {
                    $messageForm = $this->getServiceLocator()->get('Translator')->translate('Identifiants invalides');
                }
            }
            else
            {
                $messageForm = $this->getServiceLocator()->get('Translator')->translate('Vueillez ressaisir vos entrées');
            }
        }

        return new ViewModel(array(
            'form'          => $form,
            'messageForm'   => $messageForm,
        ));
    }

    public function deconnexionAction()
    {
        //On détruit la session de l'utilisateur
        @session_destroy();
        $utilisateur=new Container('utilisateur');
        $utilisateur->getManager()->getStorage()->clear('utilisateur');
        
        //Redirect login page
        $this->redirect()->toRoute('application_login',array());
    }

    public function miseEnSessionUtilisateur(Personnel $personnel, $email, $motDePasse)
    {
        $utilisateur = new Container('utilisateur');
        $utilisateur->offsetSet('id',$personnel->getId());
        $utilisateur->offsetSet('admin',$personnel->getAdministrateur());
        $utilisateur->offsetSet('identite',$personnel->getPrenom().' '.$personnel->getNom());
        $utilisateur->offsetSet('email',$email);
        $utilisateur->offsetSet('mot_de_passe',$motDePasse);
        $utilisateur->offsetSet('taux_horaire',$personnel->getTauxHoraire());
        $utilisateur->offsetSet('date_modif',$personnel->getDateCreationModification());
        $utilisateur->offsetSet('fonction',$personnel->getRefFonction()->getIntituleFonction());
        $utilisateur->offsetSet('connecte',true);
    }
}

?>