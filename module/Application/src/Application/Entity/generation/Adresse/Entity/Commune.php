<?php

namespace Adresse\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commune
 *
 * @ORM\Table(name="commune")
 * @ORM\Entity
 */
class Commune
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
     * @ORM\Column(name="code_pays", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $codePays;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codePays
     *
     * @param string $codePays
     * @return Commune
     */
    public function setCodePays($codePays)
    {
        $this->codePays = $codePays;
    
        return $this;
    }

    /**
     * Get codePays
     *
     * @return string 
     */
    public function getCodePays()
    {
        return $this->codePays;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     * @return Commune
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
     * @return Commune
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
}
