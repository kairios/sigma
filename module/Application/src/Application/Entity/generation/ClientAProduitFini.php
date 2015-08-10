<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ClientAProduitFini
 *
 * @ORM\Table(name="client_a_produit_fini", uniqueConstraints={@ORM\UniqueConstraint(name="ref_client_a_produit_fini", columns={"ref_client", "ref_produit_fini"})}, indexes={@ORM\Index(name="ref_client", columns={"ref_client"}), @ORM\Index(name="ref_produit_fini", columns={"ref_produit_fini"})})
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
     * @var \ProduitFini
     *
     * @ORM\ManyToOne(targetEntity="ProduitFini")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit_fini", referencedColumnName="id")
     * })
     */
    private $refProduitFini;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;


}
