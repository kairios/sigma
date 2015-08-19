<?php

namespace Produit\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
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
     * @ORM\Column(name="code_produit", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codeProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Application\Entity\Traduction
     *
     * @ORM\OneToOne(targetEntity="Application\Entity\Traduction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_intitule_produit", referencedColumnName="id", unique=true, nullable=true)
     * })
     */
    private $refIntituleProduit;


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
     * Set codeProduit
     *
     * @param string $codeProduit
     * @return Produit
     */
    public function setCodeProduit($codeProduit)
    {
        $this->codeProduit = $codeProduit;
    
        return $this;
    }

    /**
     * Get codeProduit
     *
     * @return string 
     */
    public function getCodeProduit()
    {
        return $this->codeProduit;
    }

    /**
     * Set dateCreationModificationFiche
     *
     * @param integer $dateCreationModificationFiche
     * @return Produit
     */
    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {
        $this->dateCreationModificationFiche = $dateCreationModificationFiche;
    
        return $this;
    }

    /**
     * Get dateCreationModificationFiche
     *
     * @return integer 
     */
    public function getDateCreationModificationFiche()
    {
        return $this->dateCreationModificationFiche;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return Produit
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;
    
        return $this;
    }

    /**
     * Get remarques
     *
     * @return string 
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set refIntituleProduit
     *
     * @param \Application\Entity\Traduction $refIntituleProduit
     * @return Produit
     */
    public function setRefIntituleProduit(\Application\Entity\Traduction $refIntituleProduit = null)
    {
        $this->refIntituleProduit = $refIntituleProduit;
    
        return $this;
    }

    /**
     * Get refIntituleProduit
     *
     * @return \Application\Entity\Traduction 
     */
    public function getRefIntituleProduit()
    {
        return $this->refIntituleProduit;
    }
}
