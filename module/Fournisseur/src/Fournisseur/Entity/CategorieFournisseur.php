<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieFournisseur
 *
 * @ORM\Table(name="categorie_fournisseur", uniqueConstraints={@ORM\UniqueConstraint(name="intitule_categorie_fournisseur", columns={"intitule_categorie_fournisseur"})})
 * @ORM\Entity
 */
class CategorieFournisseur
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
     * @ORM\Column(name="intitule_categorie", type="string", length=50, nullable=false)
     */
    private $intituleCategorie;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIntituleCategorie()
    {
        return $this->intituleCategorie;
    }

    public function setIntituleCategorie($intituleCategorie)
    {
        $this->intituleCategorie = $intituleCategorie;
    }
}
