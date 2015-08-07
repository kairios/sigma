<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieFournisseur
 *
 * @ORM\Table(name="categorie_fournisseur", uniqueConstraints={@ORM\UniqueConstraint(name="intitule_categorie_fournisseur", columns={"intitule_categorie_fournisseur"})})
 * @ORM\Entity
 */
class CategorieFournisseur
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
     * @ORM\Column(name="intitule_categorie_fournisseur", type="string", length=50, nullable=false)
     */
    private $intituleCategorieFournisseur;


}
