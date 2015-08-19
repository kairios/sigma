<?php

namespace Produit\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFournisseur
 *
 * @ORM\Table(name="produit_fournisseur", indexes={@ORM\Index(name="ref_produit", columns={"ref_produit"}), @ORM\Index(name="ref_fournisseur", columns={"ref_fournisseur"})})
 * @ORM\Entity
 */
class ProduitFournisseur
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
     * @ORM\Column(name="reference_fournisseur", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceFournisseur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixAchat;

    /**
     * @var integer
     *
     * @ORM\Column(name="conditionnement", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $conditionnement;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Produit\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit\Entity\Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit", referencedColumnName="id", nullable=true)
     * })
     */
    private $refProduit;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refFournisseur;


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
     * Set referenceFournisseur
     *
     * @param string $referenceFournisseur
     * @return ProduitFournisseur
     */
    public function setReferenceFournisseur($referenceFournisseur)
    {
        $this->referenceFournisseur = $referenceFournisseur;
    
        return $this;
    }

    /**
     * Get referenceFournisseur
     *
     * @return string 
     */
    public function getReferenceFournisseur()
    {
        return $this->referenceFournisseur;
    }

    /**
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return ProduitFournisseur
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;
    
        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float 
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set conditionnement
     *
     * @param integer $conditionnement
     * @return ProduitFournisseur
     */
    public function setConditionnement($conditionnement)
    {
        $this->conditionnement = $conditionnement;
    
        return $this;
    }

    /**
     * Get conditionnement
     *
     * @return integer 
     */
    public function getConditionnement()
    {
        return $this->conditionnement;
    }

    /**
     * Set poids
     *
     * @param float $poids
     * @return ProduitFournisseur
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    
        return $this;
    }

    /**
     * Get poids
     *
     * @return float 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return ProduitFournisseur
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
     * Set refProduit
     *
     * @param \Produit\Entity\Produit $refProduit
     * @return ProduitFournisseur
     */
    public function setRefProduit(\Produit\Entity\Produit $refProduit = null)
    {
        $this->refProduit = $refProduit;
    
        return $this;
    }

    /**
     * Get refProduit
     *
     * @return \Produit\Entity\Produit 
     */
    public function getRefProduit()
    {
        return $this->refProduit;
    }

    /**
     * Set refFournisseur
     *
     * @param \Fournisseur\Entity\Fournisseur $refFournisseur
     * @return ProduitFournisseur
     */
    public function setRefFournisseur(\Fournisseur\Entity\Fournisseur $refFournisseur = null)
    {
        $this->refFournisseur = $refFournisseur;
    
        return $this;
    }

    /**
     * Get refFournisseur
     *
     * @return \Fournisseur\Entity\Fournisseur 
     */
    public function getRefFournisseur()
    {
        return $this->refFournisseur;
    }
}
