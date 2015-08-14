<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFini
 *
 * @ORM\Table(name="produit_fini", indexes={@ORM\Index(name="ref_segment", columns={"ref_segment"})})
 * @ORM\Entity
 */
class ProduitFini
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
     * @ORM\Column(name="intitule_produit_fini", type="string", length=50, nullable=false)
     */
    private $intituleProduitFini;

    /**
     * @var \Application\Entity\Segment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_segment", referencedColumnName="id")
     * })
     */
    private $refSegment;


}
