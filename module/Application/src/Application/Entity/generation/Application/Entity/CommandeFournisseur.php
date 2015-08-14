<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeFournisseur
 *
 * @ORM\Table(name="commande_fournisseur", indexes={@ORM\Index(name="fk_commande_fournisseur_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_commande_fournisseur_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_commande_fournisseur_fournisseur1_idx", columns={"ref_fournisseur"}), @ORM\Index(name="fk_commande_fournisseur_interlocuteur_fournisseur1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_commande_fournisseur_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_commande_fournisseur_condition_reglement1_idx", columns={"ref_condition_reglement"})})
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
     * @ORM\Column(name="code_commande", type="string", length=20, nullable=false)
     */
    private $codeCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="date", nullable=false)
     */
    private $dateCommande;

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
     * @ORM\Column(name="delai_livraison_souhaite", type="string", length=70, nullable=true)
     */
    private $delaiLivraisonSouhaite;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_livraison", type="integer", nullable=false)
     */
    private $typeLivraison = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="autre_adresse_livraison", type="text", nullable=true)
     */
    private $autreAdresseLivraison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="date", nullable=true)
     */
    private $dateEnvoi;

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
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id")
     * })
     */
    private $refFournisseur;

    /**
     * @var \Application\Entity\InterlocuteurFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;

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
