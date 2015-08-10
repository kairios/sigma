<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur", indexes={@ORM\Index(name="fk_tbl_fournisseur_categorie_fournisseur1_idx", columns={"ref_categorie"}), @ORM\Index(name="fk_tbl_fournisseur_activite_fournisseur1_idx", columns={"ref_activite"}), @ORM\Index(name="fk_fournisseur_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_fournisseur_condition_reglement1_idx", columns={"ref_condition_reglement"}), @ORM\Index(name="fk_fournisseur_poste1_idx", columns={"ref_poste_par_defaut"})})
 * @ORM\Entity
 */
class Fournisseur
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
     * @ORM\Column(name="code_fournisseur", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
     */
    private $codeFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="code_client", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     */
    private $codeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $raisonSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="site_web", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_tva", type="string", length=25, precision=0, scale=0, nullable=true, unique=false)
     */
    private $numeroTva;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_siret", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $numeroSiret;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_ape", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
     */
    private $numeroApe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $actif;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $supprime;

    /**
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id", nullable=true)
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Application\Entity\ModeReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ModeReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_mode_reglement", referencedColumnName="id", nullable=true)
     * })
     */
    private $refModeReglement;

    /**
     * @var \Fournisseur\Entity\ActiviteFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\ActiviteFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_activite", referencedColumnName="id", nullable=true)
     * })
     */
    private $refActivite;

    /**
     * @var \Fournisseur\Entity\CategorieFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\CategorieFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_categorie", referencedColumnName="id", nullable=true)
     * })
     */
    private $refCategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Adresse\Entity\Adresse", mappedBy="refFournisseur", cascade={"all"}, orphanRemoval=true)
     */
    private $adresses;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Fournisseur\Entity\InterlocuteurFournisseur", mappedBy="refSocieteFournisseur", cascade={"all"}, orphanRemoval=true)
     */
    private $interlocuteurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->interlocuteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set codeFournisseur
     *
     * @param string $codeFournisseur
     * @return Fournisseur
     */
    public function setCodeFournisseur($codeFournisseur)
    {
        $this->codeFournisseur = $codeFournisseur;
    
        return $this;
    }

    /**
     * Get codeFournisseur
     *
     * @return string 
     */
    public function getCodeFournisseur()
    {
        return $this->codeFournisseur;
    }

    /**
     * Set codeClient
     *
     * @param string $codeClient
     * @return Fournisseur
     */
    public function setCodeClient($codeClient)
    {
        $this->codeClient = $codeClient;
    
        return $this;
    }

    /**
     * Get codeClient
     *
     * @return string 
     */
    public function getCodeClient()
    {
        return $this->codeClient;
    }

    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Fournisseur
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    
        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Fournisseur
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
     * Set fax
     *
     * @param string $fax
     * @return Fournisseur
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
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return Fournisseur
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;
    
        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Fournisseur
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
     * Set dateCreationModificationFiche
     *
     * @param \DateTime $dateCreationModificationFiche
     * @return Fournisseur
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
     * Set numeroTva
     *
     * @param string $numeroTva
     * @return Fournisseur
     */
    public function setNumeroTva($numeroTva)
    {
        $this->numeroTva = $numeroTva;
    
        return $this;
    }

    /**
     * Get numeroTva
     *
     * @return string 
     */
    public function getNumeroTva()
    {
        return $this->numeroTva;
    }

    /**
     * Set numeroSiret
     *
     * @param string $numeroSiret
     * @return Fournisseur
     */
    public function setNumeroSiret($numeroSiret)
    {
        $this->numeroSiret = $numeroSiret;
    
        return $this;
    }

    /**
     * Get numeroSiret
     *
     * @return string 
     */
    public function getNumeroSiret()
    {
        return $this->numeroSiret;
    }

    /**
     * Set numeroApe
     *
     * @param string $numeroApe
     * @return Fournisseur
     */
    public function setNumeroApe($numeroApe)
    {
        $this->numeroApe = $numeroApe;
    
        return $this;
    }

    /**
     * Get numeroApe
     *
     * @return string 
     */
    public function getNumeroApe()
    {
        return $this->numeroApe;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Fournisseur
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    
        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set supprime
     *
     * @param boolean $supprime
     * @return Fournisseur
     */
    public function setSupprime($supprime)
    {
        $this->supprime = $supprime;
    
        return $this;
    }

    /**
     * Get supprime
     *
     * @return boolean 
     */
    public function getSupprime()
    {
        return $this->supprime;
    }

    /**
     * Set refConditionReglement
     *
     * @param \Application\Entity\ConditionReglement $refConditionReglement
     * @return Fournisseur
     */
    public function setRefConditionReglement(\Application\Entity\ConditionReglement $refConditionReglement = null)
    {
        $this->refConditionReglement = $refConditionReglement;
    
        return $this;
    }

    /**
     * Get refConditionReglement
     *
     * @return \Application\Entity\ConditionReglement 
     */
    public function getRefConditionReglement()
    {
        return $this->refConditionReglement;
    }

    /**
     * Set refModeReglement
     *
     * @param \Application\Entity\ModeReglement $refModeReglement
     * @return Fournisseur
     */
    public function setRefModeReglement(\Application\Entity\ModeReglement $refModeReglement = null)
    {
        $this->refModeReglement = $refModeReglement;
    
        return $this;
    }

    /**
     * Get refModeReglement
     *
     * @return \Application\Entity\ModeReglement 
     */
    public function getRefModeReglement()
    {
        return $this->refModeReglement;
    }

    /**
     * Set refActivite
     *
     * @param \Fournisseur\Entity\ActiviteFournisseur $refActivite
     * @return Fournisseur
     */
    public function setRefActivite(\Fournisseur\Entity\ActiviteFournisseur $refActivite = null)
    {
        $this->refActivite = $refActivite;
    
        return $this;
    }

    /**
     * Get refActivite
     *
     * @return \Fournisseur\Entity\ActiviteFournisseur 
     */
    public function getRefActivite()
    {
        return $this->refActivite;
    }

    /**
     * Set refCategorie
     *
     * @param \Fournisseur\Entity\CategorieFournisseur $refCategorie
     * @return Fournisseur
     */
    public function setRefCategorie(\Fournisseur\Entity\CategorieFournisseur $refCategorie = null)
    {
        $this->refCategorie = $refCategorie;
    
        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Fournisseur\Entity\CategorieFournisseur 
     */
    public function getRefCategorie()
    {
        return $this->refCategorie;
    }

    /**
     * Add adresses
     *
     * @param \Adresse\Entity\Adresse $adresses
     * @return Fournisseur
     */
    public function addAdress(\Adresse\Entity\Adresse $adresses)
    {
        $this->adresses[] = $adresses;
    
        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \Adresse\Entity\Adresse $adresses
     */
    public function removeAdress(\Adresse\Entity\Adresse $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Add interlocuteurs
     *
     * @param \Fournisseur\Entity\InterlocuteurFournisseur $interlocuteurs
     * @return Fournisseur
     */
    public function addInterlocuteur(\Fournisseur\Entity\InterlocuteurFournisseur $interlocuteurs)
    {
        $this->interlocuteurs[] = $interlocuteurs;
    
        return $this;
    }

    /**
     * Remove interlocuteurs
     *
     * @param \Fournisseur\Entity\InterlocuteurFournisseur $interlocuteurs
     */
    public function removeInterlocuteur(\Fournisseur\Entity\InterlocuteurFournisseur $interlocuteurs)
    {
        $this->interlocuteurs->removeElement($interlocuteurs);
    }

    /**
     * Get interlocuteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterlocuteurs()
    {
        return $this->interlocuteurs;
    }
}
