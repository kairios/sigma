<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureEcheance
 *
 * @ORM\Table(name="facture_echeance", indexes={@ORM\Index(name="ref_facture", columns={"ref_facture"}), @ORM\Index(name="ref_condition_reglement", columns={"ref_condition_reglement"}), @ORM\Index(name="ref_mode_reglement", columns={"ref_mode_reglement"})})
 * @ORM\Entity
 */
class FactureEcheance
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
     * @ORM\Column(name="pourcentage", type="integer", nullable=false)
     */
    private $pourcentage = '100';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reglement_prevu", type="datetime", nullable=true)
     */
    private $dateReglementPrevu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reglement", type="datetime", nullable=true)
     */
    private $dateReglement;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHt = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="total_ttc", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalTtc = '0';

    /**
     * @var \Application\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id")
     * })
     */
    private $refFacture;

    /**
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Application\Entity\ModeReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ModeReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_mode_reglement", referencedColumnName="id")
     * })
     */
    private $refModeReglement;


}
