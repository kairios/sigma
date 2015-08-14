<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RaisonPerte
 *
 * @ORM\Table(name="raison_perte")
 * @ORM\Entity
 */
class RaisonPerte
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
     * @ORM\Column(name="intitule_raison_perte", type="string", length=100, nullable=false)
     */
    private $intituleRaisonPerte;


}
