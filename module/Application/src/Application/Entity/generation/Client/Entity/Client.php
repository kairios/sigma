<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="fk_client_type_segment1_idx", columns={"ref_type_segment"}), @ORM\Index(name="fk_client_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_client_condition_reglement1_idx", columns={"ref_condition_reglement"})})
 * @ORM\Entity
 */
class Client
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
     * @ORM\Column(name="code_client", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
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
     * @ORM\Column(name="date_creation", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="effectif_salarie", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $effectifSalarie;

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
     * @ORM\Column(name="entreprise_a_livrer", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $entrepriseALivrer;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise_a_facturer", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $entrepriseAFacturer;

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
     * @var \Client\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\TypeSegment", inversedBy="clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id", nullable=true)
     * })
     */
    private $refTypeSegment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Adresse\Entity\Adresse", mappedBy="refClient", cascade={"all"}, orphanRemoval=true)
     */
    private $adresses;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Client\Entity\InterlocuteurClient", mappedBy="refSocieteClient", cascade={"all"}, orphanRemoval=true)
     */
    private $interlocuteurs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client\Entity\Segment")
     * @ORM\JoinTable(name="client_a_segment",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ref_client", referencedColumnName="id", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ref_segment", referencedColumnName="id", nullable=true)
     *   }
     * )
     */
    private $segments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client\Entity\ProduitFini")
     * @ORM\JoinTable(name="client_a_produit_fini",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ref_client", referencedColumnName="id", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ref_produit_fini", referencedColumnName="id", nullable=true)
     *   }
     * )
     */
    private $produitsFinis;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->interlocuteurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->segments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->produitsFinis = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set codeClient
     *
     * @param string $codeClient
     * @return Client
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
     * @return Client
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
     * Set dateCreation
     *
     * @param string $dateCreation
     * @return Client
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return string 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set effectifSalarie
     *
     * @param string $effectifSalarie
     * @return Client
     */
    public function setEffectifSalarie($effectifSalarie)
    {
        $this->effectifSalarie = $effectifSalarie;
    
        return $this;
    }

    /**
     * Get effectifSalarie
     *
     * @return string 
     */
    public function getEffectifSalarie()
    {
        return $this->effectifSalarie;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * Set entrepriseALivrer
     *
     * @param string $entrepriseALivrer
     * @return Client
     */
    public function setEntrepriseALivrer($entrepriseALivrer)
    {
        $this->entrepriseALivrer = $entrepriseALivrer;
    
        return $this;
    }

    /**
     * Get entrepriseALivrer
     *
     * @return string 
     */
    public function getEntrepriseALivrer()
    {
        return $this->entrepriseALivrer;
    }

    /**
     * Set entrepriseAFacturer
     *
     * @param string $entrepriseAFacturer
     * @return Client
     */
    public function setEntrepriseAFacturer($entrepriseAFacturer)
    {
        $this->entrepriseAFacturer = $entrepriseAFacturer;
    
        return $this;
    }

    /**
     * Get entrepriseAFacturer
     *
     * @return string 
     */
    public function getEntrepriseAFacturer()
    {
        return $this->entrepriseAFacturer;
    }

    /**
     * Set numeroTva
     *
     * @param string $numeroTva
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * Set refTypeSegment
     *
     * @param \Client\Entity\TypeSegment $refTypeSegment
     * @return Client
     */
    public function setRefTypeSegment(\Client\Entity\TypeSegment $refTypeSegment = null)
    {
        $this->refTypeSegment = $refTypeSegment;
    
        return $this;
    }

    /**
     * Get refTypeSegment
     *
     * @return \Client\Entity\TypeSegment 
     */
    public function getRefTypeSegment()
    {
        return $this->refTypeSegment;
    }

    /**
     * Add adresses
     *
     * @param \Adresse\Entity\Adresse $adresses
     * @return Client
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
     * @param \Client\Entity\InterlocuteurClient $interlocuteurs
     * @return Client
     */
    public function addInterlocuteur(\Client\Entity\InterlocuteurClient $interlocuteurs)
    {
        $this->interlocuteurs[] = $interlocuteurs;
    
        return $this;
    }

    /**
     * Remove interlocuteurs
     *
     * @param \Client\Entity\InterlocuteurClient $interlocuteurs
     */
    public function removeInterlocuteur(\Client\Entity\InterlocuteurClient $interlocuteurs)
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

    /**
     * Add segments
     *
     * @param \Client\Entity\Segment $segments
     * @return Client
     */
    public function addSegment(\Client\Entity\Segment $segments)
    {
        $this->segments[] = $segments;
    
        return $this;
    }

    /**
     * Remove segments
     *
     * @param \Client\Entity\Segment $segments
     */
    public function removeSegment(\Client\Entity\Segment $segments)
    {
        $this->segments->removeElement($segments);
    }

    /**
     * Get segments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * Add produitsFinis
     *
     * @param \Client\Entity\ProduitFini $produitsFinis
     * @return Client
     */
    public function addProduitsFini(\Client\Entity\ProduitFini $produitsFinis)
    {
        $this->produitsFinis[] = $produitsFinis;
    
        return $this;
    }

    /**
     * Remove produitsFinis
     *
     * @param \Client\Entity\ProduitFini $produitsFinis
     */
    public function removeProduitsFini(\Client\Entity\ProduitFini $produitsFinis)
    {
        $this->produitsFinis->removeElement($produitsFinis);
    }

    /**
     * Get produitsFinis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduitsFinis()
    {
        return $this->produitsFinis;
    }
}
