<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientAAdresse
 *
 * @ORM\Table(name="client_a_adresse", indexes={@ORM\Index(name="fk_tbl_societe_has_tbl_adresse_tbl_adresse1_idx", columns={"ref_adresse"}), @ORM\Index(name="fk_tbl_societe_has_tbl_adresse_tbl_societe_idx", columns={"ref_client"})})
 * @ORM\Entity
 */
class ClientAAdresse
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
     * @var \Application\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id", nullable=true)
     * })
     */
    private $refClient;


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
     * @return ClientAAdresse
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
     * @return ClientAAdresse
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
     * @return ClientAAdresse
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
     * @return ClientAAdresse
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
     * @return ClientAAdresse
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
     * Set refClient
     *
     * @param \Application\Entity\Client $refClient
     * @return ClientAAdresse
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
}
