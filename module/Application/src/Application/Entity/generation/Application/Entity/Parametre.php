<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametre
 *
 * @ORM\Table(name="parametre")
 * @ORM\Entity
 */
class Parametre
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
     * @ORM\Column(name="intitule_parametre", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleParametre;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur_texte", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $valeurTexte;

    /**
     * @var integer
     *
     * @ORM\Column(name="valeur_entiere", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $valeurEntiere;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur_decimale", type="float", precision=10, scale=0, nullable=true, unique=false)
     */
    private $valeurDecimale;


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
     * Set intituleParametre
     *
     * @param string $intituleParametre
     * @return Parametre
     */
    public function setIntituleParametre($intituleParametre)
    {
        $this->intituleParametre = $intituleParametre;
    
        return $this;
    }

    /**
     * Get intituleParametre
     *
     * @return string 
     */
    public function getIntituleParametre()
    {
        return $this->intituleParametre;
    }

    /**
     * Set valeurTexte
     *
     * @param string $valeurTexte
     * @return Parametre
     */
    public function setValeurTexte($valeurTexte)
    {
        $this->valeurTexte = $valeurTexte;
    
        return $this;
    }

    /**
     * Get valeurTexte
     *
     * @return string 
     */
    public function getValeurTexte()
    {
        return $this->valeurTexte;
    }

    /**
     * Set valeurEntiere
     *
     * @param integer $valeurEntiere
     * @return Parametre
     */
    public function setValeurEntiere($valeurEntiere)
    {
        $this->valeurEntiere = $valeurEntiere;
    
        return $this;
    }

    /**
     * Get valeurEntiere
     *
     * @return integer 
     */
    public function getValeurEntiere()
    {
        return $this->valeurEntiere;
    }

    /**
     * Set valeurDecimale
     *
     * @param float $valeurDecimale
     * @return Parametre
     */
    public function setValeurDecimale($valeurDecimale)
    {
        $this->valeurDecimale = $valeurDecimale;
    
        return $this;
    }

    /**
     * Get valeurDecimale
     *
     * @return float 
     */
    public function getValeurDecimale()
    {
        return $this->valeurDecimale;
    }
}
