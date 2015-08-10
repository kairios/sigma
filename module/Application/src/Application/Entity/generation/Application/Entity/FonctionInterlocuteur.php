<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonctionInterlocuteur
 *
 * @ORM\Table(name="fonction_interlocuteur", uniqueConstraints={@ORM\UniqueConstraint(name="intitule_fonction", columns={"intitule_fonction"})})
 * @ORM\Entity
 */
class FonctionInterlocuteur
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
     * @ORM\Column(name="intitule_fonction", type="string", length=70, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleFonction;


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
     * Set intituleFonction
     *
     * @param string $intituleFonction
     * @return FonctionInterlocuteur
     */
    public function setIntituleFonction($intituleFonction)
    {
        $this->intituleFonction = $intituleFonction;
    
        return $this;
    }

    /**
     * Get intituleFonction
     *
     * @return string 
     */
    public function getIntituleFonction()
    {
        return $this->intituleFonction;
    }
}
