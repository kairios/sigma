<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-09 13:34:46
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-17 19:00:20
 */

namespace Adresse\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
// EntityManager
use Doctrine\ORM\EntityManager;
use Adresse\Entity\Commune;
use Adresse\Entity\Adresse;
use Adresse\Form\AdresseForm;
use Adresse\Model\AdresseModel;
// Session
use Zend\Session\Container;

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

    public function indexAction()
    {

    }

    public function autocompletionadresseAction()
    {
        //Si la requète est de type AJAX, on effectue la recherche
        if($this->getRequest()->isXmlHttpRequest())
        {
            $list=array();

            if (isset($_GET["codePostal"]))
            {
                $value=$_GET["codePostal"]."%";
                $query=$this->getEntityManager()->createQuery("SELECT c.codePostal,c.ville FROM Application\Entity\Commune c WHERE c.codePostal LIKE :codePostal AND c.codePays='FR'");
                $query->setParameter('codePostal',$value);
                $query->setMaxResults(intval($_GET['maxRows']));
            }
            else
            {
                $value=$_GET['ville']."%";
                $query=$this->getEntityManager()->createQuery("SELECT c.codePostal,c.ville FROM Application\Entity\Commune c WHERE c.ville LIKE :ville AND c.codePays='FR'");
                $query->setParameter('ville',$value);
                $query->setMaxResults(intval($_GET['maxRows']));
            }
            $list=$query->getResult();

            return new JsonModel(array(
                'resultat'=>json_encode($list)
            ));
        }

        //Si l'utilisateur tente d'accéder à l'url de l'action, on lui envoie une erreur 404
        //$this->getResponse()->setStatusCode(404);
        //return;
        return $this->redirect()->toRoute('home'); // Ou on redirige l'utilisateur vers une autre page
    }

    public function formulaireadressesessionAction()
    {
        if($this->getRequest()->isXmlHttpRequest())
        {

            /* Initialisation de variables */

            $statusForm=null;
            // Récupération du traducteur
            $translator=$this->getServiceLocator()->get('Translator');
            // Récupération de l'EntityManager
            $em=$this->getEntityManager();
            // Récupération de la requete
            $request=$this->getRequest();

            $session=new Container('societeSession');
            $adresses=$session->offsetGet('adresses',array());

            /* Initialisation de l'adresse */

            $adresse=new Adresse;
            $uniqid=$this->params()->fromRoute('id');
            if(!empty($uniqid)) // Si l'ID de l'adresse est transmis, on réccupère celle-ci
            {
                // Récupération de l'adresse depuis la base de données
                //$adresse=$em->getRepository('Adresse\Entity\Adresse')->find($id);

                // Récupération de l'adresse depuis la session
                $a=$adresses[$uniqid];
                if($a==null)
                    throw new \Exception($translator->translate('Cette adresse  n\'existe pas'));
                $adresse->exchangeArray($a,$em);
            }
            else // Sinon on crée une nouvelle adresse
            {
                $uniqid=null;
                /* // Ajout d'une reférence vers le client ou le fournisseur pour la nouvelle adresse
                if(isset($_GET['from']) && isset($_GET['refFrom']))
                {
                    $refFrom=(int)$_GET['refFrom'];
                    switch($_GET['from'])
                    {
                        case 'client':
                            $client=$em->getRepository('Client\Entity\Client')->find($refFrom);
                            $adresse->setRefClient($client);
                        break;
                        case 'fournisseur':
                            $fournisseur = $em->getRepository('Fournisseur\Entity\Fournisseur')->find($refFrom);
                            $adresse->setRefFournisseur($fournisseur);
                        break;
                    }
                }*/ 
            }

            /* Creation du formulaire d'adresse */

            $form=new AdresseForm($translator,$em,$adresse,$request);    
            if($request->isPost())
            {
                $form->setData($request->getPost());

                if($form->isValid()) // Si le formulaire est valide, on ajoute l'adresse en session et on retourne le JSON de l'adresse pour afficher la span
                {
                    $statusForm=true;
                    $adresse->exchangeArray($form->getData(),$em);

                    if(is_null($uniqid))
                        $uniqid=uniqid('',true);
                    $adresses[$uniqid]=$adresse->getArrayCopy();
                    $session->offsetSet('adresses',$adresses);

                    $spanAdresse=$this->creationSpanAdresse($adresse,$uniqid);

                    return new JsonModel(array(
                        'statut'=>$statusForm,
                        'uniqid'=>$uniqid,
                        'reponse'=>$spanAdresse
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
                'adresse'=>$adresse,
                'form'=>$form,
                'id'=>$uniqid
            ))->setTerminal(true);

            return $viewModel;
        }

        return $this->redirect()->toRoute('home'); // Ou on redirige l'utilisateur vers une autre page
    }

    public function supprimeradressesessionAction()
    {
        if($this->getRequest()->isXmlHttpRequest())
        {
            $statut=null;
            $uniqid=$this->params()->fromRoute('id');
            if(!empty($uniqid))
            {
                // Suppression de l'adresse en session
                $session=new Container('societeSession');
                $adresses=$session->offsetGet('adresses',array());
                unset($adresses[$uniqid]);
                $session->offsetSet('adresses',$adresses);
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
        return $this->redirect()->toRoute('home');
    }

    public function creationSpanAdresse(Adresse $adresse,$uniqId)
    {
        // Récupération du traducteur
        $translator=$this->getServiceLocator()->get('Translator');

        $spanAdresse='<span class="entite adresse">';

        if($adresse->getAdressePrincipale()==true)
        {
            $spanAdresse.='<small class="label label-info">'.$translator->translate('Principale').'</small> ';
        }
        if($adresse->getAdresseFacturation()==true)
        {
            $spanAdresse.='<small class="label label-danger">'.$translator->translate('Facturation').'</small> ';
        }
        if($adresse->getAdresseLivraison()==true)
        {
            $spanAdresse.='<small class="label label-primary">'.$translator->translate('Livraison').'</small> ';
        }
        if($adresse->getAdressePostale()==true)
        {
            $spanAdresse.='<small class="label label-default">'.$translator->translate('Postale').'</small> ';
        }
        $spanAdresse.=  $adresse->getRue1().' '.$adresse->getRue2().' '.$adresse->getRue3().' '.
                        $adresse->getCodePostal().' '.$adresse->getVille().' '.$adresse->getPays().
                        '<input type="hidden" value="'.$uniqId.'"/>
                        <i class="fa fa-times pull-right" title="'.$translator->translate('Supprimer').'"></i>
            </span>'
        ;

        return $spanAdresse;
    }
        
}

?>