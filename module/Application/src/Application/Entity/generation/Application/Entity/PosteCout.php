<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PosteCout
 *
 * @ORM\Table(name="poste_cout", indexes={@ORM\Index(name="ref_categorie", columns={"ref_categorie"})})
 * @ORM\Entity
 */
class PosteCout
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
     * @ORM\Column(name="intitule_poste", type="string", length=80, nullable=false)
     */
    private $intitulePoste;

    /**
     * @var integer
     *
     * @ORM\Column(name="ref_categorie", type="integer", nullable=false)
     */
    private $refCategorie;


}
