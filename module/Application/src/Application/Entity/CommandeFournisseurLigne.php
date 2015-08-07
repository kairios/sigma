<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeFournisseurLigne
 *
 * @ORM\Table(name="commande_fournisseur_ligne", indexes={@ORM\Index(name="fk_commande_fournisseur_ligne_commande_fournisseur1_idx", columns={"ref_commande_fournisseur"}), @ORM\Index(name="fk_commande_fournisseur_ligne_poste1_idx", columns={"ref_poste_budget"}), @ORM\Index(name="fk_commande_fournisseur_ligne_ligne1_idx", columns={"ref_ligne_affaire"})})
 * @ORM\Entity
 */
class CommandeFournisseurLigne
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
     * @ORM\Column(name="reference_produit_fournisseur", type="string", length=50, nullable=true)
     */
    private $referenceProduitFournisseur;

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
     * @var float
     *
     * @ORM\Column(name="prix_achat", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchat = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_total_ligne", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatTotalLigne = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="ligne_facturee", type="boolean", nullable=false)
     */
    private $ligneFacturee = '0';

    /**
     * @var \Application\Entity\CommandeFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\CommandeFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_commande_fournisseur", referencedColumnName="id")
     * })
     */
    private $refCommandeFournisseur;

    /**
     * @var \Application\Entity\Ligne
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Ligne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;

    /**
     * @var \Application\Entity\Poste
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste_budget", referencedColumnName="id")
     * })
     */
    private $refPosteBudget;


}
