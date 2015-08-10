<?php

namespace Personnel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnel
 *
 * @ORM\Table(name="personnel")
 * @ORM\Entity
 */
class Personnel
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
     * @ORM\Column(name="prenom", type="string", length=70, precision=0, scale=0, nullable=false, unique=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=70, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $motDePasse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateCreationModification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="administrateur", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $administrateur;

    /**
     * @var float
     *
     * @ORM\Column(name="taux_horaire", type="float", precision=10, scale=0, nullable=true, unique=false)
     */
    private $tauxHoraire;


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
     * Set prenom
     *
     * @param string $prenom
     * @return Personnel
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Personnel
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Personnel
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return Personnel
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    
        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set dateCreationModification
     *
     * @param \DateTime $dateCreationModification
     * @return Personnel
     */
    public function setDateCreationModification($dateCreationModification)
    {
        $this->dateCreationModification = $dateCreationModification;
    
        return $this;
    }

    /**
     * Get dateCreationModification
     *
     * @return \DateTime 
     */
    public function getDateCreationModification()
    {
        return $this->dateCreationModification;
    }

    /**
     * Set administrateur
     *
     * @param boolean $administrateur
     * @return Personnel
     */
    public function setAdministrateur($administrateur)
    {
        $this->administrateur = $administrateur;
    
        return $this;
    }

    /**
     * Get administrateur
     *
     * @return boolean 
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * Set tauxHoraire
     *
     * @param float $tauxHoraire
     * @return Personnel
     */
    public function setTauxHoraire($tauxHoraire)
    {
        $this->tauxHoraire = $tauxHoraire;
    
        return $this;
    }

    /**
     * Get tauxHoraire
     *
     * @return float 
     */
    public function getTauxHoraire()
    {
        return $this->tauxHoraire;
    }
}
