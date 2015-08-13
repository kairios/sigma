<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * InterlocuteurClient
 *
 * @ORM\Table(name="interlocuteur_client", indexes={@ORM\Index(name="fk_tbl_interlocuteur_client1_idx", columns={"ref_societe_client"}), @ORM\Index(name="fk_interlocuteur_fonction1_idx", columns={"ref_fonction"}), @ORM\Index(name="fk_interlocuteur_carte_visite1_idx", columns={"ref_carte_visite"})})
 * @ORM\Entity
 */
class InterlocuteurClient
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
     * @ORM\Column(name="fax", type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email_2", type="string", length=50, nullable=true)
     */
    private $email2;

    /**
     * @var \DateTime('Y-m-d H:i:s')
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
     * @var string
     *
     * @ORM\Column(name="accepte_infos", type="boolean", nullable=false)
     */
    private $accepteInfos = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="envoi_vers_outlook", type="boolean", nullable=false)
     */
    private $envoiVersOutlook = 0;

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
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client",inversedBy="interlocuteurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_client", referencedColumnName="id")
     * })
     */
    private $refSocieteClient;

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

    public function getEmail2()
    {
        return $this->email2;
    }

    public function setEmail2($email2)
    {
        $this->email2=$email2;
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

    public function getAccepteInfos()
    {
        return $this->accepteInfos;
    }

    public function setAccepteInfos($accepteInfos)
    {
        $this->accepteInfos=$accepteInfos;
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

    public function getRefSocieteClient()
    {
        return $this->refSocieteClient;
    }

    public function setRefSocieteClient($refSocieteClient)
    {
        $this->refSocieteClient=$refSocieteClient;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        // return get_object_vars($this);

        $idClient=$this->getRefSocieteClient();
        if(!(empty($idClient)))
            $idClient=$idClient->getId();

        $fonction = '';
        $idFonction=$this->getRefFonction();
        if(!(empty($idFonction)))
        {
            $fonction=$idFonction->getIntituleFonction();
            $idFonction=$idFonction->getId();
        }
            

        return array(
            'id_interlocuteur'      =>  $this->getId(),
            'nom'                   =>  $this->getNom(),
            'prenom'                =>  $this->getPrenom(),
            'telephone'             =>  $this->getTelephone(),
            'portable'              =>  $this->getPortable(),
            'fax'                   =>  $this->getFax(),
            'email'                 =>  $this->getEmail(),
            'email_2'               =>  $this->getEmail2(),
            'titre_civilite'        =>  $this->getTitreCivilite(),
            'accepte_infos'         =>  $this->getAccepteInfos(),
            'envoi_vers_outlook'    =>  $this->getEnvoiVersOutlook(),
            'ref_societe_client'    =>  $idClient,
            'ref_fonction'          =>  $idFonction,
            'fonction'              =>  $fonction
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refClient      = $em->getRepository('Client\Entity\Client')->find( (int)$data['ref_societe_client'] );
        $refFonction    = $em->getRepository('Application\Entity\FonctionInterlocuteur')->find( (int)$data['ref_fonction']) ;
        $client         = (!empty($refClient)) ? $refClient : null;
        $fonction       = (!empty($refFonction)) ? $refFonction : null;

        $nom            = (!empty($data['nom'])) ? $data['nom'] : null;
        $prenom         = (!empty($data['prenom'])) ? $data['prenom'] : null;
        $telephone      = (!empty($data['telephone'])) ? $data['telephone'] : null;
        $portable       = (!empty($data['portable'])) ? $data['portable'] : null;
        $fax            = (!empty($data['fax'])) ? $data['fax'] : null;
        $email          = (!empty($data['email'])) ? $data['email'] : null;
        $email2         = (!empty($data['email_2'])) ? $data['email_2'] : null;
        $titreCivilite  = (!empty($data['titre_civilite'])) ? $data['titre_civilite'] : null;
        
        $this->setId($data['id_interlocuteur']);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setTelephone($telephone);
        $this->setPortable($portable);
        $this->setFax($fax);
        $this->setEmail($email);
        $this->setEmail2($email2);
        $this->setTitreCivilite($titreCivilite);
        $this->setAccepteInfos($data['accepte_infos']);
        $this->setEnvoiVersOutlook($data['envoi_vers_outlook']);
        $this->setRefFonction($fonction);
        $this->setRefSocieteClient($client);
        $this->dateCreationModificationFiche = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
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
            ->columns(array('id','nom_complet'=> new Expression("CONCAT_WS(' ',titre_civilite,prenom,nom)"),'email','accepte_infos'))
            ->from(array('i'=>'interlocuteur_client'))
            ->join(
                array('c'=>'client'),
                'i.ref_societe_client = c.id',
                array('code_client','raison_sociale'),
                $select::JOIN_LEFT
            )
            ->order('nom ASC, prenom ASC')
            ->where(array('c.supprime'=>0))
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
            ->columns(array('id','nom_complet'=>new Expression("CONCAT_WS(' ',titre_civilite,prenom,nom)"),'email','accepte_infos'))
            ->from(array('i'=>'interlocuteur_client'))
            ->join(
                array('c'=>'client'),
                'i.ref_societe_client = c.id',
                array('code_client','raison_sociale'),
                $select::JOIN_LEFT
            )
            ->order('nom ASC, prenom ASC')
            ->limit($limit);
        ;

        $where = new Where;
        $where
            ->equalTo('c.supprime',0)
            ->and
            ->nest()
                ->like('i.prenom',$critere)
                ->or
                ->like('i.nom',$critere)
                ->or
                ->like('c.code_client',$critere)
                ->or
                ->like('c.raison_sociale',$critere)
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

    public function getNomsInterlocuteurs($sm,$client=null,$limit=100)
    {
        $query =   
            "SELECT id, CONCAT_WS(' ', titre_civilite, prenom, nom) as nom_complet
             FROM interlocuteur_client "
        ;
        if(!is_null($client))
        {
            $query.= " WHERE ref_societe_client = $client ";
        }

        $statement  = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results    = $statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }
}
