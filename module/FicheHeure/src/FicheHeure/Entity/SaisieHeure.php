<?php

namespace FicheHeure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeure
 *
 * @ORM\Table(name="saisie_heure", indexes={@ORM\Index(name="ref_personnel", columns={"ref_personnel"}), @ORM\Index(name="ref_libelle", columns={"ref_libelle"}), @ORM\Index(name="ref_affaire", columns={"ref_affaire"}), @ORM\Index(name="ref_poste", columns={"ref_poste"})})
 * @ORM\Entity
 */
class SaisieHeure
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
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="datetime", nullable=false)
     */
    private $heureDebut = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="datetime", nullable=false)
     */
    private $heureFin = '0000-00-00 00:00:00';

    /**
     * @var float
     *
     * @ORM\Column(name="duree_pause", type="float", precision=10, scale=0, nullable=false)
     */
    private $dureePause = 1;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbHeure;

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
     * @var \SaisieHeureLibelle
     *
     * @ORM\ManyToOne(targetEntity="SaisieHeureLibelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_libelle", referencedColumnName="id")
     * })
     */
    private $refLibelle;

    /**
     * @var \Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \PosteCout
     *
     * @ORM\ManyToOne(targetEntity="PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id")
     * })
     */
    private $refPoste;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = 0;


}
