<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affaire
 *
 * @ORM\Table(name="affaire", indexes={@ORM\Index(name="fk_affaire_raison_perte1_idx", columns={"ref_raison_perte"}), @ORM\Index(name="fk_affaire_client1_idx", columns={"ref_societe_client"}), @ORM\Index(name="fk_affaire_interlocuteur_client1_idx", columns={"ref_interlocuteur_client"}), @ORM\Index(name="fk_affaire_etat_affaire1_idx", columns={"ref_etat_affaire"}), @ORM\Index(name="fk_affaire_tbl_personnel1_idx", columns={"ref_personnel_par_defaut"}), @ORM\Index(name="fk_affaire_centre_de_profit1_idx", columns={"ref_centre_profit"}), @ORM\Index(name="fk_affaire_condition_reglement1_idx", columns={"ref_condition_reglement"})})
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
     * @var integer
     *
     * @ORM\Column(name="numero_affaire", type="integer", nullable=false)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_affaire", type="string", length=150, nullable=true)
     */
    private $nomAffaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_affaire", type="date", nullable=false)
     */
    private $dateCreationAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="code_affaire", type="string", length=30, nullable=false)
     */
    private $codeAffaire;

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
     * @ORM\Column(name="devis_prepare", type="boolean", nullable=false)
     */
    private $devisPrepare = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="commande_passee", type="boolean", nullable=false)
     */
    private $commandePassee = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float", precision=10, scale=0, nullable=false)
     */
    private $remise = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="frais_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $fraisPort = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="contrat_signe", type="boolean", nullable=false)
     */
    private $contratSigne = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_signature", type="date", nullable=true)
     */
    private $dateSignature;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suivi_budget_actif", type="boolean", nullable=false)
     */
    private $suiviBudgetActif = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exercice_fiscal", type="integer", nullable=false)
     */
    private $exerciceFiscal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_perte_projet", type="date", nullable=true)
     */
    private $datePerteProjet;

    /**
     * @var \Application\Entity\CentreDeProfit
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\CentreDeProfit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_centre_profit", referencedColumnName="id")
     * })
     */
    private $refCentreProfit;

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
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Application\Entity\EtatAffaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\EtatAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_etat_affaire", referencedColumnName="id")
     * })
     */
    private $refEtatAffaire;

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
     * @var \Application\Entity\RaisonPerte
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\RaisonPerte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_raison_perte", referencedColumnName="id")
     * })
     */
    private $refRaisonPerte;

    /**
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel_par_defaut", referencedColumnName="id")
     * })
     */
    private $refPersonnelParDefaut;


}
