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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_activite", type="string", length=50, nullable=false)
     */
    private $intituleActivite;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIntituleActivite()
    {
        return $this->intituleActivite;
    }

    public function setIntituleActivite($intituleActivite)
    {
        $this->intituleActivite = $intituleActivite;
    }
}
