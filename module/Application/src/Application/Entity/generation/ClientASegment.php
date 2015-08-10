<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ClientASegment
 *
 * @ORM\Table(name="client_a_segment", uniqueConstraints={@ORM\UniqueConstraint(name="ref_client_a_segment", columns={"ref_client", "ref_segment"})}, indexes={@ORM\Index(name="ref_client", columns={"ref_client"}), @ORM\Index(name="ref_segment", columns={"ref_segment"})})
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
     * @var \Segment
     *
     * @ORM\ManyToOne(targetEntity="Segment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_segment", referencedColumnName="id")
     * })
     */
    private $refSegment;

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
