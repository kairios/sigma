<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosteCout
 *
 * @ORM\Table(name="poste_cout", indexes={@ORM\Index(name="ref_categorie", columns={"ref_categorie"})})
 * @ORM\Entity
 */
class PosteCout
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
     * @ORM\Column(name="intitule_poste", type="string", length=80, nullable=false)
     */
    private $intitulePoste;

    /**
     * @var \CategoriePoste
     *
     * @ORM\ManyToOne(targetEntity="CategoriePoste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_categorie", referencedColumnName="id")
     * })
     */
    private $refCategorie;

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
     * Set intitulePoste
     *
     * @param string $intitulePoste
     * @return PosteCout
     */
    public function setIntitulePoste($intitulePoste)
    {
        $this->intitulePoste = $intitulePoste;
    
        return $this;
    }

    /**
     * Get intitulePoste
     *
     * @return string 
     */
    public function getIntitulePoste()
    {
        return $this->intitulePoste;
    }
    
    /**
     * Set refCategorie
     *
     * @param \Affaire\Entity\CategoriePoste $refCategorie
     * @return PosteCout
     */
    public function setRefCategorie($refCategorie)
    {
        $this->refCategorie = $refCategorie;
    
        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Affaire\Entity\CategoriePoste 
     */
    public function getRefCategorie()
    {
        return $this->refCategorie;
    }
}

?>