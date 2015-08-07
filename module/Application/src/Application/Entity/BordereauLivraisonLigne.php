<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BordereauLivraisonLigne
 *
 * @ORM\Table(name="bordereau_livraison_ligne", indexes={@ORM\Index(name="fk_bordereau_livraison_ligne_ligne1_idx", columns={"ref_ligne_affaire"}), @ORM\Index(name="fk_bordereau_livraison_ligne_bordereau_livraison1_idx", columns={"ref_bordereau_livraison"})})
 * @ORM\Entity
 */
class BordereauLivraisonLigne
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
     * @var \Application\Entity\BordereauLivraison
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\BordereauLivraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_bordereau_livraison", referencedColumnName="id")
     * })
     */
    private $refBordereauLivraison;

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
