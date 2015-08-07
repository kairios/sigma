<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActiviteFournisseur
 *
 * @ORM\Table(name="activite_fournisseur", uniqueConstraints={@ORM\UniqueConstraint(name="intitule_activite", columns={"intitule_activite"})})
 * @ORM\Entity
 */
class ActiviteFournisseur
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
     * @ORM\Column(name="intitule_activite", type="string", length=50, nullable=false)
     */
    private $intituleActivite;


}
