<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatAffaire
 *
 * @ORM\Table(name="etat_affaire")
 * @ORM\Entity
 */
class EtatAffaire
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
     * @ORM\Column(name="intitule_etat", type="string", length=80, nullable=false)
     */
    private $intituleEtat;


}
