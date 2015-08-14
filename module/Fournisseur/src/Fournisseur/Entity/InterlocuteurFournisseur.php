<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;
/**
 * InterlocuteurFournisseur
 *
 * @ORM\Table(name="interlocuteur_fournisseur", indexes={@ORM\Index(name="fk_interlocuteur_fournisseur_fonction1_idx", columns={"ref_fonction"}), @ORM\Index(name="fk_interlocuteur_fournisseur_carte_visite1_idx", columns={"ref_carte_visite"}), @ORM\Index(name="fk_interlocuteur_fournisseur_fournisseur1_idx", columns={"ref_societe_fournisseur"})})
 * @ORM\Entity
 */
class InterlocuteurFournisseur
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
     * @ORM\Column(name="nom", type="string", length=200, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=200, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="portable", type="string", length=50, nullable=true)
     */
    private $portable;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="datetime", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_civilite", type="string", length=5, nullable=false)
     */
    private $titreCivilite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="envoi_vers_outlook", type="boolean", nullable=false)
     */
    private $envoiVersOutlook = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=150, nullable=true)
     */
    private $complement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = 0;

    /**
     * @var \Application\Entity\FonctionInterlocuteur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FonctionInterlocuteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fonction", referencedColumnName="id")
     * })
     */
    private $refFonction;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id")
     * })
     */
    private $refSocieteFournisseur;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom=$nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom=$prenom;
    }

    public function getPrenomNom()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone=$telephone;
    }

    public function getPortable()
    {
        return $this->portable;
    }

    public function setPortable($portable)
    {
        $this->portable=$portable;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax($fax)
    {
        $this->fax=$fax;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email=$email;
    }

    public function getDateCreationModificationFiche()
    {
        return $this->dateCreationModificationFiche;
    }

    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {
        $this->dateCreationModificationFiche=$dateCreationModificationFiche;
    }

    public function getTitreCivilite()
    {
        return $this->titreCivilite;
    }

    public function setTitreCivilite($titreCivilite)
    {
        $this->titreCivilite=$titreCivilite;
    }

    public function getEnvoiVersOutlook()
    {
        return $this->envoiVersOutlook;
    }

    public function setEnvoiVersOutlook($envoiVersOutlook)
    {
        $this->envoiVersOutlook=$envoiVersOutlook;
    }

    public function getRefFonction()
    {
        return $this->refFonction;
    }

    public function setRefFonction($refFonction)
    {
        $this->refFonction=$refFonction;
    }

    public function getRefSocieteFournisseur()
    {
        return $this->refSocieteFournisseur;
    }

    public function setRefSocieteFournisseur($refSocieteFournisseur)
    {
        $this->refSocieteFournisseur=$refSocieteFournisseur;
    }

    public function getSupprime()
    {
        return $this->supprime;
    }

    public function setSupprime($supprime)
    {
        $this->supprime=$supprime;
    }

    public function getComplement()
    {
        return $this->complement;
    }

    public function setComplement($complement)
    {
        $this->complement=$complement;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idFournisseur=$this->getRefSocieteFournisseur();
        if(!(empty($idFournisseur)))
            $idFournisseur=$idFournisseur->getId();

        $fonction = '';
        $idFonction=$this->getRefFonction();
        if(!(empty($idFonction)))
        {
            $fonction=$idFonction->getIntituleFonction();
            $idFonction=$idFonction->getId();
        }
            

        return array(
            'id_interlocuteur'              =>  $this->getId(),
            'nom'                           =>  $this->getNom(),
            'prenom'                        =>  $this->getPrenom(),
            'telephone'                     =>  $this->getTelephone(),
            'portable'                      =>  $this->getPortable(),
            'fax'                           =>  $this->getFax(),
            'email'                         =>  $this->getEmail(),
            'titre_civilite'                =>  $this->getTitreCivilite(),
            'envoi_vers_outlook'            =>  $this->getEnvoiVersOutlook(),
            'ref_societe_fournisseur'       =>  $idFournisseur,
            'ref_fonction'                  =>  $idFonction,
            'fonction'                      =>  $fonction,
            'complement'                    =>  $this->getComplement(),
            'supprime'                      =>  $this->getSupprime(),
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refFournisseur = $em->getRepository('Fournisseur\Entity\Fournisseur')->find( (int)$data['ref_societe_fournisseur'] );
        $refFonction    = $em->getRepository('Application\Entity\FonctionInterlocuteur')->find( (int)$data['ref_fonction']) ;
        $fournisseur    = (!empty($refFournisseur)) ? $refFournisseur : null;
        $fonction       = (!empty($refFonction)) ? $refFonction : null;

        $nom            = (!empty($data['nom'])) ? $data['nom'] : null;
        $prenom         = (!empty($data['prenom'])) ? $data['prenom'] : null;
        $telephone      = (!empty($data['telephone'])) ? $data['telephone'] : null;
        $portable       = (!empty($data['portable'])) ? $data['portable'] : null;
        $fax            = (!empty($data['fax'])) ? $data['fax'] : null;
        $email          = (!empty($data['email'])) ? $data['email'] : null;
        $titreCivilite  = (!empty($data['titre_civilite'])) ? $data['titre_civilite'] : null;
        $complement     = (!empty($data['complement'])) ? $data['complement'] : null;
        
        $this->setId($data['id_interlocuteur']);
        $this->setSupprime($data['supprime']);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setTelephone($telephone);
        $this->setPortable($portable);
        $this->setFax($fax);
        $this->setEmail($email);
        $this->setTitreCivilite($titreCivilite);
        $this->setEnvoiVersOutlook($data['envoi_vers_outlook']);
        $this->setRefFonction($fonction);
        $this->setRefSocieteFournisseur($fournisseur);
        $this->dateCreationModificationFiche = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
        $this->setComplement($complement);
    }

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Interlocuteur (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getListeInterlocuteur($sm,$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select
            ->columns(array('id','nom_complet'=> new Expression("CONCAT_WS(' ',titre_civilite,prenom,nom)"),'email'))
            ->from(array('i'=>'interlocuteur_fournisseur'))
            ->join(
                array('f'=>'fournisseur'),
                'i.ref_societe_fournisseur = f.id',
                array('code_fournisseur','raison_sociale'),
                $select::JOIN_LEFT
            )
            ->order('nom ASC, prenom ASC')
            ->where(array('f.supprime'=>0))
            ->limit($limit);

        $statement=$sql->prepareStatementForSqlObject($select);
        $results=$statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Interlocuteur (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getInterlocuteurs($sm,$critere,$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select
            ->columns(array('id','nom_complet'=>new Expression("CONCAT_WS(' ',titre_civilite,prenom,nom)"),'email','envoi_vers_outlook'))
            ->from(array('i'=>'interlocuteur_fournisseur'))
            ->join(
                array('f'=>'fournisseur'),
                'i.ref_societe_fournisseur = f.id',
                array('code_fournisseur','raison_sociale'),
                $select::JOIN_LEFT
            )
            ->order('nom ASC, prenom ASC')
            ->limit($limit);
        ;

        $where = new Where;
        $where
            ->equalTo('f.supprime',0)
            ->and
            ->nest()
                ->like('i.prenom',$critere)
                ->or
                ->like('i.nom',$critere)
                ->or
                ->like('f.code_fournisseur',$critere)
                ->or
                ->like('f.raison_sociale',$critere)
                ->or
                ->like('i.email',$critere)
            ->unnest();
        $select->where($where);
        //\Zend\Debug\Debug::dump($select->getSqlString());die();

        $statement=$sql->prepareStatementForSqlObject($select);
        $results=$statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }
}
