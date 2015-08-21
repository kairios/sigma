<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneProduit
 *
 * @ORM\Table(name="ligne_produit", indexes={@ORM\Index(name="ref_ligne_affaire", columns={"ref_ligne_affaire"}), @ORM\Index(name="ref_fournisseur", columns={"ref_fournisseur"}), @ORM\Index(name="ref_poste_budget", columns={"ref_poste_budget"}), @ORM\Index(name="ref_produit_fournisseur_vente", columns={"ref_produit_fournisseur_vente"}), @ORM\Index(name="ref_commande_fournisseur", columns={"ref_commande_fournisseur"})})
 * @ORM\Entity
 */
class LigneProduit
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
     * @ORM\Column(name="numero_produit", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $numeroProduit;

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
     * @var string
     *
     * @ORM\Column(name="reference_produit_fournisseur", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceProduitFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_devis", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceDevis;

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
     * @var float
     *
     * @ORM\Column(name="prix_achat_total", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixAchatTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_total", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixVenteTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_facturation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateFacturation;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_commande", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateCommande;

    /**
     * @var boolean
     *
     * @ORM\Column(name="imprevu", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $imprevu;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Affaire\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refLigneAffaire;

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
     * @var \Application\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste_budget", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPosteBudget;

    /**
     * @var \CommandeFournisseur\Entity\CommandeFournisseur
     *
     * @ORM\ManyToOne(targetEntity="CommandeFournisseur\Entity\CommandeFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_commande_fournisseur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refCommandeFournisseur;

    /**
     * @var \Produit\Entity\ProduitFournisseurVente
     *
     * @ORM\ManyToOne(targetEntity="Produit\Entity\ProduitFournisseurVente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit_fournisseur_vente", referencedColumnName="id", nullable=true)
     * })
     */
    private $refProduitFournisseurVente;


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
     * Set numeroProduit
     *
     * @param string $numeroProduit
     * @return LigneProduit
     */
    public function setNumeroProduit($numeroProduit)
    {
        $this->numeroProduit = $numeroProduit;
    
        return $this;
    }

    /**
     * Get numeroProduit
     *
     * @return string 
     */
    public function getNumeroProduit()
    {
        return $this->numeroProduit;
    }

    /**
     * Set intituleProduit
     *
     * @param string $intituleProduit
     * @return LigneProduit
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
     * @return LigneProduit
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
     * Set referenceProduitFournisseur
     *
     * @param string $referenceProduitFournisseur
     * @return LigneProduit
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
     * Set referenceDevis
     *
     * @param string $referenceDevis
     * @return LigneProduit
     */
    public function setReferenceDevis($referenceDevis)
    {
        $this->referenceDevis = $referenceDevis;
    
        return $this;
    }

    /**
     * Get referenceDevis
     *
     * @return string 
     */
    public function getReferenceDevis()
    {
        return $this->referenceDevis;
    }

    /**
     * Set prixAchat
     *
     * @param float $prixAchat
     * @return LigneProduit
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
     * @return LigneProduit
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
     * Set prixAchatTotal
     *
     * @param float $prixAchatTotal
     * @return LigneProduit
     */
    public function setPrixAchatTotal($prixAchatTotal)
    {
        $this->prixAchatTotal = $prixAchatTotal;
    
        return $this;
    }

    /**
     * Get prixAchatTotal
     *
     * @return float 
     */
    public function getPrixAchatTotal()
    {
        return $this->prixAchatTotal;
    }

    /**
     * Set prixVenteTotal
     *
     * @param float $prixVenteTotal
     * @return LigneProduit
     */
    public function setPrixVenteTotal($prixVenteTotal)
    {
        $this->prixVenteTotal = $prixVenteTotal;
    
        return $this;
    }

    /**
     * Get prixVenteTotal
     *
     * @return float 
     */
    public function getPrixVenteTotal()
    {
        return $this->prixVenteTotal;
    }

    /**
     * Set dateFacturation
     *
     * @param integer $dateFacturation
     * @return LigneProduit
     */
    public function setDateFacturation($dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;
    
        return $this;
    }

    /**
     * Get dateFacturation
     *
     * @return integer 
     */
    public function getDateFacturation()
    {
        return $this->dateFacturation;
    }

    /**
     * Set dateCommande
     *
     * @param integer $dateCommande
     * @return LigneProduit
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
    
        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return integer 
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set imprevu
     *
     * @param boolean $imprevu
     * @return LigneProduit
     */
    public function setImprevu($imprevu)
    {
        $this->imprevu = $imprevu;
    
        return $this;
    }

    /**
     * Get imprevu
     *
     * @return boolean 
     */
    public function getImprevu()
    {
        return $this->imprevu;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return LigneProduit
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
     * Set refLigneAffaire
     *
     * @param \Affaire\Entity\LigneAffaire $refLigneAffaire
     * @return LigneProduit
     */
    public function setRefLigneAffaire(\Affaire\Entity\LigneAffaire $refLigneAffaire = null)
    {
        $this->refLigneAffaire = $refLigneAffaire;
    
        return $this;
    }

    /**
     * Get refLigneAffaire
     *
     * @return \Affaire\Entity\LigneAffaire 
     */
    public function getRefLigneAffaire()
    {
        return $this->refLigneAffaire;
    }

    /**
     * Set refFournisseur
     *
     * @param \Fournisseur\Entity\Fournisseur $refFournisseur
     * @return LigneProduit
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

    /**
     * Set refPosteBudget
     *
     * @param \Application\Entity\PosteCout $refPosteBudget
     * @return LigneProduit
     */
    public function setRefPosteBudget(\Application\Entity\PosteCout $refPosteBudget = null)
    {
        $this->refPosteBudget = $refPosteBudget;
    
        return $this;
    }

    /**
     * Get refPosteBudget
     *
     * @return \Application\Entity\PosteCout 
     */
    public function getRefPosteBudget()
    {
        return $this->refPosteBudget;
    }

    /**
     * Set refCommandeFournisseur
     *
     * @param \CommandeFournisseur\Entity\CommandeFournisseur $refCommandeFournisseur
     * @return LigneProduit
     */
    public function setRefCommandeFournisseur(\CommandeFournisseur\Entity\CommandeFournisseur $refCommandeFournisseur = null)
    {
        $this->refCommandeFournisseur = $refCommandeFournisseur;
    
        return $this;
    }

    /**
     * Get refCommandeFournisseur
     *
     * @return \CommandeFournisseur\Entity\CommandeFournisseur 
     */
    public function getRefCommandeFournisseur()
    {
        return $this->refCommandeFournisseur;
    }

    /**
     * Set refProduitFournisseurVente
     *
     * @param \Produit\Entity\ProduitFournisseurVente $refProduitFournisseurVente
     * @return LigneProduit
     */
    public function setRefProduitFournisseurVente(\Produit\Entity\ProduitFournisseurVente $refProduitFournisseurVente = null)
    {
        $this->refProduitFournisseurVente = $refProduitFournisseurVente;
    
        return $this;
    }

    /**
     * Get refProduitFournisseurVente
     *
     * @return \Produit\Entity\ProduitFournisseurVente 
     */
    public function getRefProduitFournisseurVente()
    {
        return $this->refProduitFournisseurVente;
    }
}
