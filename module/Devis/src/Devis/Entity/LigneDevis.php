<?php

namespace Devis\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneDevis
 *
 * @ORM\Table(name="ligne_devis", indexes={@ORM\Index(name="fk_ligne_devis_devis1_idx", columns={"ref_devis"})})
 * @ORM\Entity
 */
class LigneDevis
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
     * @ORM\Column(name="intitule_produit", type="string", length=120, nullable=false)
     */
    private $intituleProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite = 1;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixVente = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_prix_vente", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalPrixVente = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var \Devis\Entity\Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis\Entity\Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_devis", referencedColumnName="id")
     * })
     */
    private $refDevis;

    /**
     * @var \Affaire\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id")
     * })
     */
    private $refLigneAffaire;

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
     * @return LigneDevis 
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
     * @return LigneDevis
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
     * Set intituleProduit
     *
     * @param string $intituleProduit
     * @return LigneDevis
     */
    public function setIntituleProduit($intituleProduit)
    {
        $this->intituleProduit = $intituleProduit;
    
        return $this;
    }

    /**
     * Get intituleProduit
     *
     * @return string 
     */
    public function getIntituleProduit()
    {
        return $this->intituleProduit;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return LigneDevis
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prixVente
     *
     * @param float $prixVenteLigneAffaire
     * @return LigneDevis
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;
    
        return $this;
    }

    /**
     * Get prixVente
     *
     * @return float 
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }

    /**
     * Set totalPrixVente
     *
     * @param float $totalPrixVente
     * @return LigneDevis
     */
    public function setTotalPrixVente($totalPrixVente)
    {
        $this->totalPrixVente = $totalPrixVente;
    
        return $this;
    }

    /**
     * Get totalPrixVente
     *
     * @return float 
     */
    public function getTotalPrixVente()
    {
        return $this->totalPrixVente;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return LigneDevis
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
     * Set refDevis
     *
     * @param \Devis\Entity\Devis $refDevis
     * @return LigneDevis
     */
    public function setRefDevis(\Devis\Entity\Devis $refDevis = null)
    {
        $this->refDevis = $refDevis;
    
        return $this;
    }

    /**
     * Get refDevis
     *
     * @return \Devis\Entity\Devis 
     */
    public function getRefDevis()
    {
        return $this->refDevis;
    }

     /**
     * Set refLigneAffaire
     *
     * @param \Affaire\Entity\LigneAffaire $refLigneAffaire
     * @return LigneDevis
     */
    public function setRefLigneAffaire(\Affaire\Entity\LigneAffaire $refLigneAffaire = null)
    {
        $this->refLigneAffaire = $refLigneAffaire;
    
        return $this;
    }

    /**
     * Get refLigneAffaire
     *
     * @return \Affaire\Entity\LigneAffaire 
     */
    public function getRefLigneAffaire()
    {
        return $this->refLigneAffaire;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idDevis = $this->getRefDevis();
        if(!(empty($idDevis)))
            $idDevis=$idDevis->getId();

        $idLigneAffaire = $this->getRefLigneAffaire();
        if(!(empty($idLigneAffaire)))
            $idLigneAffaire=$idLigneAffaire->getId();

        return array(
            'id_ligne_devis'            =>  $this->getId(),
            'code_produit'              =>  $this->getCodeProduit(),
            'intitule_produit'          =>  $this->getIntituleProduit(),
            'quantite'                  =>  $this->getQuantite(),
            'prix_vente'                =>  $this->getPrixVente(),
            'total_prix_vente'          =>  $this->getTotalPrixVente(),
            'remarques'                 =>  $this->getRemarques(),
            'ref_devis'                 =>  $idDevis,
            'ref_ligne_affaire'         =>  $idLigneAffaire
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeProperties($ligneAffaire) 
    {
        $this->setRefLigneAffaire($ligneAffaire);
        $this->setCodeProduit($ligneAffaire->getCodeProduit());
        $this->setIntituleProduit($ligneAffaire->getIntituleLigne());
        $this->setQuantite($ligneAffaire->getQuantitePrevue());
        $this->setPrixVente($ligneAffaire->getPrixUnitaireVente());
        $this->setTotalPrixVente($ligneAffaire->getPrixVentePrevu());
        $this->setRemarques($ligneAffaire->getRemarques());
    }
}

?>
