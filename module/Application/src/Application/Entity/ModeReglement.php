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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_mode_reglement", type="string", length=300, nullable=false)
     */
    private $intituleModeReglement;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getIntituleModeReglement()
    {
        return $this->intituleModeReglement;
    }

    public function setIntituleModeReglement($intituleModeReglement)
    {
        $this->intituleModeReglement=$intituleModeReglement;
    }
}
