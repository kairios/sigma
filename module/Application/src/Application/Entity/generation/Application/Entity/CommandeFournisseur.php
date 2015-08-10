<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeFournisseur
 *
 * @ORM\Table(name="commande_fournisseur", indexes={@ORM\Index(name="fk_commande_fournisseur_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_commande_fournisseur_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_commande_fournisseur_fournisseur1_idx", columns={"ref_fournisseur"}), @ORM\Index(name="fk_commande_fournisseur_interlocuteur_fournisseur1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_commande_fournisseur_mode_reglement1_idx", columns={"ref_mode_reglement"}), @ORM\Index(name="fk_commande_fournisseur_condition_reglement1_idx", columns={"ref_condition_reglement"})})
 * @ORM\Entity
 */
class CommandeFournisseur
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
     * @ORM\Column(name="code_commande", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codeCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_client", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceClient;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_devis_fournisseur", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     */
    private $referenceDevisFournisseur;

    /**
     * @var float
     *
     * @ORM\Column(name="taux_remise", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $tauxRemise;

    /**
     * @var string
     *
     * @ORM\Column(name="delai_livraison_souhaite", type="string", length=70, precision=0, scale=0, nullable=true, unique=false)
     */
    private $delaiLivraisonSouhaite;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_livraison", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $typeLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="autre_adresse_livraison", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $autreAdresseLivraison;

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
     * @var \Application\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAffaire;

    /**
     * @var \Application\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refFournisseur;

    /**
     * @var \Application\Entity\InterlocuteurFournisseur
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\InterlocuteurFournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id", nullable=true)
     * })
     */
    private $refInterlocuteur;

    /**
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPersonnel;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codeCommande
     *
     * @param string $codeCommande
     * @return CommandeFournisseur
     */
    public function setCodeCommande($codeCommande)
    {
        $this->codeCommande = $codeCommande;
    
        return $this;
    }

    /**
     * Get codeCommande
     *
     * @return string 
     */
    public function getCodeCommande()
    {
        return $this->codeCommande;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     * @return CommandeFournisseur
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;
    
        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime 
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set referenceClient
     *
     * @param string $referenceClient
     * @return CommandeFournisseur
     */
    public function setReferenceClient($referenceClient)
    {
        $this->referenceClient = $referenceClient;
    
        return $this;
    }

    /**
     * Get referenceClient
     *
     * @return string 
     */
    public function getReferenceClient()
    {
        return $this->referenceClient;
    }

    /**
     * Set referenceDevisFournisseur
     *
     * @param string $referenceDevisFournisseur
     * @return CommandeFournisseur
     */
    public function setReferenceDevisFournisseur($referenceDevisFournisseur)
    {
        $this->referenceDevisFournisseur = $referenceDevisFournisseur;
    
        return $this;
    }

    /**
     * Get referenceDevisFournisseur
     *
     * @return string 
     */
    public function getReferenceDevisFournisseur()
    {
        return $this->referenceDevisFournisseur;
    }

    /**
     * Set tauxRemise
     *
     * @param float $tauxRemise
     * @return CommandeFournisseur
     */
    public function setTauxRemise($tauxRemise)
    {
        $this->tauxRemise = $tauxRemise;
    
        return $this;
    }

    /**
     * Get tauxRemise
     *
     * @return float 
     */
    public function getTauxRemise()
    {
        return $this->tauxRemise;
    }

    /**
     * Set delaiLivraisonSouhaite
     *
     * @param string $delaiLivraisonSouhaite
     * @return CommandeFournisseur
     */
    public function setDelaiLivraisonSouhaite($delaiLivraisonSouhaite)
    {
        $this->delaiLivraisonSouhaite = $delaiLivraisonSouhaite;
    
        return $this;
    }

    /**
     * Get delaiLivraisonSouhaite
     *
     * @return string 
     */
    public function getDelaiLivraisonSouhaite()
    {
        return $this->delaiLivraisonSouhaite;
    }

    /**
     * Set typeLivraison
     *
     * @param integer $typeLivraison
     * @return CommandeFournisseur
     */
    public function setTypeLivraison($typeLivraison)
    {
        $this->typeLivraison = $typeLivraison;
    
        return $this;
    }

    /**
     * Get typeLivraison
     *
     * @return integer 
     */
    public function getTypeLivraison()
    {
        return $this->typeLivraison;
    }

    /**
     * Set autreAdresseLivraison
     *
     * @param string $autreAdresseLivraison
     * @return CommandeFournisseur
     */
    public function setAutreAdresseLivraison($autreAdresseLivraison)
    {
        $this->autreAdresseLivraison = $autreAdresseLivraison;
    
        return $this;
    }

    /**
     * Get autreAdresseLivraison
     *
     * @return string 
     */
    public function getAutreAdresseLivraison()
    {
        return $this->autreAdresseLivraison;
    }

    /**
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     * @return CommandeFournisseur
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
     * @return CommandeFournisseur
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
     * @param \Application\Entity\Affaire $refAffaire
     * @return CommandeFournisseur
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
     * Set refFournisseur
     *
     * @param \Application\Entity\Fournisseur $refFournisseur
     * @return CommandeFournisseur
     */
    public function setRefFournisseur(\Application\Entity\Fournisseur $refFournisseur = null)
    {
        $this->refFournisseur = $refFournisseur;
    
        return $this;
    }

    /**
     * Get refFournisseur
     *
     * @return \Application\Entity\Fournisseur 
     */
    public function getRefFournisseur()
    {
        return $this->refFournisseur;
    }

    /**
     * Set refInterlocuteur
     *
     * @param \Application\Entity\InterlocuteurFournisseur $refInterlocuteur
     * @return CommandeFournisseur
     */
    public function setRefInterlocuteur(\Application\Entity\InterlocuteurFournisseur $refInterlocuteur = null)
    {
        $this->refInterlocuteur = $refInterlocuteur;
    
        return $this;
    }

    /**
     * Get refInterlocuteur
     *
     * @return \Application\Entity\InterlocuteurFournisseur 
     */
    public function getRefInterlocuteur()
    {
        return $this->refInterlocuteur;
    }

    /**
     * Set refPersonnel
     *
     * @param \Application\Entity\Personnel $refPersonnel
     * @return CommandeFournisseur
     */
    public function setRefPersonnel(\Application\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Application\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }

    /**
     * Set refConditionReglement
     *
     * @param \Application\Entity\ConditionReglement $refConditionReglement
     * @return CommandeFournisseur
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
     * @return CommandeFournisseur
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
}
