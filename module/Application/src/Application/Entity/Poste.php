<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 *
 * @ORM\Table(name="poste")
 * @ORM\Entity
 */
class Poste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    // *
    //  * @var integer
    //  *
    //  * @ORM\Column(name="ref_intitule_poste", type="integer", nullable=false)
     
    // private $refIntitulePoste;
    // uniqueConstraints={@ORM\UniqueConstraint(name="ref_intitule_poste", columns={"ref_intitule_poste"})}

    /**
     * @var  string
     *
     * @ORM\Column(name="intitule_poste", type="string", length=80, nullable=false)
     */
    private $intitulePoste;

    // private $metiers;
    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIntitulePoste()
    {
        return $this->intitulePoste;
    }

    public function setIntitulePoste($intitulePoste)
    {
        $this->intitulePoste = $intitulePoste;
    }

}
