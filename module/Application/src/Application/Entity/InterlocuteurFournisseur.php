<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterlocuteurFournisseur
 *
 * @ORM\Table(name="interlocuteur_fournisseur", indexes={@ORM\Index(name="fk_interlocuteur_fournisseur_fonction1_idx", columns={"ref_fonction"}), @ORM\Index(name="fk_interlocuteur_fournisseur_carte_visite1_idx", columns={"ref_carte_visite"}), @ORM\Index(name="fk_interlocuteur_fournisseur_fournisseur1_idx", columns={"ref_societe_fournisseur"})})
 * @ORM\Entity
 */
class InterlocuteurFournisseur
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
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="portable", type="string", length=50, nullable=true)
     */
    private $portable;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="date", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_civilite", type="string", length=5, nullable=false)
     */
    private $titreCivilite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="envoi_vers_outlook", type="boolean", nullable=false)
     */
    private $envoiVersOutlook = '0';

    /**
     * @var \Application\Entity\FonctionInterlocuteur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FonctionInterlocuteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fonction", referencedColumnName="id")
     * })
     */
    private $refFonction;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id")
     * })
     */
    private $refSocieteFournisseur;


}
