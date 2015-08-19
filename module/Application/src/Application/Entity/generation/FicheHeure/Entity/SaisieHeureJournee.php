<?php

namespace FicheHeure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeureJournee
 *
 * @ORM\Table(name="saisie_heure_journee", uniqueConstraints={@ORM\UniqueConstraint(name="ref_personnel_2", columns={"ref_personnel", "date"})}, indexes={@ORM\Index(name="ref_personnel", columns={"ref_personnel"})})
 * @ORM\Entity
 */
class SaisieHeureJournee
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
     * @ORM\Column(name="date", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_debut", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $heureDebut;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_fin", type="float", precision=10, scale=0, nullable=false, unique=false)
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
     * @ORM\Column(name="nb_heure_total", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $nbHeureTotal;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPersonnel;


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
     * @param integer $date
     * @return SaisieHeureJournee
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return integer 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heureDebut
     *
     * @param float $heureDebut
     * @return SaisieHeureJournee
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    
        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return float 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param float $heureFin
     * @return SaisieHeureJournee
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    
        return $this;
    }

    /**
     * Get heureFin
     *
     * @return float 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set dureePause
     *
     * @param float $dureePause
     * @return SaisieHeureJournee
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
     * Set nbHeureTotal
     *
     * @param float $nbHeureTotal
     * @return SaisieHeureJournee
     */
    public function setNbHeureTotal($nbHeureTotal)
    {
        $this->nbHeureTotal = $nbHeureTotal;
    
        return $this;
    }

    /**
     * Get nbHeureTotal
     *
     * @return float 
     */
    public function getNbHeureTotal()
    {
        return $this->nbHeureTotal;
    }

    /**
     * Set refPersonnel
     *
     * @param \Personnel\Entity\Personnel $refPersonnel
     * @return SaisieHeureJournee
     */
    public function setRefPersonnel(\Personnel\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Personnel\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }
}
