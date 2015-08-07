<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avoir
 *
 * @ORM\Table(name="avoir", indexes={@ORM\Index(name="fk_avoir_facture1_idx", columns={"ref_facture_annulee"})})
 * @ORM\Entity
 */
class Avoir
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
     * @ORM\Column(name="code_avoir", type="string", length=20, nullable=false)
     */
    private $codeAvoir;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \Application\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture_annulee", referencedColumnName="id")
     * })
     */
    private $refFactureAnnulee;


}
