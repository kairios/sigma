<?php

namespace Facture\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureAvoir
 *
 * @ORM\Table(name="facture_avoir", indexes={@ORM\Index(name="fk_avoir_facture1_idx", columns={"ref_facture"})})
 * @ORM\Entity
 */
class FactureAvoir
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
     * @var \Facture\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id")
     * })
     */
    private $refFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_avoir", type="string", length=20, nullable=false)
     */
    private $numeroAvoir;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_avoir", type="date", nullable=false)
     */
    private $dateAvoir;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHt = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ttc", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalTtc = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="envoyee", type="boolean", nullable=false)
     */
    private $envoyee = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;


}
