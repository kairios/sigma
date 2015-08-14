<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
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
     * @ORM\Column(name="code_produit", type="string", length=50, nullable=false)
     */
    private $codeProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_produit", type="string", length=120, nullable=false)
     */
    private $intituleProduit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="datetime", nullable=false)
     */
    private $dateCreationModificationFiche = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;


}
