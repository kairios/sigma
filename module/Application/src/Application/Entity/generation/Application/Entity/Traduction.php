<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traduction
 *
 * @ORM\Table(name="traduction")
 * @ORM\Entity
 */
class Traduction
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
     * @ORM\Column(name="fr", type="text", nullable=true)
     */
    private $fr;

    /**
     * @var string
     *
     * @ORM\Column(name="en", type="text", nullable=true)
     */
    private $en;


}
