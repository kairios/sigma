<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BordereauLivraison
 *
 * @ORM\Table(name="bordereau_livraison", indexes={@ORM\Index(name="fk_bordereau_livraison_client1_idx", columns={"ref_societe_client"}), @ORM\Index(name="fk_bordereau_livraison_interlocuteur_client1_idx", columns={"ref_interlocuteur_client"}), @ORM\Index(name="fk_bordereau_livraison_affaire1_idx", columns={"ref_affaire"})})
 * @ORM\Entity
 */
class BordereauLivraison
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
     * @ORM\Column(name="code_bordereau_livraison", type="string", length=50, nullable=false)
     */
    private $codeBordereauLivraison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_bordereau_livraison", type="date", nullable=false)
     */
    private $dateBordereauLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=45, nullable=true)
     */
    private $referenceCommandeClient;

    /**
     * @var boolean
     *
     * @ORM\Column(name="livraison_effectuee", type="boolean", nullable=false)
     */
    private $livraisonEffectuee = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_palette", type="integer", nullable=false)
     */
    private $nbrePalette = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="poids_total_colis", type="float", precision=10, scale=0, nullable=false)
     */
    private $poidsTotalColis = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="transporteur", type="string", length=150, nullable=true)
     */
    private $transporteur;

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
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_client", referencedColumnName="id")
     * })
     */
    private $refSocieteClient;

    /**
     * @var \Application\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur_client", referencedColumnName="id")
     * })
     */
    private $refInterlocuteurClient;


}
