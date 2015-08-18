<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;
// Entités liées au client
use Adresse\Entity\Adresse; // Permet de mettre en place une relation bidirectionnelle
use Client\Entity\InterlocuteurClient;
use Client\Entity\TypeSegment;
use Client\Entity\Segment;
use Client\Entity\ProduitFini;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="fk_client_type_segment1_idx", columns={"ref_type_segment"}), @ORM\Index(name="fk_client_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_client_condition_reglement1_idx", columns={"ref_condition_reglement"})})
 * @ORM\Entity
 */
class Client
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
     * @ORM\Column(name="code_client", type="string", length=10, nullable=true)
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
     * @ORM\Column(name="date_creation", type="string", length=20, nullable=true)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="effectif_salarie", type="string", length=50, nullable=true)
     */
    private $effectifSalarie;

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
     * @var \DateTime('Y-m-d H:i:s')
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="datetime", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise_a_livrer", type="text", nullable=true)
     */
    private $entrepriseALivrer;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise_a_facturer", type="text", nullable=true)
     */
    private $entrepriseAFacturer;

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

    /**
     * @var \Client\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\TypeSegment", inversedBy="clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id")
     * })
     */
    private $refTypeSegment;

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

    /**
     * @var \Adresse\Entity\Adresse
     *
     * @ORM\OneToMany(targetEntity="Adresse\Entity\Adresse",mappedBy="refClient",orphanRemoval=true,cascade={"all"})
     */
    private $adresses;

    /**
     * @var \Client\Entity\InterlocuteurClient
     *
     * @ORM\OneToMany(targetEntity="Client\Entity\InterlocuteurClient",mappedBy="refSocieteClient",orphanRemoval=true,cascade={"all"})
     */
    private $interlocuteurs;

    
    /**
     * @var \Client\Entity\Segment
     *
     * @ORM\ManyToMany(targetEntity="Client\Entity\Segment")
     * @ORM\JoinTable(name="client_a_segment",
     *     joinColumns={@ORM\JoinColumn(name="ref_client", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ref_segment", referencedColumnName="id")}
     *     )
     */
    private $segments;

    /**
     * @var \Client\Entity\ProduitFini
     *
     * @ORM\ManyToMany(targetEntity="Client\Entity\ProduitFini")
     * @ORM\JoinTable(name="client_a_produit_fini",
     *     joinColumns={@ORM\JoinColumn(name="ref_client", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ref_produit_fini", referencedColumnName="id")}
     *     )
     */
    private $produitsFinis;

    public function __construct()
    {
        $this->adresses         = new ArrayCollection();
        $this->interlocuteurs   = new ArrayCollection();
        $this->produitsFinis    = new ArrayCollection();
        $this->segments         = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getDateCreationModificationFiche()
    {
        return $this->dateCreationModificationFiche;
    }

    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {
        $this->dateCreationModificationFiche=$dateCreationModificationFiche;
    }

    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale=$raisonSociale;
    }

    public function getCodeClient()
    {
        return $this->codeClient;
    }

    public function setCodeClient($codeClient)
    {
        $this->codeClient=$codeClient;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation($dateCreation)
    {
        $this->dateCreation=$dateCreation;
    }

    public function getEffectifSalarie()
    {
        return $this->effectifSalarie;
    }

    public function setEffectifSalarie($effectifSalarie)
    {
        $this->effectifSalarie=$effectifSalarie;
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

    public function getEntrepriseALivrer()
    {
        return $this->entrepriseALivrer;
    }

    public function setEntrepriseALivrer($entrepriseALivrer)
    {
        $this->entrepriseALivrer=$entrepriseALivrer;
    }

    public function getEntrepriseAFacturer()
    {
        return $this->entrepriseAFacturer;
    }

    public function setEntrepriseAFacturer($entrepriseAFacturer)
    {
        $this->entrepriseAFacturer=$entrepriseAFacturer;
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

    public function getRefTypeSegment()
    {
        return $this->refTypeSegment;
    }

    public function setRefTypeSegment($refTypeSegment)
    {
        $this->refTypeSegment=$refTypeSegment;
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
        $adresse->setRefClient($this);
        return $this;
    }

    public function removeAdresse(Adresse $adresse)
    {
        $this->adresses->removeElement($adresse);
        $adresse->setRefClient(null); //Mais si on supprime l'adresse cela se répercute en base de données /!\
    }

    public function getAdresses()
    {
        return $this->adresses;
    }

    public function addInterlocuteur(InterlocuteurClient $interlocuteur)
    {
        $this->interlocuteurs[]=$interlocuteur;
        $interlocuteur->setRefSocieteClient($this);
        return $this;
    }

    public function removeInterlocuteur(InterlocuteurClient $interlocuteur)
    {
        $this->interlocuteurs->removeElement($interlocuteur);
        $interlocuteur->setRefSocieteClient(null); //Mais si on supprime l'interlocuteur cela se répercute en base de données /!\
    }

    public function getInterlocuteurs()
    {
        return $this->interlocuteurs;
    }

    public function addSegment(Segment $segment)
    {
        $this->segments[]=$segment;
        return $this;
    }

    public function removeSegment(Segment $segment)
    {
        $this->segments->removeElement($segment);
    }

    public function getSegments()
    {
        return $this->segments;
    }

    public function addProduitFini(ProduitFini $produitFini)
    {
        $this->produitsFinis[]=$produitFini;
        return $this;
    }

    public function removeProduitFini(ProduitFini $produitFini)
    {
        $this->produitsFinis->removeElement($produitFini);
    }

    public function getProduitsFinis()
    {
        return $this->produitsFinis;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refTypeSegment                     = $em->getRepository('Client\Entity\TypeSegment')->find( (int)$data['ref_type_segment'] );
        $refModeReglement                   = $em->getRepository('Application\Entity\ModeReglement')->find( (int)$data['ref_mode_reglement'] );
        $refConditionReglement              = $em->getRepository('Application\Entity\ConditionReglement')->find( (int)$data['ref_condition_reglement'] );

        $typeSegment                        = (!empty($refTypeSegment)) ? $refTypeSegment : null;
        $modeReglement                      = (!empty($refModeReglement)) ? $refModeReglement : null;
        $conditionReglement                 = (!empty($refConditionReglement)) ? $refConditionReglement : null;

        $codeClient                         = (!empty($data['code_client'])) ? $data['code_client'] : null;
        $raisonSociale                      = (!empty($data['raison_sociale'])) ? $data['raison_sociale'] : null;
        $dateCreation                       = (!empty($data['date_creation'])) ? $data['date_creation'] : null;
        $effectifSalarie                    = (!empty($data['effectif_salarie'])) ? $data['effectif_salarie'] : null;
        $telephone                          = (!empty($data['telephone'])) ? $data['telephone'] : null;
        $fax                                = (!empty($data['fax'])) ? $data['fax'] : null;
        $siteWeb                            = (!empty($data['site_web'])) ? $data['site_web'] : null;
        $email                              = (!empty($data['email'])) ? $data['email'] : null;
        $entrepriseALivrer                  = (!empty($data['entreprise_a_livrer'])) ? $data['entreprise_a_livrer'] : null;
        $entrepriseAFacturer                = (!empty($data['entreprise_a_facturer'])) ? $data['entreprise_a_facturer'] : null;
        $numeroTva                          = (!empty($data['numero_tva'])) ? $data['numero_tva'] : null;
        $numeroSiret                        = (!empty($data['numero_siret'])) ? $data['numero_siret'] : null;
        $numeroApe                          = (!empty($data['numero_ape'])) ? $data['numero_ape'] : null;
        $dateCreationModificationFiche      = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));

        $this->id = $data['id_client'];
        $this->setCodeClient($codeClient);
        $this->setRaisonSociale($raisonSociale);
        $this->setDateCreation($dateCreation);
        $this->setEffectifSalarie($effectifSalarie);
        $this->setTelephone($telephone);
        $this->setFax($fax);
        $this->setSiteWeb($siteWeb);
        $this->setEmail($email);
        $this->setEntrepriseALivrer($entrepriseALivrer);
        $this->setEntrepriseAFacturer($entrepriseAFacturer);
        $this->setNumeroTva($numeroTva);
        $this->setNumeroSiret($numeroSiret);
        $this->setNumeroApe($numeroApe);
        $this->setRefModeReglement($modeReglement);
        $this->setRefConditionReglement($conditionReglement);
        $this->setRefTypeSegment($typeSegment);
        $this->setActif($data['actif']);
        $this->setSupprime($data['supprime']);
        $this->setDateCreationModificationFiche($dateCreationModificationFiche);
    }

    public function findAllClient($em=null)
    {
        $clients=null;
        $query="SELECT c.id,c.code_client,c.raison_sociale FROM Client\Entity\Client c WHERE c.supprime = 0";
        $clients=$em->createQuery($query)->getResult();
    }

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Client (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getListeClient($sm,$criteres=array(),$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array('id','code_client','raison_sociale'))
                ->from(array('c'=>'client'))
                ->join(
                        array('a'=>'adresse'),                  // nom de la table à joindre
                        'a.ref_client = c.id',                  // expression de jointure
                        array('code_postal','ville','pays'),    // colonnes que je souhaite réccupérer de la table de jointure
                        $select::JOIN_LEFT                      // type de jointure, ici jointure gauche externe afin d'afficher même les clients qui n'ont pas d'adresse principale
                )
                ->order('raison_sociale ASC')
                ->limit($limit)
        ;

        $where = new Where;
        $where
            ->equalTo('c.supprime',0)
            ->and
            ->nest()
                ->equalTo('a.adresse_principale',1)
                ->or
                ->isNull('a.adresse_principale')
                // Très important de vérifier que l'adresse principale est nulle, sinon les clients n'ayant pas d'adresse principale n'apparaitront pas !!!
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
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Client (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getClients($sm,$critere,$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array('id','code_client','raison_sociale'))
                ->from(array('c'=>'client'))
                ->join(
                        array('a'=>'adresse'),                  // nom de la table à joindre
                        'a.ref_client = c.id',                  // expression de jointure
                        array('code_postal','ville','pays'),    // colonnes que je souhaite réccupérer de la table de jointure
                        $select::JOIN_LEFT                      // type de jointure, ici jointure gauche externe afin d'afficher même les clients qui n'ont pas d'adresse principale
                )
                ->order('raison_sociale ASC')
                ->limit($limit)
        ;

        $where = new Where;
        $where
            ->equalTo('c.supprime',0)
            ->and
            ->nest()
                ->equalTo('a.adresse_principale',1)
                ->or
                ->isNull('a.adresse_principale') 
                // Très important de vérifier que l'adresse principale est nulle, sinon les clients n'ayant pas d'adresse principale n'apparaitront pas !!!
            ->unnest()
            ->and
            ->nest()
                ->like('c.code_client',$critere)
                ->or
                ->like('c.raison_sociale',$critere)
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


    public function getClientsByProduitsFinisAndMotCle($sm,$produitsFinis,$motCle=null)
    {
        $idProduits = implode(',', $produitsFinis);

        $query =   
            "SELECT c.id, c.code_client, c.raison_sociale, a.code_postal, a.ville, a.pays 
             FROM client AS c 
                LEFT JOIN adresse AS a 
                    ON a.ref_client = c.id
                INNER JOIN client_a_produit_fini AS cp
                    ON cp.ref_client = c.id
             WHERE c.supprime = 0 AND ( a.adresse_principale = 1 OR a.adresse_principale IS NULL ) AND cp.ref_produit_fini IN ($idProduits)"
             // Très important de vérifier que l'adresse principale est nulle, sinon les clients n'ayant pas d'adresse principale n'apparaitront pas !!!
        ;

        if(!is_null($motCle))
        {
            $query.=
                " AND (c.code_client LIKE '%$motCle%' 
                  OR c.raison_sociale LIKE '%$motCle%' 
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

    public function getClientsBySegmentsAndMotCle($sm,$segments,$motCle=null)
    {
        $idSegments = implode(',', $segments);

        $query =   
            "SELECT c.id, c.code_client, c.raison_sociale, a.code_postal, a.ville, a.pays 
             FROM client AS c 
                LEFT JOIN adresse AS a 
                    ON a.ref_client = c.id
                INNER JOIN client_a_segment AS cs
                    ON cs.ref_client = c.id
             WHERE c.supprime = 0 AND ( a.adresse_principale = 1 OR a.adresse_principale IS NULL ) AND cs.ref_segment IN ($idSegments)"
             // Très important de vérifier que l'adresse principale est nulle, sinon les clients n'ayant pas d'adresse principale n'apparaitront pas !!!
        ;

        if(!is_null($motCle))
        {
            $query.=
                " AND (
                    c.code_client LIKE '%$motCle%' 
                    OR c.raison_sociale LIKE '%$motCle%' 
                    OR a.code_postal LIKE '%$motCle%' 
                    OR a.ville LIKE '%$motCle%' 
                    OR a.pays LIKE '%$motCle%'
                )";
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

    public function getClientsByTypesSegmentAndMotCle($sm,$typesSegment,$motCle=null)
    {
        $idTypes = implode(',', $typesSegment);

        $query =   
            "SELECT c.id, c.code_client, c.raison_sociale, a.code_postal, a.ville, a.pays 
             FROM client AS c 
                LEFT JOIN adresse AS a 
                    ON a.ref_client = c.id 
             WHERE c.supprime = 0 AND ( a.adresse_principale = 1 OR a.adresse_principale IS NULL ) AND c.ref_type_segment IN ($idTypes)"
             // Très important de vérifier que l'adresse principale est nulle, sinon les clients n'ayant pas d'adresse principale n'apparaitront pas !!!
        ;

        if(!is_null($motCle))
        {
            $query.=
                " AND (c.code_client LIKE '%$motCle%' 
                  OR c.raison_sociale LIKE '%$motCle%' 
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

    /**
     * Permet d'afficher seulement les informations présentes sur l'écran de recherche Client (qui sont également les critères)
     * @author Ophélie
     * @param  ServiceLocator $sm
     * @param  array $critere 
     * @since  1.0
     * @return array
     */
    public function getClientsFromForms($sm,$codeClient='',$raisonSociale=null,$limit=100)
    {
        $sql=new Sql($sm->get('Zend\Db\Adapter\Adapter'));
        $select=$sql->select();
        $select ->columns(array('id','societe'=>new Expression("CONCAT(c.raison_sociale,' (',a.code_postal,' ',a.ville,', ',a.pays,')')")))
                ->from(array('c'=>'client'))
                ->join(
                        array('a'=>'adresse'),                  // nom de la table à joindre
                        'a.ref_client = c.id',                  // expression de jointure
                        array(),                                // colonnes que je souhaite réccupérer de la table de jointure
                        $select::JOIN_LEFT                      // type de jointure, ici jointure gauche externe afin d'afficher même les clients qui n'ont pas d'adresse principale
                )
                ->order('raison_sociale ASC')
                //->limit($limit)
        ;

        $where = new Where;

        if($codeClient!=='')
        {
            if($codeClient===null)
            {
               //var_dump($codeClient);die();
                $where->isNull('c.code_client')->and;
            }
            else
            {
                $where->equalTo('c.code_client',$codeClient)->and;
            }
        }
        if($raisonSociale!==null)
        {
            $where->equalTo('c.raison_sociale',$raisonSociale)->and;
        }

        $where
            // ->equalTo('c.supprime',0)
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

    public function getCodesClient($sm)
    {
        $query      = "SELECT DISTINCT(code_client) FROM client ORDER BY code_client ASC ";
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

    public function getSegmentsId($sm)
    {
        $id = $this->getId();

        if($id)
        {
            $query =   
                "SELECT ref_segment
                 FROM client_a_segment
                 WHERE ref_client = $id"
            ;
            $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
            $results = $statement->execute();

            if($results->isQueryResult())
            {
                $resultSet=new ResultSet;
                $resultSet->initialize($results);
                return $resultSet->toArray();
            }
        }

        return array();
    }

    public function getProduitsFinisId($sm)
    {
        $id = $this->getId();

        if($id)
        {
            $query =   
                "SELECT ref_produit_fini
                 FROM client_a_produit_fini
                 WHERE ref_client = $id"
            ;
            $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
            $results = $statement->execute();

            if($results->isQueryResult())
            {
                $resultSet=new ResultSet;
                $resultSet->initialize($results);
                return $resultSet->toArray();
            }
        }       

        return array();
    }

    // public function aSegments($sm)
    // {
    //     $id = $this->getId();
    //     if($id)
    //     {
    //         $query =   
    //             "SELECT COUNT(ref_client)
    //              FROM client_a_segment
    //              WHERE ref_client = $id"
    //         ;
    //         $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
    //         $results = $statement->execute();
    //         return (int)$results->getGeneratedValue();
    //     }       
    //     return 0;
    // }

    // public function aProduitsFinis($sm)
    // {
    //     $id = $this->getId();
    //     if($id)
    //     {
    //         $query =   
    //             "SELECT COUNT(ref_client)
    //              FROM client_a_produit_fini
    //              WHERE ref_client = $id"
    //         ;
    //         $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
    //         $results = $statement->execute();
    //         return (int)$results->getGeneratedValue();
    //     }       
    //     return 0;
    // }

}
