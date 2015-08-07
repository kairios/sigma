<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandePrixLigne
 *
 * @ORM\Table(name="demande_prix_ligne", indexes={@ORM\Index(name="fk_tbl_demande_prix_ligne_demande_prix1_idx", columns={"ref_demande_prix"}), @ORM\Index(name="fk_tbl_demande_prix_ligne_produit1_idx", columns={"ref_produit"})})
 * @ORM\Entity
 */
class DemandePrixLigne
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
     * @ORM\Column(name="code_produit", type="string", length=50, nullable=false)
     */
    private $codeProduit;

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
     * @ORM\Column(name="prix_achat", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixAchat;

    /**
     * @var \Application\Entity\DemandePrix
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\DemandePrix")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_demande_prix", referencedColumnName="id")
     * })
     */
    private $refDemandePrix;

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
