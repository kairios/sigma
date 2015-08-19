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
     * @var string
     *
     * @ORM\Column(name="intitule_saisie", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleSaisie;

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
     * @var \Affaire\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id", nullable=true)
     * })
     */
    private $refAffaire;

    /**
     * @var \Affaire\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\PosteCout")
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
     * Set intituleSaisie
     *
     * @param string $intituleSaisie
     * @return SaisieHeureProjet
     */
    public function setIntituleSaisie($intituleSaisie)
    {
        $this->intituleSaisie = $intituleSaisie;
    
        return $this;
    }

    /**
     * Get intituleSaisie
     *
     * @return string 
     */
    public function getIntituleSaisie()
    {
        return $this->intituleSaisie;
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
     * @param \Affaire\Entity\Affaire $refAffaire
     * @return SaisieHeureProjet
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
     * @return SaisieHeureProjet
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
