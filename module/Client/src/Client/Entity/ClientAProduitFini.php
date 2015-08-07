<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-09 11:46:01
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-09 13:55:58
 */

// module\Client\src\Client\Entity\ClientAProduitsFinis

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Client\Entity\Client;
use Client\Entity\ProduitFini;

/**
 * ClientAProduitFini
 *
 * @ORM\Table(name="client_a_produit_fini", indexes={@ORM\Index(name="ref_client", columns={"ref_client"}), @ORM\Index(name="ref_produit_fini", columns={"ref_produit_fini"})})
 * @ORM\Entity
 */
class ClientAProduitFini
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
	 * @var \Client\Entity\ProduitFini
	 *
	 * @ORM\ManyToOne(targetEntity="\Client\Entity\ProduitFini")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $refProduitFini;

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

	public function getRefPorduitFini()
	{
		return $this->refProduitFini;
	}

	public function setRefProduitFini($refProduitFini)
	{
		$this->refProduitFini = $refProduitFini;
	}
}

?>