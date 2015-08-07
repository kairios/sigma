<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="fk_produit_translation1_idx", columns={"ref_intitule"}), @ORM\Index(name="fk_produit_segment", columns={"ref_segment"})})
 * @ORM\Entity
 */
class Produit
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
     * @var \Application\Entity\Segment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_segment", referencedColumnName="id")
     * })
     */
    private $refSegment;

    /**
     * @var \Application\Entity\Traduction
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Traduction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_intitule", referencedColumnName="id")
     * })
     */
    private $refIntitule;


}
