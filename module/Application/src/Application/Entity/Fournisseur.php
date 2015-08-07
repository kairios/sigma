<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur", indexes={@ORM\Index(name="fk_tbl_fournisseur_categorie_fournisseur1_idx", columns={"ref_categorie"}), @ORM\Index(name="fk_tbl_fournisseur_activite_fournisseur1_idx", columns={"ref_activite"}), @ORM\Index(name="fk_fournisseur_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_fournisseur_condition_reglement1_idx", columns={"ref_condition_reglement"}), @ORM\Index(name="fk_fournisseur_poste1_idx", columns={"ref_poste_par_defaut"})})
 * @ORM\Entity
 */
class Fournisseur
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
     * @ORM\Column(name="code_fournisseur", type="string", length=10, nullable=false)
     */
    private $codeFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="code_client", type="string", length=30, nullable=true)
     */
    private $codeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=50, nullable=false)
     */
    private $raisonSociale;

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
     * @ORM\Column(name="url", type="string", length=50, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="date", nullable=false)
     */
    private $dateCreationModificationFiche;

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

    /**
     * @var \Application\Entity\Poste
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste_par_defaut", referencedColumnName="id")
     * })
     */
    private $refPosteParDefaut;

    /**
     * @var \Application\Entity\ActiviteFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ActiviteFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_activite", referencedColumnName="id")
     * })
     */
    private $refActivite;

    /**
     * @var \Application\Entity\CategorieFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\CategorieFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_categorie", referencedColumnName="id")
     * })
     */
    private $refCategorie;


}
