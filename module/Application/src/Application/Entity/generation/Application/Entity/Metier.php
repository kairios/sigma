<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metier
 *
 * @ORM\Table(name="metier", indexes={@ORM\Index(name="ref_poste", columns={"ref_poste"})})
 * @ORM\Entity
 */
class Metier
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
     * @ORM\Column(name="intitule_metier", type="string", length=80, nullable=false)
     */
    private $intituleMetier;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_horaire", type="integer", nullable=false)
     */
    private $prixHoraire = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ref_poste", type="integer", nullable=true)
     */
    private $refPoste;


}
