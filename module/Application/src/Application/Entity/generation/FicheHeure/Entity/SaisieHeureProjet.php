<?php

namespace FicheHeure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeureProjet
 *
 * @ORM\Table(name="saisie_heure_projet", indexes={@ORM\Index(name="ref_libelle", columns={"ref_libelle"}), @ORM\Index(name="ref_affaire", columns={"ref_affaire"}), @ORM\Index(name="ref_poste", columns={"ref_poste"}), @ORM\Index(name="ref_saisie_horaire", columns={"ref_saisie_horaire"})})
 * @ORM\Entity
 */
class SaisieHeureProjet
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
     * @var \FicheHeure\Entity\SaisieHeureJournee
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\SaisieHeureJournee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_saisie_horaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refSaisieHoraire;


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
     * Set nbHeure
     *
     * @param float $nbHeure
     * @return SaisieHeureProjet
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
     * @return SaisieHeureProjet
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
     * Set refLibelle
     *
     * @param \FicheHeure\Entity\SaisieHeureLibelle $refLibelle
     * @return SaisieHeureProjet
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
     * @return SaisieHeureProjet
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
     * @return SaisieHeureProjet
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

    /**
     * Set refSaisieHoraire
     *
     * @param \FicheHeure\Entity\SaisieHeureJournee $refSaisieHoraire
     * @return SaisieHeureProjet
     */
    public function setRefSaisieHoraire(\FicheHeure\Entity\SaisieHeureJournee $refSaisieHoraire = null)
    {
        $this->refSaisieHoraire = $refSaisieHoraire;
    
        return $this;
    }

    /**
     * Get refSaisieHoraire
     *
     * @return \FicheHeure\Entity\SaisieHeureJournee 
     */
    public function getRefSaisieHoraire()
    {
        return $this->refSaisieHoraire;
    }
}
