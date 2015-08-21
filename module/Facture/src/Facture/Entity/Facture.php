<?php

namespace Facture\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="fk_facture_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_facture_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_facture_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_facture_affaire1_idx", columns={"ref_affaire"})})
 * @ORM\Entity
 */
class Facture
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
     * @var \Affaire\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;

    /**
     * @var \Client\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="\Client\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_affaire", type="string", length=30, nullable=true)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_facture", type="string", length=20, nullable=false)
     */
    private $numeroFacture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture", type="date", nullable=false)
     */
    private $dateFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_colis", type="integer", nullable=false)
     */
    private $nbColis = 1;

    /**
     * @var float
     *
     * @ORM\Column(name="poids", type="float", precision=10, scale=0, nullable=false)
     */
    private $poids = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="transporteur", type="string", length=50, nullable=true)
     */
    private $transporteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expedition", type="date", nullable=true)
     */
    private $dateExpedition;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_expedition", type="string", length=70, nullable=true)
     */
    private $lieuExpedition;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_bl", type="string", length=120, nullable=true)
     */
    private $referenceBl;

    /**
     * @var float
     *
     * @ORM\Column(name="taux_tva", type="float", precision=10, scale=0, nullable=false)
     */
    private $tauxTva;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tva_inclus", type="boolean", nullable=false)
     */
    private $tvaInclus = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="envoyee", type="boolean", nullable=false)
     */
    private $envoyee = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reglee", type="boolean", nullable=false)
     */
    private $reglee = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="proformat", type="boolean", nullable=false)
     */
    private $proformat = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHt = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ttc", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalTtc = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;


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
     * Set numeroAffaire
     *
     * @param string $numeroAffaire
     * @return Facture
     */
    public function setNumeroAffaire($numeroAffaire)
    {
        $this->numeroAffaire = $numeroAffaire;
    
        return $this;
    }

    /**
     * Get numeroAffaire
     *
     * @return string 
     */
    public function getNumeroAffaire()
    {
        return $this->numeroAffaire;
    }

    /**
     * Set numeroFacture
     *
     * @param string $numeroFacture
     * @return Facture
     */
    public function setNumeroFacture($numeroFacture)
    {
        $this->numeroFacture = $numeroFacture;
    
        return $this;
    }

    /**
     * Get numeroFacture
     *
     * @return string 
     */
    public function getNumeroFacture()
    {
        return $this->numeroFacture;
    }

    /**
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     * @return Facture
     */
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;
    
        return $this;
    }

    /**
     * Get dateFacture
     *
     * @return \DateTime 
     */
    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    /**
     * Set nbColis
     *
     * @param integer $nbColis
     * @return Facture
     */
    public function setNbColis($nbColis)
    {
        $this->nbColis = $nbColis;
    
        return $this;
    }

    /**
     * Get nbColis
     *
     * @return integer 
     */
    public function getNbColis()
    {
        return $this->nbColis;
    }

    /**
     * Set poids
     *
     * @param float $poids
     * @return Facture
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    
        return $this;
    }

    /**
     * Get poids
     *
     * @return float 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set transporteur
     *
     * @param string $transporteur
     * @return Facture
     */
    public function setTransporteur($transporteur)
    {
        $this->transporteur = $transporteur;
    
        return $this;
    }

    /**
     * Get transporteur
     *
     * @return string 
     */
    public function getTransporteur()
    {
        return $this->transporteur;
    }

    /**
     * Set dateExpedition
     *
     * @param \DateTime $dateExpedition
     * @return Facture
     */
    public function setDateExpedition($dateExpedition)
    {
        $this->dateExpedition = $dateExpedition;
    
        return $this;
    }

    /**
     * Get dateExpedition
     *
     * @return \DateTime 
     */
    public function getDateExpedition()
    {
        return $this->dateExpedition;
    }

    /**
     * Set lieuExpedition
     *
     * @param string $lieuExpedition
     * @return Facture
     */
    public function setLieuExpedition($lieuExpedition)
    {
        $this->lieuExpedition = $lieuExpedition;
    
        return $this;
    }

    /**
     * Get lieuExpedition
     *
     * @return string 
     */
    public function getLieuExpedition()
    {
        return $this->lieuExpedition;
    }

    /**
     * Set referenceBl
     *
     * @param string $referenceBl
     * @return Facture
     */
    public function setReferenceBl($referenceBl)
    {
        $this->referenceBl = $referenceBl;
    
        return $this;
    }

    /**
     * Get referenceBl
     *
     * @return string 
     */
    public function getReferenceBl()
    {
        return $this->referenceBl;
    }

    /**
     * Set tauxTva
     *
     * @param float $tauxTva
     * @return Facture
     */
    public function setTauxTva($tauxTva)
    {
        $this->tauxTva = $tauxTva;
    
        return $this;
    }

    /**
     * Get tauxTva
     *
     * @return float 
     */
    public function getTauxTva()
    {
        return $this->tauxTva;
    }

    /**
     * Set tvaInclus
     *
     * @param boolean $tvaInclus
     * @return Facture
     */
    public function setTvaInclus($tvaInclus)
    {
        $this->tvaInclus = $tvaInclus;
    
        return $this;
    }

    /**
     * Get tvaInclus
     *
     * @return boolean 
     */
    public function getTvaInclus()
    {
        return $this->tvaInclus;
    }

    /**
     * Set envoyee
     *
     * @param boolean $envoyee
     * @return Facture
     */
    public function setEnvoyee($envoyee)
    {
        $this->envoyee = $envoyee;
    
        return $this;
    }

    /**
     * Get envoyee
     *
     * @return boolean 
     */
    public function getEnvoyee()
    {
        return $this->envoyee;
    }

    /**
     * Set reglee
     *
     * @param boolean $reglee
     * @return Facture
     */
    public function setReglee($reglee)
    {
        $this->reglee = $reglee;
    
        return $this;
    }

    /**
     * Get reglee
     *
     * @return boolean 
     */
    public function getReglee()
    {
        return $this->reglee;
    }

    /**
     * Set proformat
     *
     * @param boolean $proformat
     * @return Facture
     */
    public function setProformat($proformat)
    {
        $this->proformat = $proformat;
    
        return $this;
    }

    /**
     * Get proformat
     *
     * @return boolean 
     */
    public function getProformat()
    {
        return $this->proformat;
    }

    /**
     * Set totalHt
     *
     * @param float $totalHt
     * @return Facture
     */
    public function setTotalHt($totalHt)
    {
        $this->totalHt = $totalHt;
    
        return $this;
    }

    /**
     * Get totalHt
     *
     * @return float 
     */
    public function getTotalHt()
    {
        return $this->totalHt;
    }

    /**
     * Set totalTtc
     *
     * @param float $totalTtc
     * @return Facture
     */
    public function setTotalTtc($totalTtc)
    {
        $this->totalTtc = $totalTtc;
    
        return $this;
    }

    /**
     * Get totalTtc
     *
     * @return float 
     */
    public function getTotalTtc()
    {
        return $this->totalTtc;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return Facture
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;
    
        return $this;
    }

    /**
     * Get remarques
     *
     * @return string 
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set refAffaire
     *
     * @param \Affaire\Entity\Affaire $refAffaire
     * @return Facture
     */
    public function setRefAffaire(\Affaire\Entity\Affaire $refAffaire = null)
    {
        $this->refAffaire = $refAffaire;
    
        return $this;
    }

    /**
     * Get refAffaire
     *
     * @return \Affaire\Entity\Affaire 
     */
    public function getRefAffaire()
    {
        return $this->refAffaire;
    }

    /**
     * Set refClient
     *
     * @param \Client\Entity\Client $refClient
     * @return Facture
     */
    public function setRefClient(\Client\Entity\Client $refClient = null)
    {
        $this->refClient = $refClient;
    
        return $this;
    }

    /**
     * Get refClient
     *
     * @return \Client\Entity\Client 
     */
    public function getRefClient()
    {
        return $this->refClient;
    }

    /**
     * Set refInterlocuteur
     *
     * @param \Client\Entity\InterlocuteurClient $refInterlocuteur
     * @return Facture
     */
    public function setRefInterlocuteur(\Client\Entity\InterlocuteurClient $refInterlocuteur = null)
    {
        $this->refInterlocuteur = $refInterlocuteur;
    
        return $this;
    }

    /**
     * Get refInterlocuteur
     *
     * @return \Client\Entity\InterlocuteurClient 
     */
    public function getRefInterlocuteur()
    {
        return $this->refInterlocuteur;
    }

    /**
     * Set refPersonnel
     *
     * @param \Personnel\Entity\Personnel $refPersonnel
     * @return Facture
     */
    public function setRefPersonnel(\Personnel\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Personnel\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }
}
