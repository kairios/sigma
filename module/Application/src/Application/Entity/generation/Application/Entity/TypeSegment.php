<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeSegment
 *
 * @ORM\Table(name="type_segment")
 * @ORM\Entity
 */
class TypeSegment
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
     * @ORM\Column(name="intitule_type_segment", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleTypeSegment;


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
     * Set intituleTypeSegment
     *
     * @param string $intituleTypeSegment
     * @return TypeSegment
     */
    public function setIntituleTypeSegment($intituleTypeSegment)
    {
        $this->intituleTypeSegment = $intituleTypeSegment;
    
        return $this;
    }

    /**
     * Get intituleTypeSegment
     *
     * @return string 
     */
    public function getIntituleTypeSegment()
    {
        return $this->intituleTypeSegment;
    }
}
