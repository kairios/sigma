<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="fk_adresse_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_adresse_fournisseur1_idx", columns={"ref_fournisseur"})})
 * @ORM\Entity
 */
class Adresse
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
     * @ORM\Column(name="rue_1", type="string", length=80, nullable=false)
     */
    private $rue1;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_2", type="string", length=80, nullable=true)
     */
    private $rue2;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_3", type="string", length=50, nullable=true)
     */
    private $rue3;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=15, nullable=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=80, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=20, nullable=false)
     */
    private $pays;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_principale", type="boolean", nullable=false)
     */
    private $adressePrincipale = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_facturation", type="boolean", nullable=false)
     */
    private $adresseFacturation = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_livraison", type="boolean", nullable=false)
     */
    private $adresseLivraison = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_postale", type="boolean", nullable=false)
     */
    private $adressePostale = '0';

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
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id")
     * })
     */
    private $refFournisseur;


}
