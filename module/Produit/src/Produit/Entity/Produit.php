<?php

namespace Produit\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

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
     * @var \Application\Entity\Traduction
     *
     * @ORM\OneToOne(targetEntity="Application\Entity\Traduction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_intitule_produit", referencedColumnName="id")
     * })
     */
    private $refIntituleProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="integer", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text", nullable=true)
     */
    private $remarques;

    public function __construct()
    {
        $this->dateCreationModificationFiche = time();
    }

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
     * Set codeProduit
     *
     * @param string $codeProduit
     * @return Produit
     */
    public function setCodeProduit($codeProduit)
    {
        $this->codeProduit = $codeProduit;
    
        return $this;
    }

    /**
     * Get codeProduit
     *
     * @return string 
     */
    public function getCodeProduit()
    {
        return $this->codeProduit;
    }

    /**
     * Set dateCreationModificationFiche
     *
     * @param integer $dateCreationModificationFiche
     * @return Produit
     */
    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {
        $this->dateCreationModificationFiche = $dateCreationModificationFiche;
    
        return $this;
    }

    /**
     * Get dateCreationModificationFiche
     *
     * @return integer 
     */
    public function getDateCreationModificationFiche()
    {
        return $this->dateCreationModificationFiche;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     * @return Produit
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;
    
        return $this;
    }

    /**
     * Get remarques
     *
     * @return string 
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set refIntituleProduit
     *
     * @param \Application\Entity\Traduction $refIntituleProduit
     * @return Produit
     */
    public function setRefIntituleProduit(\Application\Entity\Traduction $refIntituleProduit = null)
    {
        $this->refIntituleProduit = $refIntituleProduit;
    
        return $this;
    }

    /**
     * Get refIntituleProduit
     *
     * @return \Application\Entity\Traduction 
     */
    public function getRefIntituleProduit()
    {
        return $this->refIntituleProduit;
    }

    // public function getProduitByCodeAndIntitule($sm,$locale)
    // {
    //     if($locale == 'en_US')
    //     {
    //         $lang = 'en';
    //     }
    //     else
    //     {
    //         $lang = 'fr';
    //     }

    //     $query =   
    //         "SELECT p.id, p.code_produit, t.$lang
    //          FROM produit AS p
    //             LEFT JOIN traduction AS t
    //                 ON p.ref_intitule_produit = t.id
    //          /*WHERE ref_client = $id*/"
    //     ;
    //     $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
    //     $results = $statement->execute();

    //     if($results->isQueryResult())
    //     {
    //         $resultSet=new ResultSet;
    //         $resultSet->initialize($results);
    //         return $resultSet->toArray();
    //     }
    // }

    public function getIntitulesProduits($sm,$locale,$code = null, $intitule = null, $limit = null)
    {
        if($locale == 'en_US')
        {
            $lang = 'en';
        }
        else
        {
            $lang = 'fr';
        }

        $query =   
            "SELECT p.id, p.code_produit, t.$lang as intitule_produit
             FROM produit AS p
                LEFT JOIN traduction AS t
                    ON p.ref_intitule_produit = t.id "
        ;

        if(!is_null($code))
        {
            $query .= " WHERE p.code_produit LIKE '$code%' ";
        }
        else if(!is_null($intitule))
        {
            $query .= " WHERE t.$lang LIKE '$intitule%' ";
        }

        if(!is_null($limit))
        {
            $query .= " LIMIT $limit ";
        }

        $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results = $statement->execute();

        if($results->isQueryResult())
        {
            $resultSet=new ResultSet;
            $resultSet->initialize($results);
            return $resultSet->toArray();
        }
    }

}
