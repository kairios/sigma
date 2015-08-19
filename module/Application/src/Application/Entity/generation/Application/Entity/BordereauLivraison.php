<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BordereauLivraison
 *
 * @ORM\Table(name="bordereau_livraison", indexes={@ORM\Index(name="fk_bordereau_livraison_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_bordereau_livraison_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_bordereau_livraison_affaire1_idx", columns={"ref_affaire"})})
 * @ORM\Entity
 */
class BordereauLivraison
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
     * @ORM\Column(name="code_bordereau", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codeBordereau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_bordereau", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateBordereau;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_palette", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nbPalette;

    /**
     * @var float
     *
     * @ORM\Column(name="poids_colis", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $poidsColis;

    /**
     * @var string
     *
     * @ORM\Column(name="transporteur", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $transporteur;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceCommandeClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_livraison", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateLivraison;

    /**
     * @var \Application\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAffaire;

    /**
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id", nullable=true)
     * })
     */
    private $refClient;

    /**
     * @var \Application\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refInterlocuteur;


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
     * Set codeBordereau
     *
     * @param string $codeBordereau
     * @return BordereauLivraison
     */
    public function setCodeBordereau($codeBordereau)
    {
        $this->codeBordereau = $codeBordereau;
    
        return $this;
    }

    /**
     * Get codeBordereau
     *
     * @return string 
     */
    public function getCodeBordereau()
    {
        return $this->codeBordereau;
    }

    /**
     * Set dateBordereau
     *
     * @param \DateTime $dateBordereau
     * @return BordereauLivraison
     */
    public function setDateBordereau($dateBordereau)
    {
        $this->dateBordereau = $dateBordereau;
    
        return $this;
    }

    /**
     * Get dateBordereau
     *
     * @return \DateTime 
     */
    public function getDateBordereau()
    {
        return $this->dateBordereau;
    }

    /**
     * Set nbPalette
     *
     * @param integer $nbPalette
     * @return BordereauLivraison
     */
    public function setNbPalette($nbPalette)
    {
        $this->nbPalette = $nbPalette;
    
        return $this;
    }

    /**
     * Get nbPalette
     *
     * @return integer 
     */
    public function getNbPalette()
    {
        return $this->nbPalette;
    }

    /**
     * Set poidsColis
     *
     * @param float $poidsColis
     * @return BordereauLivraison
     */
    public function setPoidsColis($poidsColis)
    {
        $this->poidsColis = $poidsColis;
    
        return $this;
    }

    /**
     * Get poidsColis
     *
     * @return float 
     */
    public function getPoidsColis()
    {
        return $this->poidsColis;
    }

    /**
     * Set transporteur
     *
     * @param string $transporteur
     * @return BordereauLivraison
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
     * Set referenceCommandeClient
     *
     * @param string $referenceCommandeClient
     * @return BordereauLivraison
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
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     * @return BordereauLivraison
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;
    
        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime 
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * Set refAffaire
     *
     * @param \Application\Entity\Affaire $refAffaire
     * @return BordereauLivraison
     */
    public function setRefAffaire(\Application\Entity\Affaire $refAffaire = null)
    {
        $this->refAffaire = $refAffaire;
    
        return $this;
    }

    /**
     * Get refAffaire
     *
     * @return \Application\Entity\Affaire 
     */
    public function getRefAffaire()
    {
        return $this->refAffaire;
    }

    /**
     * Set refClient
     *
     * @param \Application\Entity\Client $refClient
     * @return BordereauLivraison
     */
    public function setRefClient(\Application\Entity\Client $refClient = null)
    {
        $this->refClient = $refClient;
    
        return $this;
    }

    /**
     * Get refClient
     *
     * @return \Application\Entity\Client 
     */
    public function getRefClient()
    {
        return $this->refClient;
    }

    /**
     * Set refInterlocuteur
     *
     * @param \Application\Entity\InterlocuteurClient $refInterlocuteur
     * @return BordereauLivraison
     */
    public function setRefInterlocuteur(\Application\Entity\InterlocuteurClient $refInterlocuteur = null)
    {
        $this->refInterlocuteur = $refInterlocuteur;
    
        return $this;
    }

    /**
     * Get refInterlocuteur
     *
     * @return \Application\Entity\InterlocuteurClient 
     */
    public function getRefInterlocuteur()
    {
        return $this->refInterlocuteur;
    }
}
