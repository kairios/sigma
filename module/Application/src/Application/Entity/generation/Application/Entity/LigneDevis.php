<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneDevis
 *
 * @ORM\Table(name="ligne_devis", indexes={@ORM\Index(name="fk_ligne_devis_devis1_idx", columns={"ref_devis"})})
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
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVente = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="total_prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalPrixVente = '0';

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


}
