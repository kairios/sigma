<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affaire
 *
 * @ORM\Table(name="affaire", indexes={@ORM\Index(name="fk_affaire_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_affaire_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_affaire_tbl_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_affaire_centre_de_profit1_idx", columns={"ref_centre_profit"}), @ORM\Index(name="fk_affaire_condition_reglement1_idx", columns={"ref_condition_reglement"}), @ORM\Index(name="ref_concurrent", columns={"ref_concurrent"}), @ORM\Index(name="ref_devis_signe", columns={"ref_devis_signe"})})
 * @ORM\Entity
 */
class Affaire
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
     * @ORM\Column(name="numero_affaire", type="string", length=30, nullable=false)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="designation_affaire", type="string", length=150, nullable=true)
     */
    private $designationAffaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="exercice", type="integer", nullable=false)
     */
    private $exercice;

    /**
     * @var string
     *
     * @ORM\Column(name="demande_client", type="text", nullable=true)
     */
    private $demandeClient;

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float", precision=10, scale=0, nullable=false)
     */
    private $remise = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="frais_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $fraisPort = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=70, nullable=true)
     */
    private $referenceCommandeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_demande_prix", type="string", length=50, nullable=true)
     */
    private $referenceDemandePrix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suivi_budget_actif", type="boolean", nullable=false)
     */
    private $suiviBudgetActif = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_affaire", type="string", length=30, nullable=false)
     */
    private $etatAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_perte", type="string", length=150, nullable=true)
     */
    private $raisonPerte;

    /**
     * @var \InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;

    /**
     * @var \Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var \ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_concurrent", referencedColumnName="id")
     * })
     */
    private $refConcurrent;

    /**
     * @var \Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_devis_signe", referencedColumnName="id")
     * })
     */
    private $refDevisSigne;

    /**
     * @var \CentreDeProfit
     *
     * @ORM\ManyToOne(targetEntity="CentreDeProfit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_centre_profit", referencedColumnName="id")
     * })
     */
    private $refCentreProfit;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;


}
