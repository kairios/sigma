<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConditionReglement
 *
 * @ORM\Table(name="condition_reglement")
 * @ORM\Entity
 */
class ConditionReglement
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
     * @ORM\Column(name="intitule_condition_reglement", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleConditionReglement;


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
     * Set intituleConditionReglement
     *
     * @param string $intituleConditionReglement
     * @return ConditionReglement
     */
    public function setIntituleConditionReglement($intituleConditionReglement)
    {
        $this->intituleConditionReglement = $intituleConditionReglement;
    
        return $this;
    }

    /**
     * Get intituleConditionReglement
     *
     * @return string 
     */
    public function getIntituleConditionReglement()
    {
        return $this->intituleConditionReglement;
    }
}
