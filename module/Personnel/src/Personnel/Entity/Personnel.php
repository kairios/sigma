<?php

namespace Personnel\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * Personnel
 *
 * @ORM\Table(name="personnel")
 * @ORM\Entity
 */
class Personnel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=70, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=70, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=100, nullable=true)
     */
    private $motDePasse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification", type="datetime", nullable=true)
     */
    private $dateCreationModification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="administrateur", type="boolean", nullable=false)
     */
    private $administrateur = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="taux_horaire", type="float", precision=10, scale=0, nullable=true)
     */
    private $tauxHoraire;

    /**
     * @var \Personnel\Entity\FonctionPersonnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\FonctionPersonnel")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="ref_fonction", referencedColumnName="id")
     * })
     */
    private $refFonction;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function getDateCreationModification()
    {
        return $this->dateCreationModification;
    }

    public function setDateCreationModification($dateCreationModification)
    {
        $this->dateCreationModification=$dateCreationModification;
    }

    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    public function setAdminitrateur($administrateur)
    {
        $this->administrateur = $administrateur;
    }

    public function getTauxHoraire()
    {
        return $this->tauxHoraire;
    }

    public function setTauxHoraire($tauxHoraire)
    {
        $this->tauxHoraire = $tauxHoraire;
    }

    public function getRefFonction()
    {
        return $this->refFonction;
    }

    public function setRefFonction($refFonction)
    {
        $this->refFonction = $refFonction;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        // $fonction = '';
        $idFonction=$this->getRefFonction();
        if(!(empty($idFonction)))
        {
            // $fonction=$idFonction->getIntituleFonction();
            $idFonction=$idFonction->getId();
        }

        return array(
            'id_personnel'          =>  $this->getId(),
            'nom'                   =>  $this->getNom(),
            'prenom'                =>  $this->getPrenom(),
            'email'                 =>  $this->getEmail(),
            'mot_de_passe'          =>  $this->getMotDePasse(),
            'administrateur'        =>  $this->getAdministrateur(),
            'taux_horaire'          =>  $this->getTauxHoraire(),
            'ref_fonction'          =>  $idFonction,

        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refFonction    = $em->getRepository('Personnel\Entity\FonctionPersonnel')->find( (int)$data['ref_fonction'] );
        $fonction       = (!empty($refFonction)) ? $refFonction : null;

        $nom                            = (!empty($data['nom'])) ? $data['nom'] : null;
        $prenom                         = (!empty($data['prenom'])) ? $data['prenom'] : null;
        $email                          = (!empty($data['email'])) ? $data['email'] : null;
        $tauxHoraire                    = (!empty($data['taux_horaire'])) ? $data['taux_horaire'] : null;
        //$motDePasse                     = (!empty($data['mot_de_passe'])) ? $data['mot_de_passe'] : null;
        $dateCreationModificationFiche  = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
        
        $this->setId($data['id_personnel']);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setTauxHoraire($tauxHoraire);
        //$this->setMotDePasse($motDePasse);
        $this->setAdminitrateur($data['administrateur']);
        $this->setDateCreationModification($dateCreationModificationFiche);
        $this->setRefFonction($fonction);

        
    }

    public function loadByEmailAndPassword($em=null,$email='',$motDePasse='')
    {
        $return=array();
        $email2=str_ireplace(' ','',$email);
        $motDePasse2=str_ireplace(' ','',$motDePasse);
        
        if( !empty($email2) && !empty($motDePasse2) )
        {
            $query=$em->createQuery("SELECT p FROM Personnel\Entity\Personnel p WHERE p.email=:email and p.motDePasse=:mot_de_passe")
                        ->setParameter('email',$email)
                        ->setParameter('mot_de_passe',$motDePasse);
            $return=$query->getResult();
        }
        return $return;
    }

    public function existeAdministrateur($em = null)
    {
        $query = $em->createQuery("SELECT p FROM Personnel\Entity\Personnel p WHERE p.administrateur = 1");
        $personnels = $query->getResult();

        if(count($personnels)>0)
        {
            return true;
        }
        return false;
    }

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Client (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getListeUtilisateurs($sm)
    {
        $query =   
            "SELECT p.id, CONCAT_WS(' ', p.prenom, p.nom) AS nom_complet, p.email, f.intitule_fonction, p.taux_horaire 
             FROM personnel AS p
                LEFT JOIN fonction_personnel AS f
                    ON p.ref_fonction = f.id 
            ORDER BY nom_complet ASC
            "
        ;

        $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results = $statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }
}

?>