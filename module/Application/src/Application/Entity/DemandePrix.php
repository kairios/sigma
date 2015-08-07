<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandePrix
 *
 * @ORM\Table(name="demande_prix", indexes={@ORM\Index(name="fk_tbl_demande_prix_fournisseur1_idx", columns={"ref_societe_fournisseur"}), @ORM\Index(name="fk_tbl_demande_prix_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_demande_prix_interlocuteur_fournisseur1_idx", columns={"ref_interlocuteur_fournisseur"}), @ORM\Index(name="fk_demande_prix_personnel1_idx", columns={"ref_personnel"})})
 * @ORM\Entity
 */
class DemandePrix
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
     * @ORM\Column(name="code_demande_prix", type="string", length=20, nullable=false)
     */
    private $codeDemandePrix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande_prix", type="date", nullable=false)
     */
    private $dateDemandePrix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="demande_prix_traitee", type="boolean", nullable=false)
     */
    private $demandePrixTraitee = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, nullable=true)
     */
    private $delaisLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

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
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

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
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id")
     * })
     */
    private $refSocieteFournisseur;


}
