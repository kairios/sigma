<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Client\Entity\Client;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_type_segment", type="string", length=50, nullable=false)
     */
    private $intituleTypeSegment;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\OneToMany(targetEntity="Client\Entity\Client", mappedBy="refTypeSegment")
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getIntituleTypeSegment()
    {
        return $this->intituleTypeSegment;
    }

    public function setIntituleTypeSegment($intituleTypeSegment)
    {
        $this->intituleTypeSegment=$intituleTypeSegment;
    }

    public function addClient(Client $client)
    {
        $this->clients[]=$client;
        $client->setRefTypeSegment($this);
        return $this;
    }

    public function removeClient(Client $client)
    {
        $this->clients->removeElement($client);
        $client->setRefTypeSegment(null); //Mais si on supprime le client cela se répercute en base de données /!\
    }

    public function getClients()
    {
        return $this->clients;
    }
}
