<?php

namespace FicheHeure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Personnel\Entity\Personnel;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_debut", type="float", precision=10, scale=0, nullable=false)
     */
    private $heureDebut;

    /**
     * @var float
     *
     * @ORM\Column(name="heure_fin", type="float", precision=10, scale=0, nullable=false)
     */
    private $heureFin;

    /**
     * @var float
     *
     * @ORM\Column(name="duree_pause", type="float", precision=10, scale=0, nullable=false)
     */
    private $dureePause = 1;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbHeureTotal = 0;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    public function __construct($refPersonnel,$date)
    {
        $this->date         = $date;

        $this->refPersonnel = $refPersonnel;
        $this->heureDebut   = $refPersonnel->getHeureDebut('lundi');
        $this->heureFin     = $refPersonnel->getHeureFin('lundi');
        $this->dureePause   = $refPersonnel->getDureePause('lundi');
    }

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
     * @return integer 
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set date
     *
     * @param string $date
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
     * @return string 
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

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idPersonnel = $this->getRefPersonnel();
        if(!(empty($idPersonnel)))
            $idPersonnel = $idPersonnel->getId();      

        return array(
            'id_saisie_horaire'     =>  $this->getId(),
            'date'                  =>  $this->getDate(),
            'heure_debut'           =>  $this->getHeureDebut(),
            'heure_fin'             =>  $this->getHeureFin(),
            'duree_pause'           =>  $this->getDureePause(),
            'nb_heure_total'        =>  $this->getNbHeureTotal(),
            'ref_personnel'         =>  $idPersonnel
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refPersonnel   = $em->getRepository('Personnel\Entity\Personnel')->find( (int)$data['ref_personnel'] );
        $personnel      = (!empty($refPersonnel)) ? $refPersonnel : null;

        $heure_debut    = (!empty($data['heure_debut'])) ? $data['heure_debut']: null;
        $heure_fin      = (!empty($data['heure_fin'])) ? $data['heure_fin']: null;
        $duree_pause    = (!empty($data['duree_pause'])) ? str_replace(',','.',$data['duree_pause']) : null;
        $nb_heure_total = $heure_fin - $heure_debut - $duree_pause;

        // On recupère la date sous forme de timestamp
        list($y,$m,$d)  = explode('-', $data['date']); // Split day, month and year in chaines
        $date           = mktime(4, 0, 0, (int) $m, (int) $d, (int) $y); // Retourne un timestamp

        $this->setId($data['id_saisie_horaire']);
        $this->setDate($date);
        $this->setHeureDebut($heure_debut);
        $this->setHeureFin($heure_fin);
        $this->setDureePause($duree_pause);
        $this->setNbHeureTotal($nb_heure_total);
        $this->setRefPersonnel($personnel);

        // $this->dateCreationModificationFiche = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
    }


}
