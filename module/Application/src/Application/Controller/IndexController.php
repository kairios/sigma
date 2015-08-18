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
        // if($this->verifierConnexion())
        // {
        //     //Assignation de variables au layout
        //     $this->layout()->setVariables(array(
        //         'headTitle'     =>  $this->getServiceLocator()->get('Translator')->translate('Outil de gestion commerciale - Zeppelin Sytems France'),
        //         'route'             =>  'application',
        //         'action'            =>  'index',
        //         'module'            =>  'application',                          
        //     ));

        //     return new ViewModel();
        // }

        set_time_limit(0);
        $serveur='localhost';
        $utilisateur='root';
        $mdp=null;
        $base='sigma-old';
        $connection=mysql_connect($serveur, $utilisateur, $mdp);
        mysql_select_db($base,$connection);
        mysql_set_charset('utf8',$connection);

        // Suppression des données des tables sigma.client et sigma.adresse

        $truncate="TRUNCATE sigma.produit";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        $truncate="TRUNCATE sigma.traduction";
        $boolTruncate=mysql_query($truncate,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$truncate." : ".mysql_error());
        }
        echo 'Réinitialisation des tables produit et traduction terminée';
        /*
        $delete="DELETE FROM sigma.adresse WHERE adresse.ref_client IS NOT NULL";
        $boolTruncate=mysql_query($delete,$connection);
        if( $boolTruncate!=true )
        {
            die("Erreur lors d'un truncate avec la requête ".$delete." : ".mysql_error());
        }*/
        

        //On récupère les lignes de l'ancienne table produit
        $rows=array();
        $query="SELECT * FROM `sigma-old`.tbl_produit";
        $result=mysql_query($query,$connection);
        while($row=mysql_fetch_array($result))
        {
            // Identifiant du client
            $id=intval($row['ref_produit']);

            /* Insertion des adresses du client */

            // données de traduction
            $fr = (empty($row['intitule_produit_fr']))?null:"'".addslashes($row['intitule_produit_fr'])."'";
            $en = (empty($row['intitule_produit_uk']))?null:"'".addslashes($row['intitule_produit_uk'])."'";

            // Si l'un des champs de traduction n'est pas null, on enregistre la traduction
            if($fr||$en)
            {
                $fr=(empty($fr))?"NULL":$fr;
                $en=(empty($en))?"NULL":$en;

                // Requète de l'insertion de la traduction 
                $insert_traduction = "INSERT INTO `sigma`.`traduction` VALUES (
                    ".$fr.",
                    ".$en."
                );";

                // Exécution de la requète
                $result_traduction=mysql_query($insert_traduction);

                if(!$result_traduction)
                {
                    echo "Impossible d'exécuter la requête ($insert_traduction) dans la base : " . mysql_error();
                    exit;
                }
            }

            /* Insertion du produit lui-même */

            $id_traduction="NULL";

            // Données du produit
            $codeProduit = (empty($row['reference']))?"NULL":"'".addslashes($row['reference'])."'";
            $date_maj="'".time()."'";
            $remarques = 'NULL';

            // Récupération des clés étrangères en BD
            if(!empty($row['intitule_produit_fr']) || !empty($row['intitule_produit_uk']))
            {
                $fr = addslashes($row['intitule_produit_fr']);
                $en = addslashes($row['intitule_produit_uk']);

                $query_traduction="SELECT id FROM `sigma`.traduction WHERE fr = '".$fr."' AND en = '".$en."'";
                $result_traduction=mysql_query($query_traduction,$connection);

                if(mysql_num_rows($result_traduction)>0)
                {
                    while( $data=mysql_fetch_array($result_traduction) )
                    {
                        $id_traduction=intval($data['id']); // if($id_traduction==0)$id_traduction="NULL";
                    }
                }
            }
            
            // Requète d'insertion produit
            $insert_produit="INSERT INTO `sigma`.`client`(
                `id`,
                `code_produit`,
                `ref_intitule_produit`,
                `date_creation_modification_fiche`,
                `remarques`
            ) VALUES (
                ".$id.",
                ".$codeProduit.",
                ".$id_traduction.",
                ".$date_maj.",
                ".$remarques."
            );";

            // Exécution de la requète
            $result_produit=mysql_query($insert_produit);

            if(!$result_produit)
            {
                echo "Impossible d'exécuter la requête ($insert_produit) dans la base : " . mysql_error();
                exit;
            }
        }

        \Zend\Debug\Debug::dump('Imporatation terminée');die();
        mysql_close($connection);
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
        // $utilisateur->offsetSet('fonction',$personnel->getRefFonction()->getIntituleFonction());
        $utilisateur->offsetSet('connecte',true);
    }
}

?>