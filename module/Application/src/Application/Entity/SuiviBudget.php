<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuiviBudget
 *
 * @ORM\Table(name="suivi_budget", indexes={@ORM\Index(name="fk_affaire_has_poste_poste1_idx", columns={"ref_post"}), @ORM\Index(name="fk_affaire_has_poste_affaire1_idx", columns={"ref_affaire"})})
 * @ORM\Entity
 */
class SuiviBudget
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
     * @var float
     *
     * @ORM\Column(name="montant_vente_voulu", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantVenteVoulu = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="montant_vente_réel", type="float", precision=10, scale=0, nullable=true)
     */
    private $montantVenteRéel = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="achats_voulus", type="float", precision=10, scale=0, nullable=false)
     */
    private $achatsVoulus = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="achats_reels", type="float", precision=10, scale=0, nullable=false)
     */
    private $achatsReels = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="marge_voulue_euros", type="float", precision=10, scale=0, nullable=false)
     */
    private $margeVoulueEuros = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="marge_voulue_pourcentage", type="float", precision=10, scale=0, nullable=false)
     */
    private $margeVouluePourcentage = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="marge_reelle_euros", type="float", precision=10, scale=0, nullable=false)
     */
    private $margeReelleEuros = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="marge_reelle_pourcentage", type="float", precision=10, scale=0, nullable=false)
     */
    private $margeReellePourcentage = '0';

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
     * @var \Application\Entity\Poste
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_post", referencedColumnName="id")
     * })
     */
    private $refPost;


}
