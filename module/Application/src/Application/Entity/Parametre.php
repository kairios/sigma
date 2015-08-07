<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametre
 *
 * @ORM\Table(name="parametre")
 * @ORM\Entity
 */
class Parametre
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
     * @ORM\Column(name="intitule_parametre", type="string", length=100, nullable=false)
     */
    private $intituleParametre;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur_texte", type="text", nullable=true)
     */
    private $valeurTexte;

    /**
     * @var integer
     *
     * @ORM\Column(name="valeur_entiere", type="integer", nullable=true)
     */
    private $valeurEntiere;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur_decimale", type="float", precision=10, scale=0, nullable=true)
     */
    private $valeurDecimale;


}
