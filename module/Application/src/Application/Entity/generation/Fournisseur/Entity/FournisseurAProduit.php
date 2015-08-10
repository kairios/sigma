<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FournisseurAProduit
 *
 * @ORM\Table(name="fournisseur_a_produit", indexes={@ORM\Index(name="fk_fournisseur_has_produit_produit1_idx", columns={"ref_produit"}), @ORM\Index(name="fk_fournisseur_has_produit_fournisseur1_idx", columns={"ref_societe_fournisseur"})})
 * @ORM\Entity
 */
class FournisseurAProduit
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
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $coefficient;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixAchat;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixVente;

    /**
     * @var integer
     *
     * @ORM\Column(name="conditionnement", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $conditionnement;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_derniere_modification", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateDerniereModification;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_produit_fournisseur", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceProduitFournisseur;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refSocieteFournisseur;

    /**
     * @var \Application\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit", referencedColumnName="id", nullable=true)
     * })
     */
    private $refProduit;


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
     * Set coefficient
     *
     * @param integer $coefficient
     * @return FournisseurAProduit
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
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return FournisseurAProduit
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
     * Set prixVente
     *
     * @param float $prixVente
     * @return FournisseurAProduit
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
     * Set conditionnement
     *
     * @param integer $conditionnement
     * @return FournisseurAProduit
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
     * Set remarques
     *
     * @param string $remarques
     * @return FournisseurAProduit
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
     * Set dateDerniereModification
     *
     * @param \DateTime $dateDerniereModification
     * @return FournisseurAProduit
     */
    public function setDateDerniereModification($dateDerniereModification)
    {
        $this->dateDerniereModification = $dateDerniereModification;
    
        return $this;
    }

    /**
     * Get dateDerniereModification
     *
     * @return \DateTime 
     */
    public function getDateDerniereModification()
    {
        return $this->dateDerniereModification;
    }

    /**
     * Set referenceProduitFournisseur
     *
     * @param string $referenceProduitFournisseur
     * @return FournisseurAProduit
     */
    public function setReferenceProduitFournisseur($referenceProduitFournisseur)
    {
        $this->referenceProduitFournisseur = $referenceProduitFournisseur;
    
        return $this;
    }

    /**
     * Get referenceProduitFournisseur
     *
     * @return string 
     */
    public function getReferenceProduitFournisseur()
    {
        return $this->referenceProduitFournisseur;
    }

    /**
     * Set refSocieteFournisseur
     *
     * @param \Application\Entity\Fournisseur $refSocieteFournisseur
     * @return FournisseurAProduit
     */
    public function setRefSocieteFournisseur(\Application\Entity\Fournisseur $refSocieteFournisseur = null)
    {
        $this->refSocieteFournisseur = $refSocieteFournisseur;
    
        return $this;
    }

    /**
     * Get refSocieteFournisseur
     *
     * @return \Application\Entity\Fournisseur 
     */
    public function getRefSocieteFournisseur()
    {
        return $this->refSocieteFournisseur;
    }

    /**
     * Set refProduit
     *
     * @param \Application\Entity\Produit $refProduit
     * @return FournisseurAProduit
     */
    public function setRefProduit(\Application\Entity\Produit $refProduit = null)
    {
        $this->refProduit = $refProduit;
    
        return $this;
    }

    /**
     * Get refProduit
     *
     * @return \Application\Entity\Produit 
     */
    public function getRefProduit()
    {
        return $this->refProduit;
    }
}
