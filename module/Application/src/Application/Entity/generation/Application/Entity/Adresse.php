<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity
 */
class Adresse
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
     * @ORM\Column(name="rue_1", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $rue1;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_2", type="string", length=80, precision=0, scale=0, nullable=true, unique=false)
     */
    private $rue2;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_3", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $rue3;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $pays;

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
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client", inversedBy="adresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id", nullable=true)
     * })
     */
    private $refClient;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur", inversedBy="adresses")
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
     * Set rue1
     *
     * @param string $rue1
     * @return Adresse
     */
    public function setRue1($rue1)
    {
        $this->rue1 = $rue1;
    
        return $this;
    }

    /**
     * Get rue1
     *
     * @return string 
     */
    public function getRue1()
    {
        return $this->rue1;
    }

    /**
     * Set rue2
     *
     * @param string $rue2
     * @return Adresse
     */
    public function setRue2($rue2)
    {
        $this->rue2 = $rue2;
    
        return $this;
    }

    /**
     * Get rue2
     *
     * @return string 
     */
    public function getRue2()
    {
        return $this->rue2;
    }

    /**
     * Set rue3
     *
     * @param string $rue3
     * @return Adresse
     */
    public function setRue3($rue3)
    {
        $this->rue3 = $rue3;
    
        return $this;
    }

    /**
     * Get rue3
     *
     * @return string 
     */
    public function getRue3()
    {
        return $this->rue3;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     * @return Adresse
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    
        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return Adresse
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set adressePrincipale
     *
     * @param boolean $adressePrincipale
     * @return Adresse
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
     * @return Adresse
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
     * @return Adresse
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
     * @return Adresse
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
     * Set refClient
     *
     * @param \Client\Entity\Client $refClient
     * @return Adresse
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
     * Set refFournisseur
     *
     * @param \Fournisseur\Entity\Fournisseur $refFournisseur
     * @return Adresse
     */
    public function setRefFournisseur(\Fournisseur\Entity\Fournisseur $refFournisseur = null)
    {
        $this->refFournisseur = $refFournisseur;
    
        return $this;
    }

    /**
     * Get refFournisseur
     *
     * @return \Fournisseur\Entity\Fournisseur 
     */
    public function getRefFournisseur()
    {
        return $this->refFournisseur;
    }
}
