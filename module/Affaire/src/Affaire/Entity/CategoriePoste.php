<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriePoste
 *
 * @ORM\Table(name="categorie_poste")
 * @ORM\Entity
 */
class CategoriePoste
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
     * @ORM\Column(name="intitule_categorie", type="string", length=80, nullable=false)
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
     * @return CategoriePoste
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

?>