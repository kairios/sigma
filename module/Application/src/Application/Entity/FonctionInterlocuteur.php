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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_fonction", type="string", length=70, nullable=false)
     */
    private $intituleFonction;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getIntituleFonction()
    {
        return $this->intituleFonction;
    }

    public function setIntituleFonction($intituleFonction)
    {
        $this->intituleFonction=$intituleFonction;
    }


}
