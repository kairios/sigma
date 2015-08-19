<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModeReglement
 *
 * @ORM\Table(name="mode_reglement")
 * @ORM\Entity
 */
class ModeReglement
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
     * @ORM\Column(name="intitule_mode_reglement", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleModeReglement;


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
     * Set intituleModeReglement
     *
     * @param string $intituleModeReglement
     * @return ModeReglement
     */
    public function setIntituleModeReglement($intituleModeReglement)
    {
        $this->intituleModeReglement = $intituleModeReglement;
    
        return $this;
    }

    /**
     * Get intituleModeReglement
     *
     * @return string 
     */
    public function getIntituleModeReglement()
    {
        return $this->intituleModeReglement;
    }
}
