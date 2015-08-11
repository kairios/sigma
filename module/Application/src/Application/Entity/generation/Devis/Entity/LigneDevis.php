<?php

namespace Devis\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneDevis
 *
 * @ORM\Table(name="ligne_devis", indexes={@ORM\Index(name="fk_ligne_devis_devis1_idx", columns={"ref_devis"})})
 * @ORM\Entity
 */
class LigneDevis
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
     * @ORM\Column(name="code_produit", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $codeProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_produit", type="string", length=120, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixVente;

    /**
     * @var float
     *
     * @ORM\Column(name="total_prix_vente", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $totalPrixVente;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Devis\Entity\Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis\Entity\Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_devis", referencedColumnName="id", nullable=true)
     * })
     */
    private $refDevis;


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
     * @return LigneDevis
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
     * Set intituleProduit
     *
     * @param string $intituleProduit
     * @return LigneDevis
     */
    public function setIntituleProduit($intituleProduit)
    {
        $this->intituleProduit = $intituleProduit;
    
        return $this;
    }

    /**
     * Get intituleProduit
     *
     * @return string 
     */
    public function getIntituleProduit()
    {
        return $this->intituleProduit;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return LigneDevis
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prixVente
     *
     * @param float $prixVente
     * @return LigneDevis
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;
    
        return $this;
    }

    /**
     * Get prixVente
     *
     * @return float 
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }

    /**
     * Set totalPrixVente
     *
     * @param float $totalPrixVente
     * @return LigneDevis
     */
    public function setTotalPrixVente($totalPrixVente)
    {
        $this->totalPrixVente = $totalPrixVente;
    
        return $this;
    }

    /**
     * Get totalPrixVente
     *
     * @return float 
     */
    public function getTotalPrixVente()
    {
        return $this->totalPrixVente;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return LigneDevis
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
     * Set refDevis
     *
     * @param \Devis\Entity\Devis $refDevis
     * @return LigneDevis
     */
    public function setRefDevis(\Devis\Entity\Devis $refDevis = null)
    {
        $this->refDevis = $refDevis;
    
        return $this;
    }

    /**
     * Get refDevis
     *
     * @return \Devis\Entity\Devis 
     */
    public function getRefDevis()
    {
        return $this->refDevis;
    }
}
