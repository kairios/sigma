<?php

namespace Application\Entity;

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
     * @var \Application\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TypeSegment")
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
     * @param \Application\Entity\TypeSegment $refTypeSegment
     * @return Segment
     */
    public function setRefTypeSegment(\Application\Entity\TypeSegment $refTypeSegment = null)
    {
        $this->refTypeSegment = $refTypeSegment;
    
        return $this;
    }

    /**
     * Get refTypeSegment
     *
     * @return \Application\Entity\TypeSegment 
     */
    public function getRefTypeSegment()
    {
        return $this->refTypeSegment;
    }
}
