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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_produit", type="string", length=50, nullable=true)
     */
    private $codeProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_produit", type="string", length=120, nullable=false)
     */
    private $intituleProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_produit_fournisseur", type="string", length=50, nullable=true)
     */
    private $referenceProduitFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_devis", type="string", length=50, nullable=true)
     */
    private $referenceDevis;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchat = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVente = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatTotal = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVenteTotal = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_facturation", type="integer", nullable=true)
     */
    private $dateFacturation;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_commande", type="integer", nullable=true)
     */
    private $dateCommande;

    /**
     * @var boolean
     *
     * @ORM\Column(name="imprevu", type="boolean", nullable=false)
     */
    private $imprevu = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Affaire\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id")
     * })
     */
    private $refFournisseur;

    /**
     * @var \Application\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste_budget", referencedColumnName="id")
     * })
     */
    private $refPosteBudget;

    /**
     * @var \CommandeFournisseur\Entity\CommandeFournisseur
     *
     * @ORM\ManyToOne(targetEntity="CommandeFournisseur\Entity\CommandeFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_commande_fournisseur", referencedColumnName="id")
     * })
     */
    private $refCommandeFournisseur;

    /**
     * @var \Produit\Entity\ProduitFournisseurVente
     *
     * @ORM\ManyToOne(targetEntity="Produit\Entity\ProduitFournisseurVente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit_fournisseur_vente", referencedColumnName="id")
     * })
     */
    private $refProduitFournisseurVente;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCodeProduit()
    {
        return $this->codeProduit;
    }

    public function setCodeProduit($codeProduit)
    {
        $this->codeProduit = $codeProduit;
    }

    public function getIntituleProduit()
    {
        return $this->intituleProduit;
    }

    public function setIntituleProduit($intituleProduit)
    {
        $this->intituleProduit = $intituleProduit;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    public function getReferenceProduitFournisseur()
    {
        return $this->referenceProduitFournisseur;
    }

    public function setReferenceProduitFournisseur($referenceProduitFournisseur)
    {
        $this->referenceProduitFournisseur = $referenceProduitFournisseur;
    }

    public function getReferenceDevis()
    {
        return $this->referenceDevis;
    }

    public function setReferenceDevis($referenceDevis)
    {
        $this->referenceDevis = $referenceDevis;
    }

    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;
    }

    public function getPrixVente()
    {
        return $this->prixVente;
    }

    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;
    }

    public function getPrixVenteTotal()
    {
        return $this->prixVenteTotal;
    }

    public function setPrixVenteTotal($prixVenteTotal)
    {
        $this->prixVenteTotal = $prixVenteTotal;
    }

    public function getPrixAchatTotal()
    {
        return $this->prixAchatTotal;
    }

    public function setPrixAchatTotal($prixAchatTotal)
    {
        $this->prixAchatTotal = $prixAchatTotal;
    }

    public function getDateFacturation()
    {
        return $this->dateFacturation;
    }

    public function setDateFacturation($dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;
    }

    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
    }

    public function getDateCommande($dateCommande)
    {
        return $this->dateCommande;
    }

    public function getImprevu()
    {
        return $this->imprevu;
    }

    public function setImprevu($imprevu)
    {
        $this->imprevu = $imprevu;
    }

    public function getRemarques()
    {
        return $this->remarques;
    }

    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;
    }

    public function getLignes() {
        
    }
}
