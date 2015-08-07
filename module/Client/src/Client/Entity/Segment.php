<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Client\Entity\Client;
// use Doctrine\Common\Collections\ArrayCollection;

/**
 * Segment
 *
 * @ORM\Table(name="segment", indexes={@ORM\Index(name="fk_segment_type_segment1_idx", columns={"ref_type_segment"})})
 * @ORM\Entity
 */
class Segment
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
     * @ORM\Column(name="intitule_segment", type="string", length=50, nullable=false)
     */
    private $intituleSegment;

    /**
     * @var \Client\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\TypeSegment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id")
     * })
     */
    private $refTypeSegment;

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

    public function getIntituleSegment()
    {
        return $this->intituleSegment;
    }

    public function setIntituleSegment($intituleSegment)
    {
        $this->intituleSegment=$intituleSegment;
    }

    public function getRefTypeSegment()
    {
        return $this->refTypeSegment;
    }

    public function setRefTypeSegment($refTypeSegment)
    {
        $this->refTypeSegment=$refTypeSegment;
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

    /**
     * [findSegmentByTypeSegment description]
     * @param  ServiceLocator $sm
     * @param  int $typeSegment (ID du type de segment)
     * @return array              (Array de Segment)
     */
    public function findSegmentByTypeSegment($sm,$typeSegment)
    {
        $idType = (int)$typeSegment;

        $query =   
            "SELECT id, intitule_segment 
             FROM segment
             WHERE ref_type_segment = $idType"
        ;

        $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results = $statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }
}
