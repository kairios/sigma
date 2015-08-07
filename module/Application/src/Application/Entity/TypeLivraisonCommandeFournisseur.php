<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeLivraisonCommandeFournisseur
 *
 * @ORM\Table(name="type_livraison_commande_fournisseur")
 * @ORM\Entity
 */
class TypeLivraisonCommandeFournisseur
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
     * @ORM\Column(name="ref_intitule_type_livraison", type="integer", nullable=false)
     */
    private $refIntituleTypeLivraison;


}
