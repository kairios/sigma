<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LignePrestation
 *
 * @ORM\Table(name="ligne_prestation", indexes={@ORM\Index(name="ref_ligne_affaire", columns={"ref_ligne_affaire"}), @ORM\Index(name="ref_personnel", columns={"ref_personnel"}), @ORM\Index(name="ref_metier", columns={"ref_metier"}), @ORM\Index(name="ref_poste", columns={"ref_poste"})})
 * @ORM\Entity
 */
class LignePrestation
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
     * @ORM\Column(name="nb_heure_prevu", type="integer", nullable=false)
     */
    private $nbHeurePrevu = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_heure_reel", type="integer", nullable=false)
     */
    private $nbHeureReel = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="montant_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantVente = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="cout_interne_prevu", type="float", precision=10, scale=0, nullable=false)
     */
    private $coutInternePrevu = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="cout_interne_reel", type="float", precision=10, scale=0, nullable=false)
     */
    private $coutInterneReel = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="effectuee", type="boolean", nullable=false)
     */
    private $effectuee = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Application\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;

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
     * @var \Application\Entity\Metier
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Metier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_metier", referencedColumnName="id")
     * })
     */
    private $refMetier;

    /**
     * @var \Application\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id")
     * })
     */
    private $refPoste;


}
