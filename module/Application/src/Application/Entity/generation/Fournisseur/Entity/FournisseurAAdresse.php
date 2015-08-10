<?php

namespace Fournisseur\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FournisseurAAdresse
 *
 * @ORM\Table(name="fournisseur_a_adresse", indexes={@ORM\Index(name="fk_tbl_fournisseur_has_adresse_adresse1_idx", columns={"ref_adresse"}), @ORM\Index(name="fk_tbl_fournisseur_has_adresse_tbl_fournisseur1_idx", columns={"ref_fournisseur"})})
 * @ORM\Entity
 */
class FournisseurAAdresse
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
     * @var boolean
     *
     * @ORM\Column(name="adresse_principale", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $adressePrincipale;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_facturation", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $adresseFacturation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_livraison", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $adresseLivraison;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_postale", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $adressePostale;

    /**
     * @var \Application\Entity\Adresse
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_adresse", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAdresse;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adressePrincipale
     *
     * @param boolean $adressePrincipale
     * @return FournisseurAAdresse
     */
    public function setAdressePrincipale($adressePrincipale)
    {
        $this->adressePrincipale = $adressePrincipale;
    
        return $this;
    }

    /**
     * Get adressePrincipale
     *
     * @return boolean 
     */
    public function getAdressePrincipale()
    {
        return $this->adressePrincipale;
    }

    /**
     * Set adresseFacturation
     *
     * @param boolean $adresseFacturation
     * @return FournisseurAAdresse
     */
    public function setAdresseFacturation($adresseFacturation)
    {
        $this->adresseFacturation = $adresseFacturation;
    
        return $this;
    }

    /**
     * Get adresseFacturation
     *
     * @return boolean 
     */
    public function getAdresseFacturation()
    {
        return $this->adresseFacturation;
    }

    /**
     * Set adresseLivraison
     *
     * @param boolean $adresseLivraison
     * @return FournisseurAAdresse
     */
    public function setAdresseLivraison($adresseLivraison)
    {
        $this->adresseLivraison = $adresseLivraison;
    
        return $this;
    }

    /**
     * Get adresseLivraison
     *
     * @return boolean 
     */
    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }

    /**
     * Set adressePostale
     *
     * @param boolean $adressePostale
     * @return FournisseurAAdresse
     */
    public function setAdressePostale($adressePostale)
    {
        $this->adressePostale = $adressePostale;
    
        return $this;
    }

    /**
     * Get adressePostale
     *
     * @return boolean 
     */
    public function getAdressePostale()
    {
        return $this->adressePostale;
    }

    /**
     * Set refAdresse
     *
     * @param \Application\Entity\Adresse $refAdresse
     * @return FournisseurAAdresse
     */
    public function setRefAdresse(\Application\Entity\Adresse $refAdresse = null)
    {
        $this->refAdresse = $refAdresse;
    
        return $this;
    }

    /**
     * Get refAdresse
     *
     * @return \Application\Entity\Adresse 
     */
    public function getRefAdresse()
    {
        return $this->refAdresse;
    }

    /**
     * Set refFournisseur
     *
     * @param \Application\Entity\Fournisseur $refFournisseur
     * @return FournisseurAAdresse
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
}
