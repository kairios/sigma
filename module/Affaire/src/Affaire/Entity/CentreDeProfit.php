<?php

namespace Affaire\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * CentreDeProfit
 *
 * @ORM\Table(name="centre_de_profit")
 * @ORM\Entity
 */
class CentreDeProfit
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
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_centre", type="string", length=50, nullable=false)
     */
    private $intituleCentre;

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
     * Set numero
     *
     * @param integer $numero
     * @return CentreDeProfit
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set intituleCentre
     *
     * @param string $intituleCentre
     * @return CentreDeProfit
     */
    public function setIntituleCentre($intituleCentre)
    {
        $this->intituleCentre = $intituleCentre;
    
        return $this;
    }

    /**
     * Get intituleCentre
     *
     * @return string 
     */
    public function getIntituleCentre()
    {
        return $this->intituleCentre;
    }

    public function getCentresProfit($sm)
    {
        $query      = "SELECT id, CONCAT_WS('-',numero, intitule_centre) as intitule_centre FROM centre_de_profit ORDER BY intitule_centre ASC ";
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