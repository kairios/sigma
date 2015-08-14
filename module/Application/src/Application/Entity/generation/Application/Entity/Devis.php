<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis", indexes={@ORM\Index(name="fk_devis_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="ref_personnel", columns={"ref_personnel"})})
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
     * @var string
     *
     * @ORM\Column(name="code_devis", type="string", length=50, nullable=false)
     */
    private $codeDevis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_devis", type="date", nullable=false)
     */
    private $dateDevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '1';

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
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, nullable=true)
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
     * @ORM\Column(name="condition_reglement", type="string", length=60, nullable=true)
     */
    private $conditionReglement;

    /**
     * @var float
     *
     * @ORM\Column(name="total_hors_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHorsPort = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="total_avec_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalAvecPort = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="date", nullable=true)
     */
    private $dateEnvoi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_signature", type="date", nullable=true)
     */
    private $dateSignature;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

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


}
