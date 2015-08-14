<?php

namespace Application\Entity;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_fournisseur", type="string", length=50, nullable=true)
     */
    private $referenceFournisseur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchat = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="conditionnement", type="integer", nullable=false)
     */
    private $conditionnement = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Application\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit", referencedColumnName="id")
     * })
     */
    private $refProduit;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id")
     * })
     */
    private $refFournisseur;


}
