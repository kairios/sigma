<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentreDeProfit
 *
 * @ORM\Table(name="centre_de_profit")
 * @ORM\Entity
 */
class CentreDeProfit
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
     * @var integer
     *
     * @ORM\Column(name="numero_centre_profit", type="integer", nullable=false)
     */
    private $numeroCentreProfit;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_centre_profit", type="string", length=50, nullable=false)
     */
    private $intituleCentreProfit;


}
