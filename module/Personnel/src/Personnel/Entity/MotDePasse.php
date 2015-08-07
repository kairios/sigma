<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-28 13:34:15
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-28 13:37:20
 */

namespace Personnel\Entity;

// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

/**
 * Personnel
 */
class MotDePasse
{
	private $ancienMotDePasse;
	private $nouveauMotDePasse;
	private $confirmationNouveau;

	public function getAncientMotDePasse()
	{
		return $this->ancienMotDePasse;
	}
	
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        // $fonction = '';
        $idFonction=$this->getRefFonction();
        if(!(empty($idFonction)))
        {
            // $fonction=$idFonction->getIntituleFonction();
            $idFonction=$idFonction->getId();
        }

        return array(
            'id_personnel'          =>  $this->getId(),
            'nom'                   =>  $this->getNom(),
            'prenom'                =>  $this->getPrenom(),
            'email'                 =>  $this->getEmail(),
            'mot_de_passe'          =>  $this->getMotDePasse(),
            'administrateur'        =>  $this->getAdministrateur(),
            'taux_horaire'          =>  $this->getTauxHoraire(),
            'ref_fonction'          =>  $idFonction,

        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refFonction    = $em->getRepository('Personnel\Entity\FonctionPersonnel')->find( (int)$data['ref_fonction'] );
        $fonction       = (!empty($refFonction)) ? $refFonction : null;

        $nom                            = (!empty($data['nom'])) ? $data['nom'] : null;
        $prenom                         = (!empty($data['prenom'])) ? $data['prenom'] : null;
        $email                          = (!empty($data['email'])) ? $data['email'] : null;
        $tauxHoraire                    = (!empty($data['taux_horaire'])) ? $data['taux_horaire'] : null;
        //$motDePasse                     = (!empty($data['mot_de_passe'])) ? $data['mot_de_passe'] : null;
        $dateCreationModificationFiche  = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
        
        $this->setId($data['id_personnel']);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setTauxHoraire($tauxHoraire);
        //$this->setMotDePasse($motDePasse);
        $this->setAdminitrateur($data['administrateur']);
        $this->setDateCreationModification($dateCreationModificationFiche);
        $this->setRefFonction($fonction);

        
    }
}

?>