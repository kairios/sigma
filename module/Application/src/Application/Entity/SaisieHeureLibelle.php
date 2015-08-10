<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SaisieHeureLibelle
 *
 * @ORM\Table(name="saisie_heure_libelle")
 * @ORM\Entity
 */
class SaisieHeureLibelle
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
     * @ORM\Column(name="intitule_libelle", type="string", length=50, nullable=false)
     */
    private $intituleLibelle;

    /**
     * @var string
     *
     * @ORM\Column(name="value_libelle", type="string", length=50, nullable=true)
     */
    private $valueLibelle;


}
