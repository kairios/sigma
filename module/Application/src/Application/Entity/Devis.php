<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis", indexes={@ORM\Index(name="fk_devis_affaire1_idx", columns={"ref_affaire"})})
 * @ORM\Entity
 */
class Devis
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
     * @ORM\Column(name="date_devis", type="date", nullable=false)
     */
    private $dateDevis;

    /**
     * @var string
     *
     * @ORM\Column(name="code_devis", type="string", length=50, nullable=false)
     */
    private $codeDevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="version_devis", type="integer", nullable=false)
     */
    private $versionDevis = '1';

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
     * @var float
     *
     * @ORM\Column(name="total_hors_frais_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHorsFraisPort = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="total_avec_frais_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalAvecFraisPort = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=70, nullable=true)
     */
    private $delaisLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_validite_prix", type="string", length=50, nullable=false)
     */
    private $dureeValiditePrix;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions_règlement", type="string", length=50, nullable=true)
     */
    private $conditionsRèglement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="devis_courant", type="boolean", nullable=false)
     */
    private $devisCourant = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prenom_personnel", type="string", length=50, nullable=false)
     */
    private $nomPrenomPersonnel;

    /**
     * @var \Application\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;


}
