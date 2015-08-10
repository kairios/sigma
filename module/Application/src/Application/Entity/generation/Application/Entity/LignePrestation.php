<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LignePrestation
 *
 * @ORM\Table(name="ligne_prestation", indexes={@ORM\Index(name="ref_ligne_affaire", columns={"ref_ligne_affaire"}), @ORM\Index(name="ref_personnel", columns={"ref_personnel"}), @ORM\Index(name="ref_metier", columns={"ref_metier"}), @ORM\Index(name="ref_poste", columns={"ref_poste"})})
 * @ORM\Entity
 */
class LignePrestation
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
     * @ORM\Column(name="nb_heure_prevu", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nbHeurePrevu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_heure_reel", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nbHeureReel;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_vente", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $montantVente;

    /**
     * @var float
     *
     * @ORM\Column(name="cout_interne_prevu", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $coutInternePrevu;

    /**
     * @var float
     *
     * @ORM\Column(name="cout_interne_reel", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $coutInterneReel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="effectuee", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $effectuee;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $remarques;

    /**
     * @var \Application\Entity\LigneAffaire
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\LigneAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_ligne_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refLigneAffaire;

    /**
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id", nullable=true)
     * })
     */
    private $refPersonnel;

    /**
     * @var \Application\Entity\Metier
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Metier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_metier", referencedColumnName="id", nullable=true)
     * })
     */
    private $refMetier;

    /**
     * @var \Application\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PosteCout")
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
     * Set nbHeurePrevu
     *
     * @param integer $nbHeurePrevu
     * @return LignePrestation
     */
    public function setNbHeurePrevu($nbHeurePrevu)
    {
        $this->nbHeurePrevu = $nbHeurePrevu;
    
        return $this;
    }

    /**
     * Get nbHeurePrevu
     *
     * @return integer 
     */
    public function getNbHeurePrevu()
    {
        return $this->nbHeurePrevu;
    }

    /**
     * Set nbHeureReel
     *
     * @param integer $nbHeureReel
     * @return LignePrestation
     */
    public function setNbHeureReel($nbHeureReel)
    {
        $this->nbHeureReel = $nbHeureReel;
    
        return $this;
    }

    /**
     * Get nbHeureReel
     *
     * @return integer 
     */
    public function getNbHeureReel()
    {
        return $this->nbHeureReel;
    }

    /**
     * Set montantVente
     *
     * @param float $montantVente
     * @return LignePrestation
     */
    public function setMontantVente($montantVente)
    {
        $this->montantVente = $montantVente;
    
        return $this;
    }

    /**
     * Get montantVente
     *
     * @return float 
     */
    public function getMontantVente()
    {
        return $this->montantVente;
    }

    /**
     * Set coutInternePrevu
     *
     * @param float $coutInternePrevu
     * @return LignePrestation
     */
    public function setCoutInternePrevu($coutInternePrevu)
    {
        $this->coutInternePrevu = $coutInternePrevu;
    
        return $this;
    }

    /**
     * Get coutInternePrevu
     *
     * @return float 
     */
    public function getCoutInternePrevu()
    {
        return $this->coutInternePrevu;
    }

    /**
     * Set coutInterneReel
     *
     * @param float $coutInterneReel
     * @return LignePrestation
     */
    public function setCoutInterneReel($coutInterneReel)
    {
        $this->coutInterneReel = $coutInterneReel;
    
        return $this;
    }

    /**
     * Get coutInterneReel
     *
     * @return float 
     */
    public function getCoutInterneReel()
    {
        return $this->coutInterneReel;
    }

    /**
     * Set effectuee
     *
     * @param boolean $effectuee
     * @return LignePrestation
     */
    public function setEffectuee($effectuee)
    {
        $this->effectuee = $effectuee;
    
        return $this;
    }

    /**
     * Get effectuee
     *
     * @return boolean 
     */
    public function getEffectuee()
    {
        return $this->effectuee;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return LignePrestation
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
     * Set refLigneAffaire
     *
     * @param \Application\Entity\LigneAffaire $refLigneAffaire
     * @return LignePrestation
     */
    public function setRefLigneAffaire(\Application\Entity\LigneAffaire $refLigneAffaire = null)
    {
        $this->refLigneAffaire = $refLigneAffaire;
    
        return $this;
    }

    /**
     * Get refLigneAffaire
     *
     * @return \Application\Entity\LigneAffaire 
     */
    public function getRefLigneAffaire()
    {
        return $this->refLigneAffaire;
    }

    /**
     * Set refPersonnel
     *
     * @param \Application\Entity\Personnel $refPersonnel
     * @return LignePrestation
     */
    public function setRefPersonnel(\Application\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Application\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }

    /**
     * Set refMetier
     *
     * @param \Application\Entity\Metier $refMetier
     * @return LignePrestation
     */
    public function setRefMetier(\Application\Entity\Metier $refMetier = null)
    {
        $this->refMetier = $refMetier;
    
        return $this;
    }

    /**
     * Get refMetier
     *
     * @return \Application\Entity\Metier 
     */
    public function getRefMetier()
    {
        return $this->refMetier;
    }

    /**
     * Set refPoste
     *
     * @param \Application\Entity\PosteCout $refPoste
     * @return LignePrestation
     */
    public function setRefPoste(\Application\Entity\PosteCout $refPoste = null)
    {
        $this->refPoste = $refPoste;
    
        return $this;
    }

    /**
     * Get refPoste
     *
     * @return \Application\Entity\PosteCout 
     */
    public function getRefPoste()
    {
        return $this->refPoste;
    }
}
