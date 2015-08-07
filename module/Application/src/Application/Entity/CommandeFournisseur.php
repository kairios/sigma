<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeFournisseur
 *
 * @ORM\Table(name="commande_fournisseur", indexes={@ORM\Index(name="fk_commande_fournisseur_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_commande_fournisseur_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_commande_fournisseur_fournisseur1_idx", columns={"ref_societe_fournisseur"}), @ORM\Index(name="fk_commande_fournisseur_interlocuteur_fournisseur1_idx", columns={"ref_interlocuteur_fournisseur"}), @ORM\Index(name="fk_commande_fournisseur_type_livraison1_idx", columns={"ref_type_livraison"}), @ORM\Index(name="fk_commande_fournisseur_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_commande_fournisseur_condition_reglement1_idx", columns={"ref_condition_reglement"})})
 * @ORM\Entity
 */
class CommandeFournisseur
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
     * @ORM\Column(name="code_commande_fournisseur", type="string", length=20, nullable=false)
     */
    private $codeCommandeFournisseur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande_fournisseur", type="date", nullable=false)
     */
    private $dateCommandeFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_client", type="string", length=50, nullable=true)
     */
    private $referenceClient;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_devis_fournisseur", type="string", length=30, nullable=true)
     */
    private $referenceDevisFournisseur;

    /**
     * @var float
     *
     * @ORM\Column(name="taux_remise", type="float", precision=10, scale=0, nullable=false)
     */
    private $tauxRemise = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="autre_adresse_livraison", type="text", nullable=true)
     */
    private $autreAdresseLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="delai_livraison_souhaite", type="string", length=70, nullable=true)
     */
    private $delaiLivraisonSouhaite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="commande_passee", type="boolean", nullable=false)
     */
    private $commandePassee = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

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
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id")
     * })
     */
    private $refSocieteFournisseur;

    /**
     * @var \Application\Entity\InterlocuteurFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur_fournisseur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteurFournisseur;

    /**
     * @var \Application\Entity\ModeReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ModeReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_mode_reglement", referencedColumnName="id")
     * })
     */
    private $refModeReglement;

    /**
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var \Application\Entity\TypeLivraisonCommandeFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TypeLivraisonCommandeFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_livraison", referencedColumnName="id")
     * })
     */
    private $refTypeLivraison;


}
