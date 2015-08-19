<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metier
 *
 * @ORM\Table(name="metier", indexes={@ORM\Index(name="ref_poste", columns={"ref_poste"})})
 * @ORM\Entity
 */
class Metier
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
     * @ORM\Column(name="intitule_metier", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleMetier;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_horaire", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $prixHoraire;

    /**
     * @var \Application\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPoste;


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
     * Set intituleMetier
     *
     * @param string $intituleMetier
     * @return Metier
     */
    public function setIntituleMetier($intituleMetier)
    {
        $this->intituleMetier = $intituleMetier;
    
        return $this;
    }

    /**
     * Get intituleMetier
     *
     * @return string 
     */
    public function getIntituleMetier()
    {
        return $this->intituleMetier;
    }

    /**
     * Set prixHoraire
     *
     * @param integer $prixHoraire
     * @return Metier
     */
    public function setPrixHoraire($prixHoraire)
    {
        $this->prixHoraire = $prixHoraire;
    
        return $this;
    }

    /**
     * Get prixHoraire
     *
     * @return integer 
     */
    public function getPrixHoraire()
    {
        return $this->prixHoraire;
    }

    /**
     * Set refPoste
     *
     * @param \Application\Entity\PosteCout $refPoste
     * @return Metier
     */
    public function setRefPoste(\Application\Entity\PosteCout $refPoste = null)
    {
        $this->refPoste = $refPoste;
    
        return $this;
    }

    /**
     * Get refPoste
     *
     * @return \Application\Entity\PosteCout 
     */
    public function getRefPoste()
    {
        return $this->refPoste;
    }
}
