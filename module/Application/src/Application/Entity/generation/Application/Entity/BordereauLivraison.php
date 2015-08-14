<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BordereauLivraison
 *
 * @ORM\Table(name="bordereau_livraison", indexes={@ORM\Index(name="fk_bordereau_livraison_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_bordereau_livraison_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_bordereau_livraison_affaire1_idx", columns={"ref_affaire"})})
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
     * @ORM\Column(name="code_bordereau", type="string", length=50, nullable=false)
     */
    private $codeBordereau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_bordereau", type="date", nullable=false)
     */
    private $dateBordereau;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_palette", type="integer", nullable=false)
     */
    private $nbPalette = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="poids_colis", type="float", precision=10, scale=0, nullable=false)
     */
    private $poidsColis = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="transporteur", type="string", length=50, nullable=true)
     */
    private $transporteur;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=50, nullable=true)
     */
    private $referenceCommandeClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_livraison", type="date", nullable=true)
     */
    private $dateLivraison;

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
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;

    /**
     * @var \Application\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;


}
