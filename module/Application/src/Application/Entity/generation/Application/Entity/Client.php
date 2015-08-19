<?php

namespace Application\Entity;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="effectif_salarie", type="integer", precision=0, scale=0, nullable=true, unique=false)
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
     * @ORM\Column(name="site_web", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
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
     * @ORM\Column(name="date_creation_modification_fiche", type="date", precision=0, scale=0, nullable=false, unique=false)
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
     * @var \Application\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TypeSegment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id", nullable=true)
     * })
     */
    private $refTypeSegment;


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
     * @param \DateTime $dateCreation
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
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set effectifSalarie
     *
     * @param integer $effectifSalarie
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
     * @return integer 
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
     * @param \Application\Entity\TypeSegment $refTypeSegment
     * @return Client
     */
    public function setRefTypeSegment(\Application\Entity\TypeSegment $refTypeSegment = null)
    {
        $this->refTypeSegment = $refTypeSegment;
    
        return $this;
    }

    /**
     * Get refTypeSegment
     *
     * @return \Application\Entity\TypeSegment 
     */
    public function getRefTypeSegment()
    {
        return $this->refTypeSegment;
    }
}
