<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FournisseurAAdresse
 *
 * @ORM\Table(name="fournisseur_a_adresse", indexes={@ORM\Index(name="fk_tbl_fournisseur_has_adresse_adresse1_idx", columns={"ref_adresse"}), @ORM\Index(name="fk_tbl_fournisseur_has_adresse_tbl_fournisseur1_idx", columns={"ref_fournisseur"})})
 * @ORM\Entity
 */
class FournisseurAAdresse
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
     * @var boolean
     *
     * @ORM\Column(name="adresse_principale", type="boolean", nullable=false)
     */
    private $adressePrincipale = '0';

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
     * @var \Application\Entity\Adresse
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_adresse", referencedColumnName="id")
     * })
     */
    private $refAdresse;

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
