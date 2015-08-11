<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * Affaire
 *
 * @ORM\Table(name="affaire", indexes={@ORM\Index(name="fk_affaire_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_affaire_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_affaire_tbl_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_affaire_centre_de_profit1_idx", columns={"ref_centre_profit"}), @ORM\Index(name="fk_affaire_condition_reglement1_idx", columns={"ref_condition_reglement"}), @ORM\Index(name="ref_concurrent", columns={"ref_concurrent"}), @ORM\Index(name="ref_devis_signe", columns={"ref_devis_signe"})})
 * @ORM\Entity
 */
class Affaire
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
     * @ORM\Column(name="numero_affaire", type="string", length=30, nullable=false)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="designation_affaire", type="string", length=150, nullable=true)
     */
    private $designationAffaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="exercice", type="integer", nullable=false)
     */
    private $exercice;

    /**
     * @var string
     *
     * @ORM\Column(name="demande_client", type="text", nullable=true)
     */
    private $demandeClient;

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
     * @ORM\Column(name="reference_commande_client", type="string", length=70, nullable=true)
     */
    private $referenceCommandeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_demande_prix", type="string", length=50, nullable=true)
     */
    private $referenceDemandePrix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suivi_budget_actif", type="boolean", nullable=false)
     */
    private $suiviBudgetActif = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_affaire", type="string", length=30, nullable=false)
     */
    private $etatAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_perte", type="string", length=150, nullable=true)
     */
    private $raisonPerte;

    /**
     * @var \Client\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;

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
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_concurrent", referencedColumnName="id")
     * })
     */
    private $refConcurrent;

    /**
     * @var \Devis\Entity\Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis\Entity\Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_devis_signe", referencedColumnName="id")
     * })
     */
    private $refDevisSigne;

    /**
     * @var \Affaire\Entity\CentreDeProfit
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\CentreDeProfit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_centre_profit", referencedColumnName="id")
     * })
     */
    private $refCentreProfit;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;

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
     * Set numeroAffaire
     *
     * @param string $numeroAffaire
     * @return Affaire
     */
    public function setNumeroAffaire($numeroAffaire)
    {
        $this->numeroAffaire = $numeroAffaire;
    
        return $this;
    }

    /**
     * Get numeroAffaire
     *
     * @return string 
     */
    public function getNumeroAffaire()
    {
        return $this->numeroAffaire;
    }

    /**
     * Set designationAffaire
     *
     * @param string $designationAffaire
     * @return Affaire
     */
    public function setDesignationAffaire($designationAffaire)
    {
        $this->designationAffaire = $designationAffaire;
    
        return $this;
    }

    /**
     * Get designationAffaire
     *
     * @return string 
     */
    public function getDesignationAffaire()
    {
        return $this->designationAffaire;
    }

    /**
     * Set exercice
     *
     * @param integer $exercice
     * @return Affaire
     */
    public function setExercice($exercice)
    {
        $this->exercice = $exercice;
    
        return $this;
    }

    /**
     * Get exercice
     *
     * @return integer 
     */
    public function getExercice()
    {
        return $this->exercice;
    }

    /**
     * Set demandeClient
     *
     * @param string $demandeClient
     * @return Affaire
     */
    public function setDemandeClient($demandeClient)
    {
        $this->demandeClient = $demandeClient;
    
        return $this;
    }

    /**
     * Get demandeClient
     *
     * @return string 
     */
    public function getDemandeClient()
    {
        return $this->demandeClient;
    }

    /**
     * Set remise
     *
     * @param float $remise
     * @return Affaire
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
     * @return Affaire
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
     * Set referenceCommandeClient
     *
     * @param string $referenceCommandeClient
     * @return Affaire
     */
    public function setReferenceCommandeClient($referenceCommandeClient)
    {
        $this->referenceCommandeClient = $referenceCommandeClient;
    
        return $this;
    }

    /**
     * Get referenceCommandeClient
     *
     * @return string 
     */
    public function getReferenceCommandeClient()
    {
        return $this->referenceCommandeClient;
    }

    /**
     * Set referenceDemandePrix
     *
     * @param string $referenceDemandePrix
     * @return Affaire
     */
    public function setReferenceDemandePrix($referenceDemandePrix)
    {
        $this->referenceDemandePrix = $referenceDemandePrix;
    
        return $this;
    }

    /**
     * Get referenceDemandePrix
     *
     * @return string 
     */
    public function getReferenceDemandePrix()
    {
        return $this->referenceDemandePrix;
    }

    /**
     * Set suiviBudgetActif
     *
     * @param boolean $suiviBudgetActif
     * @return Affaire
     */
    public function setSuiviBudgetActif($suiviBudgetActif)
    {
        $this->suiviBudgetActif = $suiviBudgetActif;
    
        return $this;
    }

    /**
     * Get suiviBudgetActif
     *
     * @return boolean 
     */
    public function getSuiviBudgetActif()
    {
        return $this->suiviBudgetActif;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Affaire
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Affaire
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set etatAffaire
     *
     * @param string $etatAffaire
     * @return Affaire
     */
    public function setEtatAffaire($etatAffaire)
    {
        $this->etatAffaire = $etatAffaire;
    
        return $this;
    }

    /**
     * Get etatAffaire
     *
     * @return string 
     */
    public function getEtatAffaire()
    {
        return $this->etatAffaire;
    }

    /**
     * Set raisonPerte
     *
     * @param string $raisonPerte
     * @return Affaire
     */
    public function setRaisonPerte($raisonPerte)
    {
        $this->raisonPerte = $raisonPerte;
    
        return $this;
    }

    /**
     * Get raisonPerte
     *
     * @return string 
     */
    public function getRaisonPerte()
    {
        return $this->raisonPerte;
    }

    /**
     * Set refInterlocuteur
     *
     * @param \Client\Entity\InterlocuteurClient $refInterlocuteur
     * @return Affaire
     */
    public function setRefInterlocuteur(\Client\Entity\InterlocuteurClient $refInterlocuteur = null)
    {
        $this->refInterlocuteur = $refInterlocuteur;
    
        return $this;
    }

    /**
     * Get refInterlocuteur
     *
     * @return \Client\Entity\InterlocuteurClient 
     */
    public function getRefInterlocuteur()
    {
        return $this->refInterlocuteur;
    }

    /**
     * Set refPersonnel
     *
     * @param \Personnel\Entity\Personnel $refPersonnel
     * @return Affaire
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
     * Set refConditionReglement
     *
     * @param \Application\Entity\ConditionReglement $refConditionReglement
     * @return Affaire
     */
    public function setRefConditionReglement(\Application\Entity\ConditionReglement $refConditionReglement = null)
    {
        $this->refConditionReglement = $refConditionReglement;
    
        return $this;
    }

    /**
     * Get refConditionReglement
     *
     * @return \Application\Entity\ConditionReglement 
     */
    public function getRefConditionReglement()
    {
        return $this->refConditionReglement;
    }

    /**
     * Set refConcurrent
     *
     * @param \Fournisseur\Entity\Fournisseur $refConcurrent
     * @return Affaire
     */
    public function setRefConcurrent(\Fournisseur\Entity\Fournisseur $refConcurrent = null)
    {
        $this->refConcurrent = $refConcurrent;
    
        return $this;
    }

    /**
     * Get refConcurrent
     *
     * @return \Fournisseur\Entity\Fournisseur 
     */
    public function getRefConcurrent()
    {
        return $this->refConcurrent;
    }

    /**
     * Set refDevisSigne
     *
     * @param \Devis\Entity\Devis $refDevisSigne
     * @return Affaire
     */
    public function setRefDevisSigne(\Devis\Entity\Devis $refDevisSigne = null)
    {
        $this->refDevisSigne = $refDevisSigne;
    
        return $this;
    }

    /**
     * Get refDevisSigne
     *
     * @return \Devis\Entity\Devis 
     */
    public function getRefDevisSigne()
    {
        return $this->refDevisSigne;
    }

    /**
     * Set refCentreProfit
     *
     * @param \Affaire\Entity\CentreDeProfit $refCentreProfit
     * @return Affaire
     */
    public function setRefCentreProfit(\Affaire\Entity\CentreDeProfit $refCentreProfit = null)
    {
        $this->refCentreProfit = $refCentreProfit;
    
        return $this;
    }

    /**
     * Get refCentreProfit
     *
     * @return \Affaire\Entity\CentreDeProfit 
     */
    public function getRefCentreProfit()
    {
        return $this->refCentreProfit;
    }

    /**
     * Set refClient
     *
     * @param \Client\Entity\Client $refClient
     * @return Affaire
     */
    public function setRefClient(\Client\Entity\Client $refClient = null)
    {
        $this->refClient = $refClient;
    
        return $this;
    }

    /**
     * Get refClient
     *
     * @return \Client\Entity\Client 
     */
    public function getRefClient()
    {
        return $this->refClient;
    }

    public function getNumerosAffaire($sm)
    {
        $query      = "SELECT id,numero_affaire FROM affaire ORDER BY numero_affaire ASC ";
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

?>