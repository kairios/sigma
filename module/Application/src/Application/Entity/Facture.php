<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="fk_facture_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_facture_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_facture_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_facture_affaire1_idx", columns={"ref_affaire"})})
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
     * @var integer
     *
     * @ORM\Column(name="ref_affaire", type="integer", nullable=false)
     */
    private $refAffaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="ref_client", type="integer", nullable=false)
     */
    private $refClient;

    /**
     * @var integer
     *
     * @ORM\Column(name="ref_interlocuteur", type="integer", nullable=true)
     */
    private $refInterlocuteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="ref_personnel", type="integer", nullable=false)
     */
    private $refPersonnel;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_affaire", type="string", length=30, nullable=true)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_facture", type="string", length=20, nullable=false)
     */
    private $numeroFacture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture", type="date", nullable=false)
     */
    private $dateFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_colis", type="integer", nullable=false)
     */
    private $nbColis = '1';

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
     * @var float
     *
     * @ORM\Column(name="taux_tva", type="float", precision=10, scale=0, nullable=false)
     */
    private $tauxTva;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tva_inclus", type="boolean", nullable=false)
     */
    private $tvaInclus = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="envoyee", type="boolean", nullable=false)
     */
    private $envoyee = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reglee", type="boolean", nullable=false)
     */
    private $reglee = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="proformat", type="boolean", nullable=false)
     */
    private $proformat = '0';

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
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;


}
