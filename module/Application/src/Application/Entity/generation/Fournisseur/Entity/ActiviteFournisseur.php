<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActiviteFournisseur
 *
 * @ORM\Table(name="activite_fournisseur", uniqueConstraints={@ORM\UniqueConstraint(name="intitule_activite", columns={"intitule_activite"})})
 * @ORM\Entity
 */
class ActiviteFournisseur
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
     * @ORM\Column(name="intitule_activite", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleActivite;


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
     * Set intituleActivite
     *
     * @param string $intituleActivite
     * @return ActiviteFournisseur
     */
    public function setIntituleActivite($intituleActivite)
    {
        $this->intituleActivite = $intituleActivite;
    
        return $this;
    }

    /**
     * Get intituleActivite
     *
     * @return string 
     */
    public function getIntituleActivite()
    {
        return $this->intituleActivite;
    }
}
