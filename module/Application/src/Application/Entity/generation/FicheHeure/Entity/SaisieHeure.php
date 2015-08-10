<?php

namespace FicheHeure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeure
 *
 * @ORM\Table(name="saisie_heure", indexes={@ORM\Index(name="ref_personnel", columns={"ref_personnel"}), @ORM\Index(name="ref_libelle", columns={"ref_libelle"}), @ORM\Index(name="ref_affaire", columns={"ref_affaire"}), @ORM\Index(name="ref_poste", columns={"ref_poste"})})
 * @ORM\Entity
 */
class SaisieHeure
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $heureFin;

    /**
     * @var float
     *
     * @ORM\Column(name="duree_pause", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $dureePause;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $nbHeure;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $supprime;

    /**
     * @var \FicheHeure\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPersonnel;

    /**
     * @var \FicheHeure\Entity\SaisieHeureLibelle
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\SaisieHeureLibelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_libelle", referencedColumnName="id", nullable=true)
     * })
     */
    private $refLibelle;

    /**
     * @var \FicheHeure\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAffaire;

    /**
     * @var \FicheHeure\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPoste;


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
     * Set date
     *
     * @param \DateTime $date
     * @return SaisieHeure
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     * @return SaisieHeure
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    
        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     * @return SaisieHeure
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    
        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set dureePause
     *
     * @param float $dureePause
     * @return SaisieHeure
     */
    public function setDureePause($dureePause)
    {
        $this->dureePause = $dureePause;
    
        return $this;
    }

    /**
     * Get dureePause
     *
     * @return float 
     */
    public function getDureePause()
    {
        return $this->dureePause;
    }

    /**
     * Set nbHeure
     *
     * @param float $nbHeure
     * @return SaisieHeure
     */
    public function setNbHeure($nbHeure)
    {
        $this->nbHeure = $nbHeure;
    
        return $this;
    }

    /**
     * Get nbHeure
     *
     * @return float 
     */
    public function getNbHeure()
    {
        return $this->nbHeure;
    }

    /**
     * Set supprime
     *
     * @param boolean $supprime
     * @return SaisieHeure
     */
    public function setSupprime($supprime)
    {
        $this->supprime = $supprime;
    
        return $this;
    }

    /**
     * Get supprime
     *
     * @return boolean 
     */
    public function getSupprime()
    {
        return $this->supprime;
    }

    /**
     * Set refPersonnel
     *
     * @param \FicheHeure\Entity\Personnel $refPersonnel
     * @return SaisieHeure
     */
    public function setRefPersonnel(\FicheHeure\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \FicheHeure\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }

    /**
     * Set refLibelle
     *
     * @param \FicheHeure\Entity\SaisieHeureLibelle $refLibelle
     * @return SaisieHeure
     */
    public function setRefLibelle(\FicheHeure\Entity\SaisieHeureLibelle $refLibelle = null)
    {
        $this->refLibelle = $refLibelle;
    
        return $this;
    }

    /**
     * Get refLibelle
     *
     * @return \FicheHeure\Entity\SaisieHeureLibelle 
     */
    public function getRefLibelle()
    {
        return $this->refLibelle;
    }

    /**
     * Set refAffaire
     *
     * @param \FicheHeure\Entity\Affaire $refAffaire
     * @return SaisieHeure
     */
    public function setRefAffaire(\FicheHeure\Entity\Affaire $refAffaire = null)
    {
        $this->refAffaire = $refAffaire;
    
        return $this;
    }

    /**
     * Get refAffaire
     *
     * @return \FicheHeure\Entity\Affaire 
     */
    public function getRefAffaire()
    {
        return $this->refAffaire;
    }

    /**
     * Set refPoste
     *
     * @param \FicheHeure\Entity\PosteCout $refPoste
     * @return SaisieHeure
     */
    public function setRefPoste(\FicheHeure\Entity\PosteCout $refPoste = null)
    {
        $this->refPoste = $refPoste;
    
        return $this;
    }

    /**
     * Get refPoste
     *
     * @return \FicheHeure\Entity\PosteCout 
     */
    public function getRefPoste()
    {
        return $this->refPoste;
    }
}
