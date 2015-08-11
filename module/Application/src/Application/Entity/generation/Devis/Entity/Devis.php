<?php

namespace Devis\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_devis", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codeDevis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_devis", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateDevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $version;

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $remise;

    /**
     * @var float
     *
     * @ORM\Column(name="frais_port", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $fraisPort;

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $delaisLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_validite_prix", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dureeValiditePrix;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_reglement", type="string", length=60, precision=0, scale=0, nullable=true, unique=false)
     */
    private $conditionReglement;

    /**
     * @var float
     *
     * @ORM\Column(name="total_hors_port", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $totalHorsPort;

    /**
     * @var float
     *
     * @ORM\Column(name="total_avec_port", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $totalAvecPort;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateEnvoi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_signature", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateSignature;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Devis\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Devis\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPersonnel;

    /**
     * @var \Devis\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Devis\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAffaire;


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
     * @param \Devis\Entity\Personnel $refPersonnel
     * @return Devis
     */
    public function setRefPersonnel(\Devis\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Devis\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }

    /**
     * Set refAffaire
     *
     * @param \Devis\Entity\Affaire $refAffaire
     * @return Devis
     */
    public function setRefAffaire(\Devis\Entity\Affaire $refAffaire = null)
    {
        $this->refAffaire = $refAffaire;
    
        return $this;
    }

    /**
     * Get refAffaire
     *
     * @return \Devis\Entity\Affaire 
     */
    public function getRefAffaire()
    {
        return $this->refAffaire;
    }
}
