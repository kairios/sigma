<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneAffaire
 *
 * @ORM\Table(name="ligne_affaire", indexes={@ORM\Index(name="fk_ligne_devis_affaire1_idx", columns={"ref_affaire"}), @ORM\Index(name="fk_ligne_confirmation_commande1_idx", columns={"ref_confirmation_commande"}), @ORM\Index(name="fk_ligne_facture1_idx", columns={"ref_facture"})})
 * @ORM\Entity
 */
class LigneAffaire
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
     * @ORM\Column(name="intitule_ligne", type="string", length=120, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleLigne;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_devis", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixVenteDevis;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_details", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixVenteDetails;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_prevu", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixAchatPrevu;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_reel", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixAchatReel;

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
     * @var \Application\Entity\Facture
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id", nullable=true)
     * })
     */
    private $refFacture;

    /**
     * @var \Application\Entity\ConfirmationCommande
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConfirmationCommande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_confirmation_commande", referencedColumnName="id", nullable=true)
     * })
     */
    private $refConfirmationCommande;


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
     * Set intituleLigne
     *
     * @param string $intituleLigne
     * @return LigneAffaire
     */
    public function setIntituleLigne($intituleLigne)
    {
        $this->intituleLigne = $intituleLigne;
    
        return $this;
    }

    /**
     * Get intituleLigne
     *
     * @return string 
     */
    public function getIntituleLigne()
    {
        return $this->intituleLigne;
    }

    /**
     * Set prixVenteDevis
     *
     * @param float $prixVenteDevis
     * @return LigneAffaire
     */
    public function setPrixVenteDevis($prixVenteDevis)
    {
        $this->prixVenteDevis = $prixVenteDevis;
    
        return $this;
    }

    /**
     * Get prixVenteDevis
     *
     * @return float 
     */
    public function getPrixVenteDevis()
    {
        return $this->prixVenteDevis;
    }

    /**
     * Set prixVenteDetails
     *
     * @param float $prixVenteDetails
     * @return LigneAffaire
     */
    public function setPrixVenteDetails($prixVenteDetails)
    {
        $this->prixVenteDetails = $prixVenteDetails;
    
        return $this;
    }

    /**
     * Get prixVenteDetails
     *
     * @return float 
     */
    public function getPrixVenteDetails()
    {
        return $this->prixVenteDetails;
    }

    /**
     * Set prixAchatPrevu
     *
     * @param float $prixAchatPrevu
     * @return LigneAffaire
     */
    public function setPrixAchatPrevu($prixAchatPrevu)
    {
        $this->prixAchatPrevu = $prixAchatPrevu;
    
        return $this;
    }

    /**
     * Get prixAchatPrevu
     *
     * @return float 
     */
    public function getPrixAchatPrevu()
    {
        return $this->prixAchatPrevu;
    }

    /**
     * Set prixAchatReel
     *
     * @param float $prixAchatReel
     * @return LigneAffaire
     */
    public function setPrixAchatReel($prixAchatReel)
    {
        $this->prixAchatReel = $prixAchatReel;
    
        return $this;
    }

    /**
     * Get prixAchatReel
     *
     * @return float 
     */
    public function getPrixAchatReel()
    {
        return $this->prixAchatReel;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return LigneAffaire
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
     * @return LigneAffaire
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
     * Set refFacture
     *
     * @param \Application\Entity\Facture $refFacture
     * @return LigneAffaire
     */
    public function setRefFacture(\Application\Entity\Facture $refFacture = null)
    {
        $this->refFacture = $refFacture;
    
        return $this;
    }

    /**
     * Get refFacture
     *
     * @return \Application\Entity\Facture 
     */
    public function getRefFacture()
    {
        return $this->refFacture;
    }

    /**
     * Set refConfirmationCommande
     *
     * @param \Application\Entity\ConfirmationCommande $refConfirmationCommande
     * @return LigneAffaire
     */
    public function setRefConfirmationCommande(\Application\Entity\ConfirmationCommande $refConfirmationCommande = null)
    {
        $this->refConfirmationCommande = $refConfirmationCommande;
    
        return $this;
    }

    /**
     * Get refConfirmationCommande
     *
     * @return \Application\Entity\ConfirmationCommande 
     */
    public function getRefConfirmationCommande()
    {
        return $this->refConfirmationCommande;
    }
}
