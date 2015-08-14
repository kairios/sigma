<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonnelAMetier
 *
 * @ORM\Table(name="personnel_a_metier", uniqueConstraints={@ORM\UniqueConstraint(name="ref_personnel_2", columns={"ref_personnel", "ref_metier"})}, indexes={@ORM\Index(name="ref_personnel", columns={"ref_personnel"}), @ORM\Index(name="ref_metier", columns={"ref_metier"})})
 * @ORM\Entity
 */
class PersonnelAMetier
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
     * @var \Application\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var \Application\Entity\Metier
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Metier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_metier", referencedColumnName="id")
     * })
     */
    private $refMetier;


}
