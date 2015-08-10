<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFini
 *
 * @ORM\Table(name="produit_fini", indexes={@ORM\Index(name="ref_segment", columns={"ref_segment"})})
 * @ORM\Entity
 */
class ProduitFini
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
     * @ORM\Column(name="intitule_produit_fini", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleProduitFini;

    /**
     * @var \Client\Entity\Segment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_segment", referencedColumnName="id", nullable=true)
     * })
     */
    private $refSegment;


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
     * Set intituleProduitFini
     *
     * @param string $intituleProduitFini
     * @return ProduitFini
     */
    public function setIntituleProduitFini($intituleProduitFini)
    {
        $this->intituleProduitFini = $intituleProduitFini;
    
        return $this;
    }

    /**
     * Get intituleProduitFini
     *
     * @return string 
     */
    public function getIntituleProduitFini()
    {
        return $this->intituleProduitFini;
    }

    /**
     * Set refSegment
     *
     * @param \Client\Entity\Segment $refSegment
     * @return ProduitFini
     */
    public function setRefSegment(\Client\Entity\Segment $refSegment = null)
    {
        $this->refSegment = $refSegment;
    
        return $this;
    }

    /**
     * Get refSegment
     *
     * @return \Client\Entity\Segment 
     */
    public function getRefSegment()
    {
        return $this->refSegment;
    }
}
