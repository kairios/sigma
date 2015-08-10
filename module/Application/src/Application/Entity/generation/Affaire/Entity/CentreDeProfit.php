<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentreDeProfit
 *
 * @ORM\Table(name="centre_de_profit")
 * @ORM\Entity
 */
class CentreDeProfit
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
     * @ORM\Column(name="numero", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_centre", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleCentre;


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
     * Set numero
     *
     * @param integer $numero
     * @return CentreDeProfit
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set intituleCentre
     *
     * @param string $intituleCentre
     * @return CentreDeProfit
     */
    public function setIntituleCentre($intituleCentre)
    {
        $this->intituleCentre = $intituleCentre;
    
        return $this;
    }

    /**
     * Get intituleCentre
     *
     * @return string 
     */
    public function getIntituleCentre()
    {
        return $this->intituleCentre;
    }
}
