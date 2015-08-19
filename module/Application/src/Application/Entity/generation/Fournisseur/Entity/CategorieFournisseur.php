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
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_categorie", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleCategorie;


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
     * Set intituleCategorie
     *
     * @param string $intituleCategorie
     * @return CategorieFournisseur
     */
    public function setIntituleCategorie($intituleCategorie)
    {
        $this->intituleCategorie = $intituleCategorie;
    
        return $this;
    }

    /**
     * Get intituleCategorie
     *
     * @return string 
     */
    public function getIntituleCategorie()
    {
        return $this->intituleCategorie;
    }
}
