<?php

namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \Client\Entity\ProduitFini
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\ProduitFini")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="refProduitFini_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $refProduitFini;


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
     * @return ClientAProduitFini
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
     * Set refProduitFini
     *
     * @param \Client\Entity\ProduitFini $refProduitFini
     * @return ClientAProduitFini
     */
    public function setRefProduitFini(\Client\Entity\ProduitFini $refProduitFini)
    {
        $this->refProduitFini = $refProduitFini;
    
        return $this;
    }

    /**
     * Get refProduitFini
     *
     * @return \Client\Entity\ProduitFini 
     */
    public function getRefProduitFini()
    {
        return $this->refProduitFini;
    }
}
