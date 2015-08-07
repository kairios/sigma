<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneDevis
 *
 * @ORM\Table(name="ligne_devis", indexes={@ORM\Index(name="fk_ligne_devis_devis1_idx", columns={"ref_devis"}), @ORM\Index(name="fk_ligne_devis_fournisseur_has_produit1_idx", columns={"ref_fournisseur_a_produit"}), @ORM\Index(name="fk_ligne_devis_ligne1_idx", columns={"ref_ligne_affaire"})})
 * @ORM\Entity
 */
class LigneDevis
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
     * @var float
     *
     * @ORM\Column(name="prix_unitaire_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUnitaireProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite_produit", type="integer", nullable=false)
     */
    private $quantiteProduit = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="total_ligne", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalLigne = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Application\Entity\Devis
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_devis", referencedColumnName="id")
     * })
     */
    private $refDevis;

    /**
     * @var \Application\Entity\FournisseurAProduit
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FournisseurAProduit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur_a_produit", referencedColumnName="id")
     * })
     */
    private $refFournisseurAProduit;

    /**
     * @var \Application\Entity\Ligne
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Ligne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;


}
