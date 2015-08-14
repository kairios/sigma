<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeureProjet
 *
 * @ORM\Table(name="saisie_heure_projet", indexes={@ORM\Index(name="ref_libelle", columns={"ref_libelle"}), @ORM\Index(name="ref_affaire", columns={"ref_affaire"}), @ORM\Index(name="ref_poste", columns={"ref_poste"}), @ORM\Index(name="ref_saisie_horaire", columns={"ref_saisie_horaire"})})
 * @ORM\Entity
 */
class SaisieHeureProjet
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
     * @ORM\Column(name="intitule_saisie", type="string", length=200, nullable=false)
     */
    private $intituleSaisie;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbHeure;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = '0';

    /**
     * @var \Application\Entity\SaisieHeureLibelle
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\SaisieHeureLibelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_libelle", referencedColumnName="id")
     * })
     */
    private $refLibelle;

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
     * @var \Application\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id")
     * })
     */
    private $refPoste;

    /**
     * @var \Application\Entity\SaisieHeureJournee
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\SaisieHeureJournee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_saisie_horaire", referencedColumnName="id")
     * })
     */
    private $refSaisieHoraire;


}
