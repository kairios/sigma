<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitACategorie
 *
 * @ORM\Table(name="produit_a_categorie", uniqueConstraints={@ORM\UniqueConstraint(name="ref_produit_2", columns={"ref_produit", "ref_produit_fini"})}, indexes={@ORM\Index(name="ref_produit", columns={"ref_produit"}), @ORM\Index(name="ref_produit_fini", columns={"ref_produit_fini"})})
 * @ORM\Entity
 */
class ProduitACategorie
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
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit", referencedColumnName="id")
     * })
     */
    private $refProduit;

    /**
     * @var \ProduitFini
     *
     * @ORM\ManyToOne(targetEntity="ProduitFini")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_produit_fini", referencedColumnName="id")
     * })
     */
    private $refProduitFini;


}
