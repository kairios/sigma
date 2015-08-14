<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFournisseurVente
 *
 * @ORM\Table(name="produit_fournisseur_vente")
 * @ORM\Entity
 */
class ProduitFournisseurVente
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
     * @ORM\Column(name="ref_produit_fournisseur", type="integer", nullable=false)
     */
    private $refProduitFournisseur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVente;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=false)
     */
    private $coefficient;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;


}
