<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatAffaire
 *
 * @ORM\Table(name="etat_affaire")
 * @ORM\Entity
 */
class EtatAffaire
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
     * @ORM\Column(name="intitule_etat", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleEtat;


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
     * Set intituleEtat
     *
     * @param string $intituleEtat
     * @return EtatAffaire
     */
    public function setIntituleEtat($intituleEtat)
    {
        $this->intituleEtat = $intituleEtat;
    
        return $this;
    }

    /**
     * Get intituleEtat
     *
     * @return string 
     */
    public function getIntituleEtat()
    {
        return $this->intituleEtat;
    }
}
