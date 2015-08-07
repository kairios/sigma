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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_condition_reglement", type="string", length=300, nullable=false)
     */
    private $intituleConditionReglement;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getIntituleConditionReglement()
    {
        return $this->intituleConditionReglement;
    }

    public function setIntituleConditionReglement($intituleConditionReglement)
    {
        $this->intituleConditionReglement=$intituleConditionReglement;
    }
}
