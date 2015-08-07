<?php

namespace Adresse\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity
 */
class Adresse
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
     * @ORM\Column(name="rue_1", type="string", length=80, nullable=false)
     */
    private $rue1;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_2", type="string", length=80, nullable=true)
     */
    private $rue2;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_3", type="string", length=50, nullable=true)
     */
    private $rue3;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=15, nullable=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=80, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=20, nullable=false)
     */
    private $pays;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client",inversedBy="adresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur",inversedBy="adresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_fournisseur", referencedColumnName="id")
     * })
     */
    private $refFournisseur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_principale", type="boolean", nullable=false)
     */
    private $adressePrincipale = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_facturation", type="boolean", nullable=false)
     */
    private $adresseFacturation = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_livraison", type="boolean", nullable=false)
     */
    private $adresseLivraison = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="adresse_postale", type="boolean", nullable=false)
     */
    private $adressePostale = '0';

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        /*
        return get_object_vars($this);
        */
        $idClient=$this->getRefClient();
        if(!(empty($idClient)))
            $idClient=$idClient->getId();

        $idFournisseur=$this->getRefFournisseur();
        if(!(empty($idFournisseur)))
            $idFournisseur=$idFournisseur->getId();

        return array(
            'id_adresse'            =>  $this->getId(),
            'rue1'                  =>  $this->getRue1(),
            'rue2'                  =>  $this->getRue2(),
            'rue3'                  =>  $this->getRue3(),
            'code_postal'           =>  $this->getCodePostal(),
            'ville'                 =>  $this->getVille(),
            'pays'                  =>  $this->getPays(),
            'adresse_principale'    =>  $this->getAdressePrincipale(),
            'adresse_livraison'     =>  $this->getAdresseLivraison(),
            'adresse_postale'       =>  $this->getAdressePostale(),
            'adresse_facturation'   =>  $this->getAdresseFacturation(),
            'ref_client'            =>  $idClient,
            'ref_fournisseur'       =>  $idFournisseur
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {

        $refClient          = $em->getRepository('Client\Entity\Client')->find( (int)$data['ref_client'] );
        $refFournisseur     = $em->getRepository('Fournisseur\Entity\Fournisseur')->find( (int)$data['ref_fournisseur']);
        $client             = (!empty($refClient )) ? $refClient : null;
        $fournisseur        = (!empty($refFournisseur)) ? $refFournisseur : null;

        $rue1               = (!empty($data['rue1'])) ? $data['rue1'] : null;
        $rue2               = (!empty($data['rue2'])) ? $data['rue2'] : null;
        $rue3               = (!empty($data['rue3'])) ? $data['rue3'] : null;
        $codePostal         = (!empty($data['code_postal'])) ? $data['code_postal'] : null;
        $ville              = (!empty($data['ville'])) ? $data['ville'] : null;
        $pays               = (!empty($data['pays'])) ? $data['pays'] : null;

        $adressePrincipale  = (( isset($data['type_adresse']) && in_array('adresse_principale', $data['type_adresse']) ) || (isset($data['adresse_principale']) && $data['adresse_principale']) ) ? 1 : 0;
        $adresseFacturation = (( isset($data['type_adresse']) && in_array('adresse_facturation', $data['type_adresse']) ) || (isset($data['adresse_facturation']) && $data['adresse_facturation']) ) ? 1 : 0;
        $adresseLivraison   = (( isset($data['type_adresse']) && in_array('adresse_livraison', $data['type_adresse']) ) || (isset($data['adresse_livraison']) && $data['adresse_livraison']) ) ? 1 : 0;
        $adressePostale     = (( isset($data['type_adresse']) && in_array('adresse_postale', $data['type_adresse']) ) || (isset($data['adresse_postale']) && $data['adresse_postale']) ) ? 1 : 0;
        

        $this->setId($data['id_adresse']);
        $this->setRue1($rue1);
        $this->setRue2($rue2);
        $this->setRue3($rue3);
        $this->setCodePostal($codePostal);
        $this->setVille($ville);
        $this->setPays($pays);
        $this->setRefClient($client);
        $this->setRefFournisseur($fournisseur);
        $this->setAdressePrincipale($adressePrincipale);
        $this->setAdresseFacturation($adresseFacturation);
        $this->setAdresseLivraison($adresseLivraison);
        $this->setAdressePostale($adressePostale);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getRue1()
    {
        return $this->rue1;
    }

    public function setRue1($rue1)
    {
        $this->rue1=$rue1;
    }

    public function getRue2()
    {
        return $this->rue2;
    }

    public function setRue2($rue2)
    {
        $this->rue2=$rue2;
    }

    public function getRue3()
    {
        return $this->rue3;
    }

    public function setRue3($rue3)
    {
        $this->rue3=$rue3;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal)
    {
        $this->codePostal=$codePostal;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville=$ville;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setPays($pays)
    {
        $this->pays=$pays;
    }

    public function getRefClient()
    {
        return $this->refClient;
    }

    public function setRefClient($refClient)
    {
        $this->refClient=$refClient;
    }

    public function getRefFournisseur()
    {
        return $this->refFournisseur;
    }

    public function setRefFournisseur($refFournisseur)
    {
        $this->refFournisseur=$refFournisseur;
    }

    public function getAdressePrincipale()
    {
        return $this->adressePrincipale;
    }

    public function setAdressePrincipale($adressePrincipale)
    {
        $this->adressePrincipale=$adressePrincipale;
    }

    public function getAdressePostale()
    {
        return $this->adressePostale;
    }

    public function setAdressePostale($adressePostale)
    {
        $this->adressePostale=$adressePostale;
    }

    public function getAdresseFacturation()
    {
        return $this->adresseFacturation;
    }

    public function setAdresseFacturation($adresseFacturation)
    {
        $this->adresseFacturation=$adresseFacturation;
    }

    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison($adresseLivraison)
    {
        $this->adresseLivraison=$adresseLivraison;
    }
}