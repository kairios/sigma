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
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_poste", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intitulePoste;

    /**
     * @var \Affaire\Entity\CategoriePoste
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\CategoriePoste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_categorie", referencedColumnName="id", nullable=true)
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
    public function setRefCategorie(\Affaire\Entity\CategoriePoste $refCategorie = null)
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
