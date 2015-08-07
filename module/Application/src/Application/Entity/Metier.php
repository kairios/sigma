<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-21 10:50:25
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-21 11:03:39
 */

// module\Application\src\Application\Entity\Metier.php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metier
 *
 * @ORM\Table(name="metier")
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
	 * @ORM\Column(name="intitule_metier",type="string", length=200, nullable=false)
	 */
	private $intituleMetier;

	 /**
     * @var \Application\Entity\Poste
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Poste")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="ref_poste", referencedColumnName="id")
     * })
     */
	private $refPoste;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getIntituleMetier()
	{
		return $this->intituleMetier;
	}

	public function setIntituleMetier($intituleMetier)
	{
		$this->intituleMetier = $intituleMetier;
	}

	public function getRefPoste()
	{
		return $this->refPoste;
	}

	public function setRefPoste($efPoste)
	{
		$this->refPoste = $refPoste;
	}
}

?>