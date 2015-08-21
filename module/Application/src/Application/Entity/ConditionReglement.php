<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * ConditionReglement
 *
 * @ORM\Table(name="condition_reglement")
 * @ORM\Entity
 */
class ConditionReglement
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
     * @ORM\Column(name="intitule_condition_reglement", type="string", length=300, nullable=false)
     */
    private $intituleConditionReglement;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getIntituleConditionReglement()
    {
        return $this->intituleConditionReglement;
    }

    public function setIntituleConditionReglement($intituleConditionReglement)
    {
        $this->intituleConditionReglement=$intituleConditionReglement;
    }

    public function getIntitulesConditionReglement($sm)
    {
        $query =   
            "SELECT intitule_condition_reglement
             FROM condition_reglement"
        ;
        $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results = $statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }

        return array();
    }
}
