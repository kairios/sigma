<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Segment
 *
 * @ORM\Table(name="segment", indexes={@ORM\Index(name="fk_segment_type_segment1_idx", columns={"ref_type_segment"})})
 * @ORM\Entity
 */
class Segment
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
     * @ORM\Column(name="intitule_segment", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleSegment;

    /**
     * @var \Client\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\TypeSegment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id", nullable=true)
     * })
     */
    private $refTypeSegment;


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
     * Set intituleSegment
     *
     * @param string $intituleSegment
     * @return Segment
     */
    public function setIntituleSegment($intituleSegment)
    {
        $this->intituleSegment = $intituleSegment;
    
        return $this;
    }

    /**
     * Get intituleSegment
     *
     * @return string 
     */
    public function getIntituleSegment()
    {
        return $this->intituleSegment;
    }

    /**
     * Set refTypeSegment
     *
     * @param \Client\Entity\TypeSegment $refTypeSegment
     * @return Segment
     */
    public function setRefTypeSegment(\Client\Entity\TypeSegment $refTypeSegment = null)
    {
        $this->refTypeSegment = $refTypeSegment;
    
        return $this;
    }

    /**
     * Get refTypeSegment
     *
     * @return \Client\Entity\TypeSegment 
     */
    public function getRefTypeSegment()
    {
        return $this->refTypeSegment;
    }
}
