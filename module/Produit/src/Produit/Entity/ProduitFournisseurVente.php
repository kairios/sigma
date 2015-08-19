<?php

namespace Produit\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFournisseurVente
 *
 * @ORM\Table(name="produit_fournisseur_vente", indexes={@ORM\Index(name="ref_produit_fournisseur", columns={"ref_produit_fournisseur"})})
 * @ORM\Entity
 */
class ProduitFournisseurVente
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
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVente;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=false)
     */
    private $coefficient;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Produit\Entity\ProduitFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Produit\Entity\ProduitFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit_fournisseur", referencedColumnName="id")
     * })
     */
    private $refProduitFournisseur;

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
     * Set prixVente
     *
     * @param float $prixVente
     * @return ProduitFournisseurVente
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
     * Set coefficient
     *
     * @param integer $coefficient
     * @return ProduitFournisseurVente
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    
        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer 
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return ProduitFournisseurVente
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
     * Set refProduitFournisseur
     *
     * @param \Produit\Entity\ProduitFournisseur $refProduitFournisseur
     * @return ProduitFournisseurVente
     */
    public function setRefProduitFournisseur(\Produit\Entity\ProduitFournisseur $refProduitFournisseur = null)
    {
        $this->refProduitFournisseur = $refProduitFournisseur;
    
        return $this;
    }

    /**
     * Get refProduitFournisseur
     *
     * @return \Produit\Entity\ProduitFournisseur 
     */
    public function getRefProduitFournisseur()
    {
        return $this->refProduitFournisseur;
    }
}
