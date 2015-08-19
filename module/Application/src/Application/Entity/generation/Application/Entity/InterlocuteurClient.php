<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterlocuteurClient
 *
 * @ORM\Table(name="interlocuteur_client", indexes={@ORM\Index(name="fk_tbl_interlocuteur_client1_idx", columns={"ref_societe_client"}), @ORM\Index(name="fk_interlocuteur_fonction1_idx", columns={"ref_fonction"}), @ORM\Index(name="fk_interlocuteur_carte_visite1_idx", columns={"ref_carte_visite"})})
 * @ORM\Entity
 */
class InterlocuteurClient
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
     * @ORM\Column(name="nom", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=200, precision=0, scale=0, nullable=true, unique=false)
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
     * @ORM\Column(name="fax", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email_2", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email2;

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
     * @var string
     *
     * @ORM\Column(name="accepte_infos", type="blob", length=1, precision=0, scale=0, nullable=false, unique=false)
     */
    private $accepteInfos;

    /**
     * @var string
     *
     * @ORM\Column(name="envoi_vers_outlook", type="blob", length=1, precision=0, scale=0, nullable=false, unique=false)
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
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_societe_client", referencedColumnName="id", nullable=true)
     * })
     */
    private $refSocieteClient;


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
     * @return InterlocuteurClient
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
     * @return InterlocuteurClient
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
     * @return InterlocuteurClient
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
     * @return InterlocuteurClient
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
     * Set fax
     *
     * @param string $fax
     * @return InterlocuteurClient
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
     * Set email
     *
     * @param string $email
     * @return InterlocuteurClient
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
     * Set email2
     *
     * @param string $email2
     * @return InterlocuteurClient
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;
    
        return $this;
    }

    /**
     * Get email2
     *
     * @return string 
     */
    public function getEmail2()
    {
        return $this->email2;
    }

    /**
     * Set dateCreationModificationFiche
     *
     * @param \DateTime $dateCreationModificationFiche
     * @return InterlocuteurClient
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
     * @return InterlocuteurClient
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
     * Set accepteInfos
     *
     * @param string $accepteInfos
     * @return InterlocuteurClient
     */
    public function setAccepteInfos($accepteInfos)
    {
        $this->accepteInfos = $accepteInfos;
    
        return $this;
    }

    /**
     * Get accepteInfos
     *
     * @return string 
     */
    public function getAccepteInfos()
    {
        return $this->accepteInfos;
    }

    /**
     * Set envoiVersOutlook
     *
     * @param string $envoiVersOutlook
     * @return InterlocuteurClient
     */
    public function setEnvoiVersOutlook($envoiVersOutlook)
    {
        $this->envoiVersOutlook = $envoiVersOutlook;
    
        return $this;
    }

    /**
     * Get envoiVersOutlook
     *
     * @return string 
     */
    public function getEnvoiVersOutlook()
    {
        return $this->envoiVersOutlook;
    }

    /**
     * Set refFonction
     *
     * @param \Application\Entity\FonctionInterlocuteur $refFonction
     * @return InterlocuteurClient
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
     * Set refSocieteClient
     *
     * @param \Application\Entity\Client $refSocieteClient
     * @return InterlocuteurClient
     */
    public function setRefSocieteClient(\Application\Entity\Client $refSocieteClient = null)
    {
        $this->refSocieteClient = $refSocieteClient;
    
        return $this;
    }

    /**
     * Get refSocieteClient
     *
     * @return \Application\Entity\Client 
     */
    public function getRefSocieteClient()
    {
        return $this->refSocieteClient;
    }
}
