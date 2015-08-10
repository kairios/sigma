<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeSegment
 *
 * @ORM\Table(name="type_segment")
 * @ORM\Entity
 */
class TypeSegment
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
     * @ORM\Column(name="intitule_type_segment", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intituleTypeSegment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Client\Entity\Client", mappedBy="refTypeSegment")
     */
    private $clients;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set intituleTypeSegment
     *
     * @param string $intituleTypeSegment
     * @return TypeSegment
     */
    public function setIntituleTypeSegment($intituleTypeSegment)
    {
        $this->intituleTypeSegment = $intituleTypeSegment;
    
        return $this;
    }

    /**
     * Get intituleTypeSegment
     *
     * @return string 
     */
    public function getIntituleTypeSegment()
    {
        return $this->intituleTypeSegment;
    }

    /**
     * Add clients
     *
     * @param \Client\Entity\Client $clients
     * @return TypeSegment
     */
    public function addClient(\Client\Entity\Client $clients)
    {
        $this->clients[] = $clients;
    
        return $this;
    }

    /**
     * Remove clients
     *
     * @param \Client\Entity\Client $clients
     */
    public function removeClient(\Client\Entity\Client $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClients()
    {
        return $this->clients;
    }
}
