<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;
// Entités liées au fournisseur
use Adresse\Entity\Adresse; // Permet de mettre en place une relation bidirectionnelle
use Fournisseur\Entity\InterlocuteurFournisseur;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur", indexes={@ORM\Index(name="fk_tbl_fournisseur_categorie_fournisseur1_idx", columns={"ref_categorie"}), @ORM\Index(name="fk_tbl_fournisseur_activite_fournisseur1_idx", columns={"ref_activite"}), @ORM\Index(name="fk_fournisseur_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_fournisseur_condition_reglement1_idx", columns={"ref_condition_reglement"}), @ORM\Index(name="fk_fournisseur_poste1_idx", columns={"ref_poste_par_defaut"})})
 * @ORM\Entity
 */
class Fournisseur
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
     * @ORM\Column(name="code_fournisseur", type="string", length=10, nullable=true)
     */
    private $codeFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="code_client", type="string", length=30, nullable=true)
     */
    private $codeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=80, nullable=false)
     */
    private $raisonSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="site_web", type="text", nullable=true)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="datetime", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_tva", type="string", length=25, nullable=true)
     */
    private $numeroTva;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_siret", type="string", length=50, nullable=true)
     */
    private $numeroSiret;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_ape", type="string", length=10, nullable=true)
     */
    private $numeroApe;

    /**
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Application\Entity\ModeReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ModeReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_mode_reglement", referencedColumnName="id")
     * })
     */
    private $refModeReglement;

    // *
    //  * @var \Application\Entity\Poste
    //  *
    //  * @ORM\ManyToOne(targetEntity="Application\Entity\Poste")
    //  * @ORM\JoinColumns({
    //  *   @ORM\JoinColumn(name="ref_poste_par_defaut", referencedColumnName="id")
    //  * })
     
    // private $refPosteParDefaut;

    /**
     * @var \Fournisseur\Entity\ActiviteFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\ActiviteFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_activite", referencedColumnName="id")
     * })
     */
    private $refActivite;

    /**
     * @var \Fournisseur\Entity\CategorieFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\CategorieFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_categorie", referencedColumnName="id")
     * })
     */
    private $refCategorie;

    /**
     * @var \Adresse\Entity\Adresse
     *
     * @ORM\OneToMany(targetEntity="Adresse\Entity\Adresse",mappedBy="refFournisseur",orphanRemoval=true,cascade={"all"})
     */
    private $adresses;

    /**
     * @var \Fournisseur\Entity\InterlocuteurFournisseur
     *
     * @ORM\OneToMany(targetEntity="Fournisseur\Entity\InterlocuteurFournisseur",mappedBy="refSocieteFournisseur",orphanRemoval=true,cascade={"all"})
     */
    private $interlocuteurs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = 0;


    public function __construct()
    {
        $this->adresses=new ArrayCollection;
        $this->interlocuteurs=new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getCodeFournisseur()
    {
        return $this->codeFournisseur;
    }

    public function setCodeFournisseur($codeFournisseur)
    {
        $this->codeFournisseur=$codeFournisseur;
    }

    public function getCodeClient()
    {
        return $this->codeClient;
    }

    public function setCodeClient($codeClient)
    {
        $this->codeClient=$codeClient;
    }    

    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale=$raisonSociale;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone=$telephone;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax($fax)
    {
        $this->fax=$fax;
    }

    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb=$siteWeb;
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

    public function getNumeroTva()
    {
        return $this->numeroTva;
    }

    public function setNumeroTva($numeroTva)
    {
        $this->numeroTva=$numeroTva;
    }

    public function getNumeroSiret()
    {
        return $this->numeroSiret;
    }

    public function setNumeroSiret($numeroSiret)
    {
        $this->numeroSiret=$numeroSiret;
    }

    public function getNumeroApe()
    {
        return $this->numeroApe;
    }

    public function setNumeroApe($numeroApe)
    {
        $this->numeroApe=$numeroApe;
    }

    public function getRefCategorie()
    {
        return $this->refCategorie;
    }

    public function setRefCategorie($refCategorie)
    {
        $this->refCategorie=$refCategorie;
    }

    public function getRefActivite()
    {
        return $this->refActivite;
    }

    public function setRefActivite($refActivite)
    {
        $this->refActivite=$refActivite;
    }

    public function getRefModeReglement()
    {
        return $this->refModeReglement;
    }

    public function setRefModeReglement($refModeReglement)
    {
        $this->refModeReglement=$refModeReglement;
    }

    public function getRefConditionReglement()
    {
        return $this->refConditionReglement;
    }

    public function setRefConditionReglement($refConditionReglement)
    {
        $this->refConditionReglement=$refConditionReglement;
    }

    public function getRefPosteParDefaut()
    {
        return $this->refPosteParDefaut;
    }

    public function setRefPosteParDefaut($refPosteParDefaut)
    {
        $this->refPosteParDefaut=$refPosteParDefaut;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function setActif($actif)
    {
        $this->actif=$actif;
    }

    public function getSupprime()
    {
        return $this->supprime;
    }

    public function setSupprime($supprime)
    {
        $this->supprime=$supprime;
    }

    public function addAdresse(Adresse $adresse)
    {
        $this->adresses[]=$adresse;
        $adresse->setRefFournisseur($this);
        return $this;
    }

    public function removeAdresse(Adresse $adresse)
    {
        $this->adresses->removeElement($adresse);
        $adresse->setRefFournisseur(null); //Mais si on supprime l'adresse cela se répercute en base de données /!\
    }

    public function getAdresses()
    {
        return $this->adresses;
    }

    public function addInterlocuteur(InterlocuteurFournisseur $interlocuteur)
    {
        $this->interlocuteurs[]=$interlocuteur;
        $interlocuteur->setRefSocieteFournisseur($this);
        return $this;
    }

    public function removeInterlocuteur(InterlocuteurFournisseur $interlocuteur)
    {
        $this->interlocuteurs->removeElement($interlocuteur);
        $interlocuteur->setRefSocieteFournisseur(null); //Mais si on supprime l'interlocuteur cela se répercute en base de données /!\
    }

    public function getInterlocuteurs()
    {
        return $this->interlocuteurs;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idCategorie = $this->getRefCategorie();
        if(!(empty($idCategorie)))
            $idCategorie=$idCategorie->getId();

        $idActivite = $this->getRefActivite();
        if(!(empty($idActivite)))
            $idActivite=$idActivite->getId();

        $idModeReglement = $this->getRefModeReglement();
        if(!(empty($idModeReglement)))
            $idModeReglement=$idModeReglement->getId();

        $idConditionReglement = $this->getRefConditionReglement();
        if(!(empty($idConditionReglement)))
            $idConditionReglement=$idConditionReglement->getId();

        $idPoste = $this->getRefPosteParDefaut();
        if(!(empty($idPoste)))
            $idPoste=$idPoste->getId();

        return array(
            'id_fournisseur'            =>  $this->getId(),
            'code_fournisseur'          =>  $this->getCodeFournisseur(),
            'code_client'               =>  $this->getCodeClient(),
            'raison_sociale'            =>  $this->getRaisonSociale(),
            'telephone'                 =>  $this->getTelephone(),
            'fax'                       =>  $this->getFax(),
            'site_web'                  =>  $this->getSiteWeb(),
            'email'                     =>  $this->getEmail(),
            'numero_tva'                =>  $this->getNumeroTva(),
            'numero_ape'                =>  $this->getNumeroApe(),
            'numero_siret'              =>  $this->getNumeroSiret(),
            'actif'                     =>  $this->getActif(),
            'supprime'                  =>  $this->getSupprime(),
            'ref_categorie'             =>  $idCategorie,
            'ref_activite'              =>  $idActivite,
            'ref_mode_reglement'        =>  $idModeReglement,
            'ref_condition_reglement'   =>  $idConditionReglement,
            'ref_poste_par_defaut'      =>  $idPoste
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refCategorie                       = $em->getRepository('Fournisseur\Entity\CategorieFournisseur')->find( (int)$data['ref_categorie'] );
        $refActivite                        = $em->getRepository('Fournisseur\Entity\ActiviteFournisseur')->find( (int)$data['ref_activite'] );
        $refModeReglement                   = $em->getRepository('Application\Entity\ModeReglement')->find( (int)$data['ref_mode_reglement'] );
        $refConditionReglement              = $em->getRepository('Application\Entity\ConditionReglement')->find( (int)$data['ref_condition_reglement'] );
        $refPosteParDefaut                  = $em->getRepository('Application\Entity\Poste')->find( (int)$data['ref_poste_par_defaut'] );

        $categorie                          = (!empty($refCategorie)) ? $refCategorie : null;
        $activite                           = (!empty($refActivite)) ? $refActivite : null;
        $modeReglement                      = (!empty($refModeReglement)) ? $refModeReglement : null;
        $conditionReglement                 = (!empty($refConditionReglement)) ? $refConditionReglement : null;
        $poste                              = (!empty($refPosteParDefaut)) ? $refPosteParDefaut : null;

        $codeFournisseur                    = (!empty($data['code_fournisseur'])) ? $data['code_fournisseur'] : null;
        $codeClient                         = (!empty($data['code_client'])) ? $data['code_client'] : null;
        $raisonSociale                      = (!empty($data['raison_sociale'])) ? $data['raison_sociale'] : null;
        $telephone                          = (!empty($data['telephone'])) ? $data['telephone'] : null;
        $fax                                = (!empty($data['fax'])) ? $data['fax'] : null;
        $siteWeb                            = (!empty($data['site_web'])) ? $data['site_web'] : null;
        $email                              = (!empty($data['email'])) ? $data['email'] : null;
        $numeroTva                          = (!empty($data['numero_tva'])) ? $data['numero_tva'] : null;
        $numeroSiret                        = (!empty($data['numero_siret'])) ? $data['numero_siret'] : null;
        $numeroApe                          = (!empty($data['numero_ape'])) ? $data['numero_ape'] : null;
        $dateCreationModificationFiche      = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));

        $this->setId($data['id_fournisseur']);
        $this->setCodeFournisseur($codeFournisseur);
        $this->setCodeClient($codeClient);
        $this->setRaisonSociale($raisonSociale);
        $this->setTelephone($telephone);
        $this->setFax($fax);
        $this->setSiteWeb($siteWeb);
        $this->setEmail($email);
        $this->setDateCreationModificationFiche($dateCreationModificationFiche);
        $this->setNumeroTva($numeroTva);
        $this->setNumeroSiret($numeroSiret);
        $this->setNumeroApe($numeroApe);
        $this->setRefCategorie($categorie);
        $this->setRefActivite($activite);
        $this->setRefModeReglement($modeReglement);
        $this->setRefConditionReglement($conditionReglement);
        $this->setRefPosteParDefaut($poste);
        $this->setActif($data['actif']);
        $this->setSupprime($data['supprime']);
    }

    public function findAllFournisseur($em=null)
    {
        $fournisseurs=null;
        $query="SELECT c.id,c.code_fournisseur,c.raison_sociale FROM Fournisseur\Entity\Fournisseur c WHERE c.supprime = 0";
        $fournisseurs=$em->createQuery($query)->getResult();
    }

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Fournisseur (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getListeFournisseur($sm,$criteres=array(),$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array('id','code_fournisseur','raison_sociale'))
                ->from(array('f'=>'fournisseur'))
                ->join(
                        array('a'=>'adresse'),                  // nom de la table à joindre
                        'a.ref_fournisseur = f.id',                  // expression de jointure
                        array('code_postal','ville','pays'),    // colonnes que je souhaite réccupérer de la table de jointure
                        $select::JOIN_LEFT                      // type de jointure, ici jointure gauche externe afin d'afficher même les Fournisseurs qui n'ont pas d'adresse principale
                )
                ->order('raison_sociale ASC')
                ->limit($limit)
        ;

        $where = new Where;
        $where
            ->equalTo('f.supprime',0)
            ->and
            ->nest()
                ->equalTo('a.adresse_principale',1)
                ->or
                ->isNull('a.adresse_principale')
            ->unnest();
        // Si des critères sont spécifiés dans les paramètres, on les ajoute
        // Ainsi, cette méthode pourra être appelée pour faire des recherches sur les colonnes traitées
        if(sizeof($criteres)>0)
        {
            foreach($criteres as $critere => $value)
            {
                $where->and->expression($critere,$value);

            }
        }
        $select->where($where);

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
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Fournisseur (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getFournisseurs($sm,$critere,$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array('id','code_fournisseur','raison_sociale'))
                ->from(array('f'=>'fournisseur'))
                ->join(
                        array('a'=>'adresse'),                  // nom de la table à joindre
                        'a.ref_fournisseur = f.id',                  // expression de jointure
                        array('code_postal','ville','pays'),    // colonnes que je souhaite réccupérer de la table de jointure
                        $select::JOIN_LEFT                      // type de jointure, ici jointure gauche externe afin d'afficher même les fournisseurs qui n'ont pas d'adresse principale
                )
                ->order('raison_sociale ASC')
                ->limit($limit)
        ;

        $where = new Where;
        $where
            ->equalTo('f.supprime',0)
            ->and
            ->nest()
                ->equalTo('a.adresse_principale',1)
                ->or
                ->isNull('a.adresse_principale')
            ->unnest()
            ->and
            ->nest()
                ->like('f.code_fournisseur',$critere)
                ->or
                ->like('f.raison_sociale',$critere)
                ->or
                ->like('a.code_postal',$critere)
                ->or
                ->like('a.ville',$critere)
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

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Fournisseur (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getFournisseursFromForms($sm,$codeFournisseur='',$raisonSociale=null,$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array('id','societe'=>new Expression("CONCAT(f.raison_sociale,' (',a.code_postal,' ',a.ville,', ',a.pays,')')")))
                ->from(array('f'=>'fournisseur'))
                ->join(
                        array('a'=>'adresse'),                  // nom de la table à joindre
                        'a.ref_fournisseur = f.id',                  // expression de jointure
                        array(),                                // colonnes que je souhaite réccupérer de la table de jointure
                        $select::JOIN_LEFT                      // type de jointure, ici jointure gauche externe afin d'afficher même les fournisseurs qui n'ont pas d'adresse principale
                )
                ->order('raison_sociale ASC')
                //->limit($limit)
        ;

        $where = new Where;

        if($codeFournisseur!=='')
        {
            if($codeFournisseur===null)
            {
               //var_dump($codeFournisseur);die();
                $where->isNull('f.code_fournisseur')->and;
            }
            else
            {
                $where->equalTo('f.code_fournisseur',$codeFournisseur)->and;
            }
        }
        if($raisonSociale!==null)
        {
            $where->equalTo('f.raison_sociale',$raisonSociale)->and;
        }

        $where
            ->equalTo('f.supprime',0)
            ->and
            ->nest()
                ->equalTo('a.adresse_principale',1)
                ->or
                ->isNull('a.adresse_principale')
            ->unnest();
        $select->where($where);

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

    public function getCodesFournisseur($sm)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array(new Expression('DISTINCT(code_fournisseur) as code_fournisseur')))
                ->from(array('f'=>'fournisseur'))
                ->order('code_fournisseur ASC')
        ;
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

    public function getFournisseurssByActivitiesAndCategories($sm, $activites = null, $categories = null, $motCle = null)
    {
        $query =   
            "SELECT f.id, f.code_fournisseur, f.raison_sociale, a.code_postal, a.ville, a.pays 
             FROM fournisseur AS f 
                LEFT JOIN adresse AS a 
                    ON a.ref_fournisseur = f.id 
             WHERE f.supprime = 0 AND ( a.adresse_principale = 1 OR a.adresse_principale IS NULL ) "
        ;

        if(!is_null($activites))
        {
            $idActivites = implode(',', $activites);
            $query.= " AND f.ref_activite IN ($idActivites) ";
        }

        if(!is_null($categories))
        {
            $idCategories = implode(',', $categories);
            $query.= " AND f.ref_categorie IN ($idCategories) ";
        }

        if(!is_null($motCle))
        {
            $query.=
                " AND (f.code_fournisseur LIKE '%$motCle%' 
                  OR f.raison_sociale LIKE '%$motCle%' 
                  OR a.code_postal LIKE '%$motCle%' 
                  OR a.ville LIKE '%$motCle%' 
                  OR a.pays LIKE '%$motCle%')
                ";
        }
        
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
