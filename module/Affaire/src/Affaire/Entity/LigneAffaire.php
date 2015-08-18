<?php

namespace Affaire\Entity;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_produit", type="string", length=50, nullable=true)
     */
    private $codeProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_ligne", type="string", length=120, nullable=false)
     */
    private $intituleLigne;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite_prevue", type="integer", nullable=false)
     */
    private $quantitePrevue = 1;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUnitaireVente = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_prevu", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVentePrevu = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente_details", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVenteDetails = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_prevu", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatPrevu = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_achat_reel", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAchatReel = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_facture", referencedColumnName="id")
     * })
     */
    private $refFacture;

    /**
     * @var \ConfirmationCommande
     *
     * @ORM\ManyToOne(targetEntity="ConfirmationCommande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_confirmation_commande", referencedColumnName="id")
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
     * Set id
     *
     * @param integer $id
     * @return LigneAffaire 
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set codeProduit
     *
     * @param string $codeProduit
     * @return LigneAffaire
     */
    public function setCodeProduit($codeProduit)
    {
        $this->codeProduit = $codeProduit;
    
        return $this;
    }

    /**
     * Get codeProduit
     *
     * @return string 
     */
    public function getCodeProduit()
    {
        return $this->codeProduit;
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
     * Set quantitePrevue
     *
     * @param integer $quantitePrevue
     * @return LigneAffaire
     */
    public function setQuantitePrevue($quantitePrevue)
    {
        $this->quantitePrevue = $quantitePrevue;
    
        return $this;
    }

    /**
     * Get quantitePrevue
     *
     * @return integer 
     */
    public function getQuantitePrevue()
    {
        return $this->quantitePrevue;
    }

    /**
     * Set prixUnitaireVente
     *
     * @param float $prixUnitaireVente
     * @return LigneAffaire
     */
    public function setPrixUnitaireVente($prixUnitaireVente)
    {
        $this->prixUnitaireVente = $prixUnitaireVente;
    
        return $this;
    }

    /**
     * Get prixUnitaireVente
     *
     * @return float 
     */
    public function getPrixUnitaireVente()
    {
        return $this->prixUnitaireVente;
    }

    /**
     * Set prixVentePrevu
     *
     * @param float $prixVentePrevu
     * @return LigneAffaire
     */
    public function setPrixVentePrevu($prixVentePrevu)
    {
        $this->prixVentePrevu = $prixVentePrevu;
    
        return $this;
    }

    /**
     * Get prixVentePrevu
     *
     * @return float 
     */
    public function getPrixVentePrevu()
    {
        return $this->prixVentePrevu;
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
     * @param \Affaire\Entity\Affaire $refAffaire
     * @return LigneAffaire
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
     * Set refFacture
     *
     * @param \Facture\Entity\Facture $refFacture
     * @return LigneAffaire
     */
    public function setRefFacture(\Facture\Entity\Facture $refFacture = null)
    {
        $this->refFacture = $refFacture;
    
        return $this;
    }

    /**
     * Get refFacture
     *
     * @return \Facture\Entity\Facture 
     */
    public function getRefFacture()
    {
        return $this->refFacture;
    }

    /**
     * Set refConfirmationCommande
     *
     * @param \ConfirmationCommande\Entity\ConfirmationCommande $refConfirmationCommande
     * @return LigneAffaire
     */
    public function setRefConfirmationCommande(\ConfirmationCommande\Entity\ConfirmationCommande $refConfirmationCommande = null)
    {
        $this->refConfirmationCommande = $refConfirmationCommande;
    
        return $this;
    }

    /**
     * Get refConfirmationCommande
     *
     * @return \ConfirmationCommande\Entity\ConfirmationCommande 
     */
    public function getRefConfirmationCommande()
    {
        return $this->refConfirmationCommande;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idAffaire = $this->getRefAffaire();
        if(!(empty($idAffaire)))
            $idAffaire=$idAffaire->getId();

        $idFacture = $this->getRefFacture();
        if(!(empty($idFacture)))
            $idFacture=$idFacture->getId();

        $idConfirmation = $this->getRefConfirmationCommande();
        if(!(empty($idConfirmation)))
            $idConfirmation=$idConfirmation->getId();

        return array(
            'id_ligne_affaire'          =>  $this->getId(),
            'code_produit'              =>  $this->getCodeProduit(),
            'intitule_ligne'            =>  $this->getIntituleLigne(),
            'quantite_prevue'           =>  $this->getQuantitePrevue(),
            'prix_unitaire_vente'       =>  $this->getPrixUnitaireVente(),
            'prix_vente_prevu'          =>  $this->getPrixVentePrevu(),
            'prix_vente_details'        =>  $this->getPrixVenteDetails(),
            'prix_achat_prevu'          =>  $this->getPrixAchatPrevu(),
            'prix_achat_reel'           =>  $this->getPrixAchatReel(),
            'remarques'                 =>  $this->getRemarques(),
            'ref_affaire'               =>  $idAffaire,
            'ref_facture'               =>  $idFacture,
            'ref_confirmation_commande' =>  $idConfirmation
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$sm=null,$em=null) 
    {
        $refAffaire                         = $em->getRepository('Affaire\Entity\Affaire')->find( (int)$data['ref_affaire'] );
        $refFacture                         = $em->getRepository('Facture\Entity\Facture')->find( (int)$data['ref_facture'] );
        $refConfirmation                    = $em->getRepository('ConfirmationCommande\Entity\ConfirmationCommande')->find( (int)$data['ref_confirmation_commande'] );

        $affaire                            = (!empty($refAffaire)) ? $refAffaire : null;
        $facture                            = (!empty($refFacture)) ? $refFacture : null;
        $confirmation                       = (!empty($refConfirmation)) ? $refConfirmation : null;

        $codeProduit                        = (!empty($data['code_produit'])) ? $data['code_produit'] : null;
        $intituleLigne                      = (!empty($data['intitule_ligne'])) ? $data['intitule_ligne'] : null;
        $quantitePrevue                     = (!empty($data['quantite_prevue'])) ? $data['quantite_prevue'] : null;
        $prixUnitaireVente                  = (!empty($data['prix_unitaire_vente'])) ? $data['prix_unitaire_vente'] : null;
        $prixVentePrevu                     = (!empty($data['prix_vente_prevu'])) ? $data['prix_vente_prevu'] : null;
        $prixVenteDetails                   = (!empty($data['prix_vente_details'])) ? $data['prix_vente_details'] : null;
        $prixAchatPrevu                     = (!empty($data['prix_achat_prevu'])) ? $data['prix_achat_prevu'] : null;
        $prixAchatReel                      = (!empty($data['prix_achat_reel'])) ? $data['prix_achat_reel'] : null;
        $remarques                          = (!empty($data['remarques'])) ? $data['remarques'] : null;

        $this->id = $data['id_ligne_affaire'];
        $this->setCodeProduit($codeProduit);
        $this->setIntituleLigne($intituleLigne);
        $this->setQuantitePrevue($quantitePrevue);
        $this->setPrixUnitaireVente($prixUnitaireVente);
        $this->setPrixVentePrevu($prixVentePrevu);
        $this->setPrixVenteDetails($prixVenteDetails);
        $this->setPrixAchatPrevu($prixAchatPrevu);
        $this->setPrixAchatReel($prixAchatReel);
        $this->setRemarques($remarques);

        $this->setRefAffaire($affaire);
        $this->setRefFacture($facture);
        $this->setRefConfirmationCommande($confirmation);
    }

}

?>