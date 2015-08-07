<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeSegment
 *
 * @ORM\Table(name="type_segment")
 * @ORM\Entity
 */
class TypeSegment
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
     * @ORM\Column(name="intitule_type_segment", type="string", length=200, nullable=false)
     */
    private $intituleTypeSegment;


}
