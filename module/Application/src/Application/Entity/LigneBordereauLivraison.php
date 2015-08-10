<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneBordereauLivraison
 *
 * @ORM\Table(name="ligne_bordereau_livraison", indexes={@ORM\Index(name="fk_bordereau_livraison_ligne_ligne1_idx", columns={"ref_ligne_affaire"}), @ORM\Index(name="ref_bordereau", columns={"ref_bordereau"})})
 * @ORM\Entity
 */
class LigneBordereauLivraison
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
     * @ORM\Column(name="quantite_livree", type="integer", nullable=false)
     */
    private $quantiteLivree = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reste_a_livrer", type="integer", nullable=false)
     */
    private $resteALivrer = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="total_a_livrer", type="integer", nullable=false)
     */
    private $totalALivrer = '0';

    /**
     * @var \BordereauLivraison
     *
     * @ORM\ManyToOne(targetEntity="BordereauLivraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_bordereau", referencedColumnName="id")
     * })
     */
    private $refBordereau;

    /**
     * @var \LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;


}
