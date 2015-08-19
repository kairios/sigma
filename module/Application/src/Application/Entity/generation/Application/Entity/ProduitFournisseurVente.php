<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitFournisseurVente
 *
 * @ORM\Table(name="produit_fournisseur_vente")
 * @ORM\Entity
 */
class ProduitFournisseurVente
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
     * @var integer
     *
     * @ORM\Column(name="ref_produit_fournisseur", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $refProduitFournisseur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $prixVente;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $coefficient;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
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
     * Set refProduitFournisseur
     *
     * @param integer $refProduitFournisseur
     * @return ProduitFournisseurVente
     */
    public function setRefProduitFournisseur($refProduitFournisseur)
    {
        $this->refProduitFournisseur = $refProduitFournisseur;
    
        return $this;
    }

    /**
     * Get refProduitFournisseur
     *
     * @return integer 
     */
    public function getRefProduitFournisseur()
    {
        return $this->refProduitFournisseur;
    }

    /**
     * Set prixVente
     *
     * @param float $prixVente
     * @return ProduitFournisseurVente
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
     * Set coefficient
     *
     * @param integer $coefficient
     * @return ProduitFournisseurVente
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    
        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer 
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return ProduitFournisseurVente
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
}
