<?php

namespace Devis\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * Devis
 *
 * @ORM\Table(name="devis", indexes={@ORM\Index(name="fk_devis_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="ref_personnel", columns={"ref_personnel"})})
 * @ORM\Entity
 */
class Devis
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
     * @ORM\Column(name="code_devis", type="string", length=50, nullable=false)
     */
    private $codeDevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_devis", type="integer", nullable=false)
     */
    private $dateDevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version;

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float", precision=10, scale=0, nullable=false)
     */
    private $remise = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="frais_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $fraisPort = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, nullable=true)
     */
    private $delaisLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_validite_prix", type="string", length=50, nullable=false)
     */
    private $dureeValiditePrix;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_reglement", type="string", length=60, nullable=true)
     */
    private $conditionReglement;

    /**
     * @var float
     *
     * @ORM\Column(name="total_hors_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHorsPort = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_avec_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalAvecPort = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_envoi", type="integer", nullable=true)
     */
    private $dateEnvoi;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_signature", type="integer", nullable=true)
     */
    private $dateSignature;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var \Affaire\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    public function __construct($refAffaire = null)
    {
        $this->dateDevis = time();
        $this->refAffaire = $refAffaire;

        if(!is_null($refAffaire))
        {
            $this->refPersonnel = $refAffaire->getRefPersonnel();
            $this->fraisPort = $refAffaire->getFraisPort();
            $this->remise = $refAffaire->getRemise();

            $conditionReglement = $refAffaire->getRefConditionReglement();
            // var_dump($conditionReglement->getIntituleConditionReglement());die();
            if(!is_null($conditionReglement))
            {
                $this->conditionReglement = $conditionReglement->getIntituleConditionReglement();
            }
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codeDevis
     *
     * @param string $codeDevis
     * @return Devis
     */
    public function setCodeDevis($codeDevis)
    {
        $this->codeDevis = $codeDevis;
    
        return $this;
    }

    /**
     * Get codeDevis
     *
     * @return string 
     */
    public function getCodeDevis()
    {
        return $this->codeDevis;
    }

    /**
     * Set dateDevis
     *
     * @param \DateTime $dateDevis
     * @return Devis
     */
    public function setDateDevis($dateDevis)
    {
        $this->dateDevis = $dateDevis;
    
        return $this;
    }

    /**
     * Get dateDevis
     *
     * @return \DateTime 
     */
    public function getDateDevis()
    {
        return $this->dateDevis;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return Devis
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set remise
     *
     * @param float $remise
     * @return Devis
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;
    
        return $this;
    }

    /**
     * Get remise
     *
     * @return float 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set fraisPort
     *
     * @param float $fraisPort
     * @return Devis
     */
    public function setFraisPort($fraisPort)
    {
        $this->fraisPort = $fraisPort;
    
        return $this;
    }

    /**
     * Get fraisPort
     *
     * @return float 
     */
    public function getFraisPort()
    {
        return $this->fraisPort;
    }

    /**
     * Set delaisLivraison
     *
     * @param string $delaisLivraison
     * @return Devis
     */
    public function setDelaisLivraison($delaisLivraison)
    {
        $this->delaisLivraison = $delaisLivraison;
    
        return $this;
    }

    /**
     * Get delaisLivraison
     *
     * @return string 
     */
    public function getDelaisLivraison()
    {
        return $this->delaisLivraison;
    }

    /**
     * Set dureeValiditePrix
     *
     * @param string $dureeValiditePrix
     * @return Devis
     */
    public function setDureeValiditePrix($dureeValiditePrix)
    {
        $this->dureeValiditePrix = $dureeValiditePrix;
    
        return $this;
    }

    /**
     * Get dureeValiditePrix
     *
     * @return string 
     */
    public function getDureeValiditePrix()
    {
        return $this->dureeValiditePrix;
    }

    /**
     * Set conditionReglement
     *
     * @param string $conditionReglement
     * @return Devis
     */
    public function setConditionReglement($conditionReglement)
    {
        $this->conditionReglement = $conditionReglement;
    
        return $this;
    }

    /**
     * Get conditionReglement
     *
     * @return string 
     */
    public function getConditionReglement()
    {
        return $this->conditionReglement;
    }

    /**
     * Set totalHorsPort
     *
     * @param float $totalHorsPort
     * @return Devis
     */
    public function setTotalHorsPort($totalHorsPort)
    {
        $this->totalHorsPort = $totalHorsPort;
    
        return $this;
    }

    /**
     * Get totalHorsPort
     *
     * @return float 
     */
    public function getTotalHorsPort()
    {
        return $this->totalHorsPort;
    }

    /**
     * Set totalAvecPort
     *
     * @param float $totalAvecPort
     * @return Devis
     */
    public function setTotalAvecPort($totalAvecPort)
    {
        $this->totalAvecPort = $totalAvecPort;
    
        return $this;
    }

    /**
     * Get totalAvecPort
     *
     * @return float 
     */
    public function getTotalAvecPort()
    {
        return $this->totalAvecPort;
    }

    /**
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     * @return Devis
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;
    
        return $this;
    }

    /**
     * Get dateEnvoi
     *
     * @return \DateTime 
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    /**
     * Set dateSignature
     *
     * @param \DateTime $dateSignature
     * @return Devis
     */
    public function setDateSignature($dateSignature)
    {
        $this->dateSignature = $dateSignature;
    
        return $this;
    }

    /**
     * Get dateSignature
     *
     * @return \DateTime 
     */
    public function getDateSignature()
    {
        return $this->dateSignature;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return Devis
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;
    
        return $this;
    }

    /**
     * Get remarques
     *
     * @return string 
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set refPersonnel
     *
     * @param \Personnel\Entity\Personnel $refPersonnel
     * @return Devis
     */
    public function setRefPersonnel(\Personnel\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Personnel\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }

    /**
     * Set refAffaire
     *
     * @param \Affaire\Entity\Affaire $refAffaire
     * @return Devis
     */
    public function setRefAffaire(\Affaire\Entity\Affaire $refAffaire = null)
    {
        $this->refAffaire = $refAffaire;
    
        return $this;
    }

    /**
     * Get refAffaire
     *
     * @return \Affaire\Entity\Affaire 
     */
    public function getRefAffaire()
    {
        return $this->refAffaire;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        // $idCentre = $this->getRefCentreProfit();
        // if(!(empty($idCentre)))
        //     $idCentre=$idCentre->getId();

        // $idClient = $this->getRefClient();
        // if(!(empty($idClient)))
        //     $idClient=$idClient->getId();

        // $idInterlocuteur = $this->getRefInterlocuteur();
        // if(!(empty($idInterlocuteur)))
        //     $idInterlocuteur=$idInterlocuteur->getId();

        // $idPersonnel = $this->getRefPersonnel();
        // if(!(empty($idPersonnel)))
        //     $idPersonnel=$idPersonnel->getId();

        // $idEtat = $this->getRefEtatAffaire();
        // if(!(empty($idEtat)))
        //     $idEtat=$idEtat->getId();

        // $idConcurrent = $this->getRefConcurrent();
        // if(!(empty($idConcurrent)))
        //     $idConcurrent=$idConcurrent->getId();

        // $idDevis = $this->getRefDevisSigne();
        // if(!(empty($idDevis)))
        //     $idDevis=$idDevis->getId();

        // $idConditionReglement = $this->getRefConditionReglement();
        // if(!(empty($idConditionReglement)))
        //     $idConditionReglement=$idConditionReglement->getId();

        // // $idModeReglement = $this->getRefModeReglement();
        // // if(!(empty($idModeReglement)))
        // //     $idModeReglement=$idModeReglement->getId();

        // return array(
        //     'id_affaire'                =>  $this->getId(),
        //     'numero_auto'               =>  $this->getNumeroAuto(),
        //     'numero_affaire'            =>  $this->getNumeroAffaire(),
        //     'designation_affaire'       =>  $this->getDesignationAffaire(),
        //     'exercice'                  =>  $this->getExercice(),
        //     'demande_client'            =>  $this->getDemandeClient(),
        //     'remise'                    =>  $this->getRemise(),
        //     'frais_port'                =>  $this->getFraisPort(),
        //     'reference_commande_client' =>  $this->getReferenceCommandeClient(),
        //     'reference_demande_prix'    =>  $this->getReferenceDemandePrix(),
        //     'suivi_budget_actif'        =>  $this->getSuiviBudgetActif(),
        //     'date_debut'                =>  $this->getDateDebut(),
        //     'date_fin'                  =>  $this->getDateFin(),
        //     'raison_perte'              =>  $this->getRaisonPerte(),

        //     'ref_centre_profit'         =>  $idCentre,
        //     'ref_client'                =>  $idClient,
        //     'ref_interlocuteur'         =>  $idInterlocuteur,
        //     'ref_condition_reglement'   =>  $idConditionReglement,
        //     'ref_personnel'             =>  $idPersonnel,
        //     'ref_etat_affaire'          =>  $idEtat,
        //     'ref_concurrent'            =>  $idConcurrent,
        //     'ref_devis_signe'           =>  $idDevis
        // );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$sm=null,$em=null) 
    {
        $refAffaire                         = $em->getRepository('Affaire\Entity\Affaire')->find( (int)$data['ref_affaire'] );
        $refPersonnel                       = $em->getRepository('Personnel\Entity\Personnel')->find( (int)$data['ref_personnel'] );

        $affaire                            = (!empty($refAffaire)) ? $refAffaire : null;
        $personnel                          = (!empty($refPersonnel)) ? $refPersonnel : null;

        $dateDevis                          = $data['date_devis'];
        $version                            = (!empty($data['version'])) ? $data['version'] : $this->getVersionDevisMax($em,$affaire)+1;
        $codeDevis                          = (!empty($data['code_devis'])) ? $data['code_devis'].'-'.$version : null;
        $remise                             = (!empty($data['remise'])) ? $data['remise'] : 0;
        $fraisPort                          = (!empty($data['frais_port'])) ? $data['frais_port'] : 0;
        $delaisLivraison                    = (!empty($data['delais_livraison'])) ? $data['delais_livraison'] : null;
        $dureeValidite                      = (!empty($data['duree_validite_prix'])) ? $data['duree_validite_prix'] : null;
        $conditionReglement                 = (!empty($data['condition_reglement'])) ? $data['condition_reglement'] : null;
        $dateEnvoi                          = (!empty($data['date_envoi'])) ? intval($data['date_envoi']) : null;
        $dateSignature                      = (!empty($data['date_signature'])) ? intval($data['date_signature']) : null;
        $remarques                          = (!empty($data['remarques'])) ? intval($data['remarques']) : null;
        // $dateCreationModificationFiche      = time();


        $this->id = $data['id_devis'];
        $this->setDateDevis($dateDevis);
        // total_hors_port
        // total_avec_port
        $this->setCodeDevis($codeDevis);
        $this->setVersion($version);
        $this->setRemise($remise);
        $this->setFraisPort($fraisPort);
        $this->setDelaisLivraison($delaisLivraison);
        $this->setDureeValiditePrix($dureeValidite);
        $this->setConditionReglement($conditionReglement);
        $this->setDateEnvoi($dateEnvoi);
        $this->setDateSignature($dateSignature);
        $this->setRemarques($remarques);

        $this->setRefAffaire($affaire);
        $this->setRefPersonnel($personnel);

        // $this->setDateCreationModificationFiche($dateCreationModificationFiche);
    }

    public function createNumeroVersionAuto($em)
    {
        $query = $em->createQuery("SELECT MAX(d.version) as numero_auto FROM Devis\Entity\Devis d GROUP BY d.refAffaire");
        $numero = (int) $query->getSingleScalarResult() + 1; // retourne plusieurs résultat sous forme de tableau

        return $numero;
    }

    public function getVersionDevisMax($em, $affaire = null)
    {
        if(is_null($affaire))
        {
            return 0;
        }

        $query = $em->createQuery("SELECT MAX(d.version) as numero_auto FROM Devis\Entity\Devis d WHERE d.refAffaire = :refAffaire");
        $query->setParameter('refAffaire', $affaire);
        $numero = (int) $query->getSingleScalarResult()/* + 1*/; // retourne plusieurs résultat sous forme de tableau

        return $numero;
    }

    public function getRefLignesAffaire($sm)
    {
        $id = (int) $this->getId();
        $query =   
            "SELECT ref_ligne_affaire FROM ligne_devis
             WHERE ref_devis = $id "
        ;

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

    public function getLignesDevis($sm)
    {
        $id = (int) $this->getId();
        $query =   
            "SELECT * FROM ligne_devis
             WHERE ref_devis = $id "
        ;

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

    public function removeLigneDevis($sm, $idLigne = null)
    {
        $id = (int) $this->getId();
        $query =   
            "DELETE FROM ligne_devis
             WHERE ref_devis = $id "
        ;

        if(!is_null($idLigne))
        {
            $query .= " AND id = $idLigne ";
        }

        $statement  = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        return $statement->execute();

        // if($results->isQueryResult())
        // {
        //     $resultSet=new ResultSet;
        //     $resultSet->initialize($results);
        //     return $resultSet->toArray();
        // }

        // return array();
    }
}
