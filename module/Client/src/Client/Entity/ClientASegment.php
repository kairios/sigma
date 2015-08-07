<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-09 11:46:01
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-09 13:58:58
 */

// module\Client\src\Client\Entity\ClientASegment.php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Client\Entity\Client;
use Client\Entity\Segment;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
	private $id;

	/**
	 * @var \Client\Entity\Client
	 *
	 * @ORM\ManyToOne(targetEntity="\Client\Entity\Client")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $refClient;

	/**
	 * @var \Client\Entity\Segment
	 *
	 * @ORM\ManyToOne(targetEntity="\Client\Entity\Segment")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $refSegment;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id=$id;
	}

	public function getRefClient()
	{
		return $this->refClient;
	}

	public function setRefClient($refClient)
	{
		$this->refClient=$refClient;
	}

	public function getRefSegment()
	{
		return $this->refSegment;
	}

	public function setRefSegment($refSegment)
	{
		$this->refSegment = $refSegment;
	}
}

?>