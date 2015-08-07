<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TagFicheHeure
 *
 * @ORM\Table(name="tag_fiche_heure")
 * @ORM\Entity
 */
class TagFicheHeure
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
     * @ORM\Column(name="intitule_tag", type="string", length=30, nullable=false)
     */
    private $intituleTag;


}
