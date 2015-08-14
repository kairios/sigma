<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="fk_client_type_segment1_idx", columns={"ref_type_segment"}), @ORM\Index(name="fk_client_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_client_condition_reglement1_idx", columns={"ref_condition_reglement"})})
 * @ORM\Entity
 */
class Client
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
     * @ORM\Column(name="code_client", type="string", length=10, nullable=true)
     */
    private $codeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=80, nullable=false)
     */
    private $raisonSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="date_creation", type="string", length=20, nullable=true)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="effectif_salarie", type="string", length=50, nullable=true)
     */
    private $effectifSalarie;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="site_web", type="text", nullable=true)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="datetime", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise_a_livrer", type="text", nullable=true)
     */
    private $entrepriseALivrer;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise_a_facturer", type="text", nullable=true)
     */
    private $entrepriseAFacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_tva", type="string", length=25, nullable=true)
     */
    private $numeroTva;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_siret", type="string", length=50, nullable=true)
     */
    private $numeroSiret;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_ape", type="string", length=10, nullable=true)
     */
    private $numeroApe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = '0';

    /**
     * @var \Application\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TypeSegment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id")
     * })
     */
    private $refTypeSegment;

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
