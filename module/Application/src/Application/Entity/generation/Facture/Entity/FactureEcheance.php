<?php

namespace Facture\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureEcheance
 *
 * @ORM\Table(name="facture_echeance", indexes={@ORM\Index(name="ref_facture", columns={"ref_facture"}), @ORM\Index(name="ref_condition_reglement", columns={"ref_condition_reglement"}), @ORM\Index(name="ref_mode_reglement", columns={"ref_mode_reglement"})})
 * @ORM\Entity
 */
class FactureEcheance
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
     * @var integer
     *
     * @ORM\Column(name="pourcentage", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $pourcentage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reglement_prevu", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateReglementPrevu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reglement", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateReglement;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ht", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $totalHt;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ttc", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $totalTtc;

    /**
     * @var \Facture\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id", nullable=true)
     * })
     */
    private $refFacture;

    /**
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id", nullable=true)
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Application\Entity\ModeReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ModeReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_mode_reglement", referencedColumnName="id", nullable=true)
     * })
     */
    private $refModeReglement;


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
     * Set pourcentage
     *
     * @param integer $pourcentage
     * @return FactureEcheance
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    
        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return integer 
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * Set dateReglementPrevu
     *
     * @param \DateTime $dateReglementPrevu
     * @return FactureEcheance
     */
    public function setDateReglementPrevu($dateReglementPrevu)
    {
        $this->dateReglementPrevu = $dateReglementPrevu;
    
        return $this;
    }

    /**
     * Get dateReglementPrevu
     *
     * @return \DateTime 
     */
    public function getDateReglementPrevu()
    {
        return $this->dateReglementPrevu;
    }

    /**
     * Set dateReglement
     *
     * @param \DateTime $dateReglement
     * @return FactureEcheance
     */
    public function setDateReglement($dateReglement)
    {
        $this->dateReglement = $dateReglement;
    
        return $this;
    }

    /**
     * Get dateReglement
     *
     * @return \DateTime 
     */
    public function getDateReglement()
    {
        return $this->dateReglement;
    }

    /**
     * Set totalHt
     *
     * @param float $totalHt
     * @return FactureEcheance
     */
    public function setTotalHt($totalHt)
    {
        $this->totalHt = $totalHt;
    
        return $this;
    }

    /**
     * Get totalHt
     *
     * @return float 
     */
    public function getTotalHt()
    {
        return $this->totalHt;
    }

    /**
     * Set totalTtc
     *
     * @param float $totalTtc
     * @return FactureEcheance
     */
    public function setTotalTtc($totalTtc)
    {
        $this->totalTtc = $totalTtc;
    
        return $this;
    }

    /**
     * Get totalTtc
     *
     * @return float 
     */
    public function getTotalTtc()
    {
        return $this->totalTtc;
    }

    /**
     * Set refFacture
     *
     * @param \Facture\Entity\Facture $refFacture
     * @return FactureEcheance
     */
    public function setRefFacture(\Facture\Entity\Facture $refFacture = null)
    {
        $this->refFacture = $refFacture;
    
        return $this;
    }

    /**
     * Get refFacture
     *
     * @return \Facture\Entity\Facture 
     */
    public function getRefFacture()
    {
        return $this->refFacture;
    }

    /**
     * Set refConditionReglement
     *
     * @param \Application\Entity\ConditionReglement $refConditionReglement
     * @return FactureEcheance
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
     * Set refModeReglement
     *
     * @param \Application\Entity\ModeReglement $refModeReglement
     * @return FactureEcheance
     */
    public function setRefModeReglement(\Application\Entity\ModeReglement $refModeReglement = null)
    {
        $this->refModeReglement = $refModeReglement;
    
        return $this;
    }

    /**
     * Get refModeReglement
     *
     * @return \Application\Entity\ModeReglement 
     */
    public function getRefModeReglement()
    {
        return $this->refModeReglement;
    }
}
