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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=false)
     */
    private $coefficient;

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
     * @var integer
     *
     * @ORM\Column(name="conditionnement", type="integer", nullable=false)
     */
    private $conditionnement = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="string", length=45, nullable=true)
     */
    private $remarques;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_derniere_modification", type="date", nullable=false)
     */
    private $dateDerniereModification;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_produit_fournisseur", type="string", length=50, nullable=true)
     */
    private $referenceProduitFournisseur;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id")
     * })
     */
    private $refSocieteFournisseur;

    /**
     * @var \Application\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit", referencedColumnName="id")
     * })
     */
    private $refProduit;


}
