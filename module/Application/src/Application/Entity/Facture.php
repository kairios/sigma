<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="fk_facture_client1_idx", columns={"ref_societe_client"}), @ORM\Index(name="fk_facture_interlocuteur_client1_idx", columns={"ref_interlocuteur_client"}), @ORM\Index(name="fk_facture_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_facture_affaire1_idx", columns={"ref_affaire"})})
 * @ORM\Entity
 */
class Facture
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture", type="date", nullable=false)
     */
    private $dateFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="code_facture", type="string", length=20, nullable=false)
     */
    private $codeFacture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tva_inclus", type="boolean", nullable=false)
     */
    private $tvaInclus = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float", precision=10, scale=0, nullable=false)
     */
    private $tva;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_colis", type="integer", nullable=false)
     */
    private $nombreColis = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="transporteur", type="string", length=50, nullable=true)
     */
    private $transporteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expedition", type="date", nullable=true)
     */
    private $dateExpedition;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_expedition", type="string", length=70, nullable=true)
     */
    private $lieuExpedition;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_bl", type="string", length=120, nullable=true)
     */
    private $referenceBl;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var boolean
     *
     * @ORM\Column(name="facture_envoyee", type="boolean", nullable=false)
     */
    private $factureEnvoyee = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="facture_reglee", type="boolean", nullable=false)
     */
    private $factureReglee = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pourcentage_facture", type="integer", nullable=false)
     */
    private $pourcentageFacture = '100';

    /**
     * @var string
     *
     * @ORM\Column(name="condition_reglement", type="string", length=60, nullable=true)
     */
    private $conditionReglement;

    /**
     * @var string
     *
     * @ORM\Column(name="mode_reglement", type="string", length=50, nullable=true)
     */
    private $modeReglement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reglement_attendu", type="date", nullable=true)
     */
    private $dateReglementAttendu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reglement_effectue", type="date", nullable=true)
     */
    private $dateReglementEffectue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="proformat", type="boolean", nullable=false)
     */
    private $proformat = '0';

    /**
     * @var \Application\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_client", referencedColumnName="id")
     * })
     */
    private $refSocieteClient;

    /**
     * @var \Application\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur_client", referencedColumnName="id")
     * })
     */
    private $refInterlocuteurClient;

    /**
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;


}
