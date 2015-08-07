<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFicheHeure
 *
 * @ORM\Table(name="ligne_fiche_heure", indexes={@ORM\Index(name="fk_personnel_has_affaire_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_personnel_has_affaire_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_ligne_fiche_heure_tag_fiche_heure1_idx", columns={"ref_tag"})})
 * @ORM\Entity
 */
class LigneFicheHeure
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
     * @ORM\Column(name="date_jour", type="date", nullable=false)
     */
    private $dateJour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="date", nullable=false)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="date", nullable=false)
     */
    private $heureFin;

    /**
     * @var float
     *
     * @ORM\Column(name="duree_repas", type="float", precision=10, scale=0, nullable=false)
     */
    private $dureeRepas;

    /**
     * @var float
     *
     * @ORM\Column(name="total_heures", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHeures = '0';

    /**
     * @var \Application\Entity\TagFicheHeure
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TagFicheHeure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_tag", referencedColumnName="id")
     * })
     */
    private $refTag;

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
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;


}
