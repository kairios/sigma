<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table(name="ligne", indexes={@ORM\Index(name="fk_ligne_devis_poste1_idx", columns={"ref_post"}), @ORM\Index(name="fk_ligne_devis_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_ligne_fournisseur_a_produit1_idx", columns={"ref_fournisseur_a_produit"}), @ORM\Index(name="fk_ligne_confirmation_commande1_idx", columns={"ref_confirmation_commande"}), @ORM\Index(name="fk_ligne_facture1_idx", columns={"ref_facture"})})
 * @ORM\Entity
 */
class Ligne
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
     * @ORM\Column(name="intitule_produit", type="string", length=120, nullable=false)
     */
    private $intituleProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="poids_produit", type="float", precision=10, scale=0, nullable=true)
     */
    private $poidsProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUnitaireProduit = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire_achat", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUnitaireAchat = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite_produit", type="integer", nullable=false)
     */
    private $quantiteProduit = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="total_poids_ligne", type="float", precision=10, scale=0, nullable=true)
     */
    private $totalPoidsLigne;

    /**
     * @var float
     *
     * @ORM\Column(name="total_prix_unitaire_ligne", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalPrixUnitaireLigne = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="total_prix_achat_ligne", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalPrixAchatLigne = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_achat", type="string", length=50, nullable=false)
     */
    private $etatAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_vente", type="string", length=50, nullable=false)
     */
    private $etatVente;

    /**
     * @var string
     *
     * @ORM\Column(name="motif_ligne", type="string", length=50, nullable=true)
     */
    private $motifLigne;

    /**
     * @var \Application\Entity\ConfirmationCommande
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConfirmationCommande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_confirmation_commande", referencedColumnName="id")
     * })
     */
    private $refConfirmationCommande;

    /**
     * @var \Application\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Application\Entity\Poste
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_post", referencedColumnName="id")
     * })
     */
    private $refPost;

    /**
     * @var \Application\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id")
     * })
     */
    private $refFacture;

    /**
     * @var \Application\Entity\FournisseurAProduit
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FournisseurAProduit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur_a_produit", referencedColumnName="id")
     * })
     */
    private $refFournisseurAProduit;


}
