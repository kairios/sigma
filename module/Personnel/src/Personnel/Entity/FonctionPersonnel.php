<?php

namespace Personnel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FonctionPersonnel
 *
 * @ORM\Table(name="fonction_personnel")
 * @ORM\Entity
 */
class FonctionPersonnel
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
     * @ORM\Column(name="intitule_fonction", type="string", length=100, nullable=false)
     */
    private $intituleFonction;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIntituleFonction()
    {
        return $this->intituleFonction;
    }

    public function setIntituleFonction($intituleFonction)
    {
        $this->intituleFonction = $intituleFonction;
    }

    // /**
    //  * Convert the object to an array.
    //  *
    //  * @return array
    //  */
    // public function getArrayCopy() 
    // {
    //     return array(
    //         'id_personnel'          =>  $this->getId(),
    //         'nom'                   =>  $this->getNom(),
    //         'prenom'                =>  $this->getPrenom(),
    //         'email'                 =>  $this->getEmail(),
    //         'mot_de_passe'          =>  $this->getMotDePasse(),
    //         'administrateur'        =>  $this->getAdministrateur(),
    //         'taux_horaire'          =>  $this->getTauxHoraire(),
    //     );
    // }
  
    // /**
    //  * Populate from an array.
    //  *
    //  * @param array $data
    //  */
    // public function exchangeArray($data = array(),$em=null) 
    // {
    //     $nom            = (!empty($data['nom'])) ? $data['nom'] : null;
    //     $prenom         = (!empty($data['prenom'])) ? $data['prenom'] : null;
    //     $email          = (!empty($data['email'])) ? $data['email'] : null;
    //     $tauxHoraire    = (!empty($data['taux_horaire'])) ? $data['taux_horaire'] : null;
    //     $motDePasse     = (!empty($data['mot_de_passe'])) ? $data['mot_de_passe'] : null;
        
    //     $this->setId($data['id_personnel']);
    //     $this->setNom($nom);
    //     $this->setPrenom($prenom);
    //     $this->setEmail($email);
    //     $this->setTauxHoraire($tauxHoraire);
    //     $this->setMotDePasse($motDePasse);
    //     $this->setAdminitrateur($data['administrateur']);
    //     $this->dateCreationModificationFiche = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
    // }
}

?>