<?php

namespace Produit\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="fk_produit_translation1_idx", columns={"ref_intitule"}), @ORM\Index(name="fk_produit_segment", columns={"ref_segment"})})
 * @ORM\Entity
 */
class Produit
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
     * @ORM\Column(name="code_produit", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codeProduit;

    /**
     * @var \Application\Entity\Segment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_segment", referencedColumnName="id", nullable=true)
     * })
     */
    private $refSegment;

    /**
     * @var \Application\Entity\Traduction
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Traduction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_intitule", referencedColumnName="id", nullable=true)
     * })
     */
    private $refIntitule;


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
     * Set codeProduit
     *
     * @param string $codeProduit
     * @return Produit
     */
    public function setCodeProduit($codeProduit)
    {
        $this->codeProduit = $codeProduit;
    
        return $this;
    }

    /**
     * Get codeProduit
     *
     * @return string 
     */
    public function getCodeProduit()
    {
        return $this->codeProduit;
    }

    /**
     * Set refSegment
     *
     * @param \Application\Entity\Segment $refSegment
     * @return Produit
     */
    public function setRefSegment(\Application\Entity\Segment $refSegment = null)
    {
        $this->refSegment = $refSegment;
    
        return $this;
    }

    /**
     * Get refSegment
     *
     * @return \Application\Entity\Segment 
     */
    public function getRefSegment()
    {
        return $this->refSegment;
    }

    /**
     * Set refIntitule
     *
     * @param \Application\Entity\Traduction $refIntitule
     * @return Produit
     */
    public function setRefIntitule(\Application\Entity\Traduction $refIntitule = null)
    {
        $this->refIntitule = $refIntitule;
    
        return $this;
    }

    /**
     * Get refIntitule
     *
     * @return \Application\Entity\Traduction 
     */
    public function getRefIntitule()
    {
        return $this->refIntitule;
    }
}
