<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientASegment
 *
 * @ORM\Table(name="client_a_segment", indexes={@ORM\Index(name="ref_client", columns={"ref_client"}), @ORM\Index(name="ref_segment", columns={"ref_segment"})})
 * @ORM\Entity
 */
class ClientASegment
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
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="refClient_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $refClient;

    /**
     * @var \Client\Entity\Segment
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="refSegment_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $refSegment;


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
     * Set refClient
     *
     * @param \Client\Entity\Client $refClient
     * @return ClientASegment
     */
    public function setRefClient(\Client\Entity\Client $refClient)
    {
        $this->refClient = $refClient;
    
        return $this;
    }

    /**
     * Get refClient
     *
     * @return \Client\Entity\Client 
     */
    public function getRefClient()
    {
        return $this->refClient;
    }

    /**
     * Set refSegment
     *
     * @param \Client\Entity\Segment $refSegment
     * @return ClientASegment
     */
    public function setRefSegment(\Client\Entity\Segment $refSegment)
    {
        $this->refSegment = $refSegment;
    
        return $this;
    }

    /**
     * Get refSegment
     *
     * @return \Client\Entity\Segment 
     */
    public function getRefSegment()
    {
        return $this->refSegment;
    }
}
