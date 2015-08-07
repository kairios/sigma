<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \Application\Entity\TypeSegment
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\TypeSegment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_type_segment", referencedColumnName="id")
     * })
     */
    private $refTypeSegment;


}
