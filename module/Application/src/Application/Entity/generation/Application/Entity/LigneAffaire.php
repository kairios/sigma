<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneAffaire
 *
 * @ORM\Table(name="ligne_affaire", indexes={@ORM\Index(name="fk_ligne_devis_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_ligne_confirmation_commande1_idx", columns={"ref_confirmation_commande"}), @ORM\Index(name="fk_ligne_facture1_idx", columns={"ref_facture"})})
 * @ORM\Entity
 */
class LigneAffaire
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
     * @ORM\Column(name="intitule_ligne", type="string", length=120, nullable=false)
     */
    private $intituleLigne;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_devis", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVenteDevis;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_details", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVenteDetails = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_prevu", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatPrevu = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_reel", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatReel = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

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
     * @var \Application\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id")
     * })
     */
    private $refFacture;

    /**
     * @var \Application\Entity\ConfirmationCommande
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConfirmationCommande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_confirmation_commande", referencedColumnName="id")
     * })
     */
    private $refConfirmationCommande;


}
