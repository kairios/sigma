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
     * @var integer
     *
     * @ORM\Column(name="intitule_etat_affaire", type="integer", nullable=false)
     */
    private $intituleEtatAffaire;


}
