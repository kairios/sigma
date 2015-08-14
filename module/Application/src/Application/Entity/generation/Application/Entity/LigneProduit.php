<?php

namespace Application\Entity;

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
     * @ORM\Column(name="numero_produit", type="string", length=50, nullable=true)
     */
    private $numeroProduit;

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
    private $quantite = '1';

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
    private $prixAchat = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVente = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatTotal = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVenteTotal = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facturation", type="date", nullable=true)
     */
    private $dateFacturation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="date", nullable=true)
     */
    private $dateCommande;

    /**
     * @var boolean
     *
     * @ORM\Column(name="imprevu", type="boolean", nullable=false)
     */
    private $imprevu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Application\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
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
     * @var \Application\Entity\ProduitFournisseurVente
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ProduitFournisseurVente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit_fournisseur_vente", referencedColumnName="id")
     * })
     */
    private $refProduitFournisseurVente;

    /**
     * @var \Application\Entity\CommandeFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\CommandeFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_commande_fournisseur", referencedColumnName="id")
     * })
     */
    private $refCommandeFournisseur;


}
