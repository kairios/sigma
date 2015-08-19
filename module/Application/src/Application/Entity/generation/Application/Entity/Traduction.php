<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traduction
 *
 * @ORM\Table(name="traduction")
 * @ORM\Entity
 */
class Traduction
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
     * @ORM\Column(name="fr", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fr;

    /**
     * @var string
     *
     * @ORM\Column(name="en", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $en;


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
     * Set fr
     *
     * @param string $fr
     * @return Traduction
     */
    public function setFr($fr)
    {
        $this->fr = $fr;
    
        return $this;
    }

    /**
     * Get fr
     *
     * @return string 
     */
    public function getFr()
    {
        return $this->fr;
    }

    /**
     * Set en
     *
     * @param string $en
     * @return Traduction
     */
    public function setEn($en)
    {
        $this->en = $en;
    
        return $this;
    }

    /**
     * Get en
     *
     * @return string 
     */
    public function getEn()
    {
        return $this->en;
    }
}
