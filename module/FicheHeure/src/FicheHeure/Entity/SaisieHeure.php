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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date/* = '0000-00-00 00:00:00'*/;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_debut", type="datetime", nullable=false)
     */
    private $heureDebut/* = '0000-00-00 00:00:00'*/;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="datetime", nullable=false)
     */
    private $heureFin /*= '0000-00-00 00:00:00'*/;

    /**
     * @var float
     *
     * @ORM\Column(name="duree_pause", type="float", precision=10, scale=0, nullable=false)
     */
    private $dureePause = 1;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbHeure;

    /**
     * @var \Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var \SaisieHeureLibelle
     *
     * @ORM\ManyToOne(targetEntity="SaisieHeureLibelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_libelle", referencedColumnName="id")
     * })
     */
    private $refLibelle;

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
     * @var \PosteCout
     *
     * @ORM\ManyToOne(targetEntity="PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id")
     * })
     */
    private $refPoste;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = 0;

    public function __construct()
    {
    
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
     * @param \Personnel\Entity\Personnel $refPersonnel
     * @return SaisieHeure
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
     * @param \Affaire\Entity\Affaire $refAffaire
     * @return SaisieHeure
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
     * Set refPoste
     *
     * @param \Affaire\Entity\PosteCout $refPoste
     * @return SaisieHeure
     */
    public function setRefPoste(\Affaire\Entity\PosteCout $refPoste = null)
    {
        $this->refPoste = $refPoste;
    
        return $this;
    }

    /**
     * Get refPoste
     *
     * @return \Affaire\Entity\PosteCout 
     */
    public function getRefPoste()
    {
        return $this->refPoste;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idPoste = $this->getRefPoste();
        if(!(empty($idPoste)))
            $idPoste = $idPoste->getId();

        $idAffaire = $this->getRefAffaire();
        if(!(empty($idAffaire)))
            $idAffaire = $idAffaire->getId();

        $idPersonnel = $this->getRefPersonnel();
        if(!(empty($idPersonnel)))
            $idPersonnel = $idPersonnel->getId();

        $idLibelle = $this->getRefLibelle();
        if(!(empty($idLibelle)))
            $idLibelle = $idLibelle->getId();            

        return array(
            'id_saisie'             =>  $this->getId(),
            'date'                  =>  $this->getDate(),
            'heure_debut'           =>  $this->getHeureDebut(),
            'heure_fin'             =>  $this->getHeureFin(),
            'duree_pause'           =>  $this->getDureePause(),
            'nb_heure'              =>  $this->getNbHeure(),
            'ref_personnel'         =>  $idPersonnel,
            'ref_libelle'           =>  $idLibelle,
            'ref_affaire'           =>  $idAffaire,
            'ref_poste'             =>  $idPoste
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
        $refLibelle     = $em->getRepository('FicheHeure\Entity\SaisieHeureLibelle')->find( (int)$data['ref_libelle'] );
        $refAffaire     = $em->getRepository('Affaire\Entity\Affaire')->find( (int)$data['ref_affaire'] );
        $refPoste       = $em->getRepository('Application\Entity\PosteCout')->find( (int)$data['ref_poste'] );

        $personnel      = (!empty($refPersonnel)) ? $refPersonnel : null;
        $libelle        = (!empty($refLibelle)) ? $refLibelle : null;
        $affaire        = (!empty($refAffaire)) ? $refAffaire : null;
        $poste          = (!empty($refPoste)) ? $refPoste : null;

        $date           = (!empty($data['date'])) ? $data['date'] : null;
        $heure_debut    = (!empty($data['heure_debut'])) ? $data['heure_debut'] : null;
        $heure_fin      = (!empty($data['heure_fin'])) ? $data['heure_fin'] : null;
        $duree_pause    = (!empty($data['duree_pause'])) ? $data['duree_pause'] : null;
        // $nb_heure       = (!empty($data['nb_heure'])) ? $data['nb_heure'] : null; // Calculé en amont
        
        $this->setId($data['id_saisie']);
        $this->setDate($date);
        $this->setHeureDebut($heure_debut);
        $this->setHeureFin($heure_fin);
        $this->setDureePause($duree_pause);
        // $this->setNbHeure($nb_heure);

        $this->setRefPersonnel($personnel);
        $this->setRefLibelle($libelle);
        $this->setRefAffaire($affaire);
        $this->setRefPoste($poste);
        // $this->dateCreationModificationFiche = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
    }

}

?>