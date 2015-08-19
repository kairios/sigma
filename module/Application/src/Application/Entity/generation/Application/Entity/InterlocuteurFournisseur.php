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
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="portable", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $portable;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_civilite", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $titreCivilite;

    /**
     * @var boolean
     *
     * @ORM\Column(name="envoi_vers_outlook", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $envoiVersOutlook;

    /**
     * @var \Application\Entity\FonctionInterlocuteur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FonctionInterlocuteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fonction", referencedColumnName="id", nullable=true)
     * })
     */
    private $refFonction;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_fournisseur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refSocieteFournisseur;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return InterlocuteurFournisseur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return InterlocuteurFournisseur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return InterlocuteurFournisseur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set portable
     *
     * @param string $portable
     * @return InterlocuteurFournisseur
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;
    
        return $this;
    }

    /**
     * Get portable
     *
     * @return string 
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return InterlocuteurFournisseur
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return InterlocuteurFournisseur
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set dateCreationModificationFiche
     *
     * @param \DateTime $dateCreationModificationFiche
     * @return InterlocuteurFournisseur
     */
    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {
        $this->dateCreationModificationFiche = $dateCreationModificationFiche;
    
        return $this;
    }

    /**
     * Get dateCreationModificationFiche
     *
     * @return \DateTime 
     */
    public function getDateCreationModificationFiche()
    {
        return $this->dateCreationModificationFiche;
    }

    /**
     * Set titreCivilite
     *
     * @param string $titreCivilite
     * @return InterlocuteurFournisseur
     */
    public function setTitreCivilite($titreCivilite)
    {
        $this->titreCivilite = $titreCivilite;
    
        return $this;
    }

    /**
     * Get titreCivilite
     *
     * @return string 
     */
    public function getTitreCivilite()
    {
        return $this->titreCivilite;
    }

    /**
     * Set envoiVersOutlook
     *
     * @param boolean $envoiVersOutlook
     * @return InterlocuteurFournisseur
     */
    public function setEnvoiVersOutlook($envoiVersOutlook)
    {
        $this->envoiVersOutlook = $envoiVersOutlook;
    
        return $this;
    }

    /**
     * Get envoiVersOutlook
     *
     * @return boolean 
     */
    public function getEnvoiVersOutlook()
    {
        return $this->envoiVersOutlook;
    }

    /**
     * Set refFonction
     *
     * @param \Application\Entity\FonctionInterlocuteur $refFonction
     * @return InterlocuteurFournisseur
     */
    public function setRefFonction(\Application\Entity\FonctionInterlocuteur $refFonction = null)
    {
        $this->refFonction = $refFonction;
    
        return $this;
    }

    /**
     * Get refFonction
     *
     * @return \Application\Entity\FonctionInterlocuteur 
     */
    public function getRefFonction()
    {
        return $this->refFonction;
    }

    /**
     * Set refSocieteFournisseur
     *
     * @param \Application\Entity\Fournisseur $refSocieteFournisseur
     * @return InterlocuteurFournisseur
     */
    public function setRefSocieteFournisseur(\Application\Entity\Fournisseur $refSocieteFournisseur = null)
    {
        $this->refSocieteFournisseur = $refSocieteFournisseur;
    
        return $this;
    }

    /**
     * Get refSocieteFournisseur
     *
     * @return \Application\Entity\Fournisseur 
     */
    public function getRefSocieteFournisseur()
    {
        return $this->refSocieteFournisseur;
    }
}
