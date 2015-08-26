<?php

namespace ConfirmationCommande\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfirmationCommande
 *
 * @ORM\Table(name="confirmation_commande", indexes={@ORM\Index(name="fk_confirmation_commande_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_confirmation_commande_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_confirmation_commande_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_confirmation_commande_interlocuteur_client1_idx", columns={"ref_interlocuteur"})})
 * @ORM\Entity
 */
class ConfirmationCommande
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
     * @ORM\Column(name="numero_affaire", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="code_confirmation", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codeConfirmation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_confirmation", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateConfirmation;

    /**
     * @var string
     *
     * @ORM\Column(name="delais_livraison", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $delaisLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceCommandeClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateEnvoi;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Affaire\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAffaire;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id", nullable=true)
     * })
     */
    private $refClient;

    /**
     * @var \Client\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refInterlocuteur;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPersonnel;


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
     * @return ConfirmationCommande
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
     * Set codeConfirmation
     *
     * @param string $codeConfirmation
     * @return ConfirmationCommande
     */
    public function setCodeConfirmation($codeConfirmation)
    {
        $this->codeConfirmation = $codeConfirmation;
    
        return $this;
    }

    /**
     * Get codeConfirmation
     *
     * @return string 
     */
    public function getCodeConfirmation()
    {
        return $this->codeConfirmation;
    }

    /**
     * Set dateConfirmation
     *
     * @param \DateTime $dateConfirmation
     * @return ConfirmationCommande
     */
    public function setDateConfirmation($dateConfirmation)
    {
        $this->dateConfirmation = $dateConfirmation;
    
        return $this;
    }

    /**
     * Get dateConfirmation
     *
     * @return \DateTime 
     */
    public function getDateConfirmation()
    {
        return $this->dateConfirmation;
    }

    /**
     * Set delaisLivraison
     *
     * @param string $delaisLivraison
     * @return ConfirmationCommande
     */
    public function setDelaisLivraison($delaisLivraison)
    {
        $this->delaisLivraison = $delaisLivraison;
    
        return $this;
    }

    /**
     * Get delaisLivraison
     *
     * @return string 
     */
    public function getDelaisLivraison()
    {
        return $this->delaisLivraison;
    }

    /**
     * Set referenceCommandeClient
     *
     * @param string $referenceCommandeClient
     * @return ConfirmationCommande
     */
    public function setReferenceCommandeClient($referenceCommandeClient)
    {
        $this->referenceCommandeClient = $referenceCommandeClient;
    
        return $this;
    }

    /**
     * Get referenceCommandeClient
     *
     * @return string 
     */
    public function getReferenceCommandeClient()
    {
        return $this->referenceCommandeClient;
    }

    /**
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     * @return ConfirmationCommande
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;
    
        return $this;
    }

    /**
     * Get dateEnvoi
     *
     * @return \DateTime 
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return ConfirmationCommande
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
     * @return ConfirmationCommande
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
     * @return ConfirmationCommande
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
     * @return ConfirmationCommande
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
     * @return ConfirmationCommande
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
