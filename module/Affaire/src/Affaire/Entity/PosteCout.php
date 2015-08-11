<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

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
     * @var \CategoriePoste
     *
     * @ORM\ManyToOne(targetEntity="CategoriePoste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_categorie", referencedColumnName="id")
     * })
     */
    private $refCategorie;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitulePoste
     *
     * @param string $intitulePoste
     * @return PosteCout
     */
    public function setIntitulePoste($intitulePoste)
    {
        $this->intitulePoste = $intitulePoste;
    
        return $this;
    }

    /**
     * Get intitulePoste
     *
     * @return string 
     */
    public function getIntitulePoste()
    {
        return $this->intitulePoste;
    }
    
    /**
     * Set refCategorie
     *
     * @param \Affaire\Entity\CategoriePoste $refCategorie
     * @return PosteCout
     */
    public function setRefCategorie($refCategorie)
    {
        $this->refCategorie = $refCategorie;
    
        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Affaire\Entity\CategoriePoste 
     */
    public function getRefCategorie()
    {
        return $this->refCategorie;
    }

    public function getPostesCout($sm)
    {
        $query      = "SELECT id,intitule_poste FROM poste_cout ORDER BY intitule_poste ASC ";
        $statement  = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results    = $statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }
}

?>