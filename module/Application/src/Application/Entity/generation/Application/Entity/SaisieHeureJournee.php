<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeureJournee
 *
 * @ORM\Table(name="saisie_heure_journee", uniqueConstraints={@ORM\UniqueConstraint(name="ref_personnel_2", columns={"ref_personnel", "date"})}, indexes={@ORM\Index(name="ref_personnel", columns={"ref_personnel"})})
 * @ORM\Entity
 */
class SaisieHeureJournee
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
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_debut", type="float", precision=10, scale=0, nullable=false)
     */
    private $heureDebut;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_fin", type="float", precision=10, scale=0, nullable=false)
     */
    private $heureFin;

    /**
     * @var float
     *
     * @ORM\Column(name="duree_pause", type="float", precision=10, scale=0, nullable=false)
     */
    private $dureePause = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbHeureTotal = '0';

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
