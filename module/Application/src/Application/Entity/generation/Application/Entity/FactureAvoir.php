<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureAvoir
 *
 * @ORM\Table(name="facture_avoir", indexes={@ORM\Index(name="fk_avoir_facture1_idx", columns={"ref_facture"})})
 * @ORM\Entity
 */
class FactureAvoir
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
     * @ORM\Column(name="ref_facture", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $refFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_avoir", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $numeroAvoir;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_avoir", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateAvoir;

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
     * @var boolean
     *
     * @ORM\Column(name="envoyee", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $envoyee;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;


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
     * Set refFacture
     *
     * @param integer $refFacture
     * @return FactureAvoir
     */
    public function setRefFacture($refFacture)
    {
        $this->refFacture = $refFacture;
    
        return $this;
    }

    /**
     * Get refFacture
     *
     * @return integer 
     */
    public function getRefFacture()
    {
        return $this->refFacture;
    }

    /**
     * Set numeroAvoir
     *
     * @param string $numeroAvoir
     * @return FactureAvoir
     */
    public function setNumeroAvoir($numeroAvoir)
    {
        $this->numeroAvoir = $numeroAvoir;
    
        return $this;
    }

    /**
     * Get numeroAvoir
     *
     * @return string 
     */
    public function getNumeroAvoir()
    {
        return $this->numeroAvoir;
    }

    /**
     * Set dateAvoir
     *
     * @param \DateTime $dateAvoir
     * @return FactureAvoir
     */
    public function setDateAvoir($dateAvoir)
    {
        $this->dateAvoir = $dateAvoir;
    
        return $this;
    }

    /**
     * Get dateAvoir
     *
     * @return \DateTime 
     */
    public function getDateAvoir()
    {
        return $this->dateAvoir;
    }

    /**
     * Set totalHt
     *
     * @param float $totalHt
     * @return FactureAvoir
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
     * @return FactureAvoir
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
     * Set envoyee
     *
     * @param boolean $envoyee
     * @return FactureAvoir
     */
    public function setEnvoyee($envoyee)
    {
        $this->envoyee = $envoyee;
    
        return $this;
    }

    /**
     * Get envoyee
     *
     * @return boolean 
     */
    public function getEnvoyee()
    {
        return $this->envoyee;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return FactureAvoir
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
}
