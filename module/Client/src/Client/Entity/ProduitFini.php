<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Client\Entity\Client;
// use Doctrine\Common\Collections\ArrayCollection;

/**
 * ProduitFini
 *
 * @ORM\Table(name="produit_fini", indexes={@ORM\Index(name="ref_segment", columns={"ref_segment"})})
 * @ORM\Entity
 */
class ProduitFini
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
     * @ORM\Column(name="intitule_produit_fini", type="string", length=50, nullable=false)
     */
    private $intituleProduitFini;

    /**
     * @var \Client\Entity\Segment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_segment", referencedColumnName="id")
     * })
     */
    private $refSegment;

    // /**
    //  * @var \Client\Entity\Client
    //  *
    //  * @ORM\ManyToMany(targetEntity="Client\Entity\Client")
    //  */
    // private $clients;

    // public function __construct()
    // {
    //     $this->clients = new ArrayCollection();
    // }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getIntituleProduitFini()
    {
        return $this->intituleProduitFini;
    }

    public function setIntituleProduitFini($intituleProduitFini)
    {
        $this->intituleProduitFini=$intituleProduitFini;
    }

    public function getRefSegment()
    {
        return $this->refSegment;
    }

    public function setRefSegment($refSegment)
    {
        $this->refSegment=$refSegment;
    }

    // public function addClient(Client $client)
    // {
    //     $this->clients[]=$client;
    //     $client->addSegment($this);
    //     return $this;
    // }

    // public function removeClient(Client $client)
    // {
    //     $this->clients->removeElement($client);
    //     $client->removeSegment($this); //Mais si on supprime le client cela se répercute en base de données /!\
    // }

    // public function getClients()
    // {
    //     return $this->clients;
    // }
}
