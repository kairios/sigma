<?php

namespace FicheHeure\Entity;

use Doctrine\ORM\Mapping as ORM;
// Pour récupérer des paramètres
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;
/**
 * SaisieHeureProjet
 *
 * @ORM\Table(name="saisie_heure_projet", indexes={@ORM\Index(name="ref_libelle", columns={"ref_libelle"}), @ORM\Index(name="ref_affaire", columns={"ref_affaire"}), @ORM\Index(name="ref_poste", columns={"ref_poste"}), @ORM\Index(name="ref_saisie_horaire", columns={"ref_saisie_horaire"})})
 * @ORM\Entity
 */
class SaisieHeureProjet
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
     * @ORM\Column(name="intitule_saisie", type="string", length=200, nullable=false)
     */
    private $intituleSaisie;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_heure", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbHeure;

    /**
     * @var \FicheHeure\Entity\SaisieHeureLibelle
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\SaisieHeureLibelle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_libelle", referencedColumnName="id")
     * })
     */
    private $refLibelle;

    /**
     * @var \Affaire\Entity\Affaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\Affaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_affaire", referencedColumnName="id")
     * })
     */
    private $refAffaire;

    /**
     * @var \Affaire\Entity\PosteCout
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\PosteCout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_poste", referencedColumnName="id")
     * })
     */
    private $refPoste;

    /**
     * @var \FicheHeure\Entity\SaisieHeureJournee
     *
     * @ORM\ManyToOne(targetEntity="FicheHeure\Entity\SaisieHeureJournee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_saisie_horaire", referencedColumnName="id")
     * })
     */
    private $refSaisieHoraire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="supprime", type="boolean", nullable=false)
     */
    private $supprime = 0;

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
     * Set id
     *
     * @return integer 
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set intituleSaisie
     *
     * @param string $intituleSaisie
     * @return SaisieHeureProjet
     */
    public function setIntituleSaisie($intituleSaisie)
    {
        $this->intituleSaisie = $intituleSaisie;
    
        return $this;
    }

    /**
     * Get intituleSaisie
     *
     * @return string 
     */
    public function getIntituleSaisie()
    {
        return $this->intituleSaisie;
    }

    /**
     * Set nbHeure
     *
     * @param float $nbHeure
     * @return SaisieHeureProjet
     */
    public function setNbHeure($nbHeure)
    {
        $this->nbHeure = $nbHeure;
    
        return $this;
    }

    /**
     * Get nbHeure
     *
     * @return float 
     */
    public function getNbHeure()
    {
        return $this->nbHeure;
    }

    /**
     * Set supprime
     *
     * @param boolean $supprime
     * @return SaisieHeureProjet
     */
    public function setSupprime($supprime)
    {
        $this->supprime = $supprime;
    
        return $this;
    }

    /**
     * Get supprime
     *
     * @return boolean 
     */
    public function getSupprime()
    {
        return $this->supprime;
    }

    /**
     * Set refLibelle
     *
     * @param \FicheHeure\Entity\SaisieHeureLibelle $refLibelle
     * @return SaisieHeureProjet
     */
    public function setRefLibelle(\FicheHeure\Entity\SaisieHeureLibelle $refLibelle = null)
    {
        $this->refLibelle = $refLibelle;
    
        return $this;
    }

    /**
     * Get refLibelle
     *
     * @return \FicheHeure\Entity\SaisieHeureLibelle 
     */
    public function getRefLibelle()
    {
        return $this->refLibelle;
    }

    /**
     * Set refAffaire
     *
     * @param \Affaire\Entity\Affaire $refAffaire
     * @return SaisieHeureProjet
     */
    public function setRefAffaire(\Affaire\Entity\Affaire $refAffaire = null)
    {
        $this->refAffaire = $refAffaire;
    
        return $this;
    }

    /**
     * Get refAffaire
     *
     * @return \Affaire\Entity\Affaire 
     */
    public function getRefAffaire()
    {
        return $this->refAffaire;
    }

    /**
     * Set refPoste
     *
     * @param \Affaire\Entity\PosteCout $refPoste
     * @return SaisieHeureProjet
     */
    public function setRefPoste(\Affaire\Entity\PosteCout $refPoste = null)
    {
        $this->refPoste = $refPoste;
    
        return $this;
    }

    /**
     * Get refPoste
     *
     * @return \Affaire\Entity\PosteCout 
     */
    public function getRefPoste()
    {
        return $this->refPoste;
    }

    /**
     * Set refSaisieHoraire
     *
     * @param \FicheHeure\Entity\SaisieHeureJournee $refSaisieHoraire
     * @return SaisieHeureProjet
     */
    public function setRefSaisieHoraire(\FicheHeure\Entity\SaisieHeureJournee $refSaisieHoraire = null)
    {
        $this->refSaisieHoraire = $refSaisieHoraire;
    
        return $this;
    }

    /**
     * Get refSaisieHoraire
     *
     * @return \FicheHeure\Entity\SaisieHeureJournee 
     */
    public function getRefSaisieHoraire()
    {
        return $this->refSaisieHoraire;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idPoste = $this->getRefPoste();
        if(!(empty($idPoste)))
            $idPoste = $idPoste->getId();

        $idAffaire = $this->getRefAffaire();
        if(!(empty($idAffaire)))
            $idAffaire = $idAffaire->getId();

        $idSaisieHoraire = $this->getRefSaisieHoraire();
        if(!(empty($idSaisieHoraire)))
            $idSaisieHoraire = $idSaisieHoraire->getId();

        $idLibelle = $this->getRefLibelle();
        if(!(empty($idLibelle)))
            $idLibelle = $idLibelle->getId();            

        return array(
            'id_saisie_projet'      =>  $this->getId(),
            'intitule_saisie'       =>  $this->getIntituleSaisie(),
            'nb_heure'              =>  $this->getNbHeure(),
            'ref_saisie_horaire'    =>  $idSaisieHoraire,
            'ref_libelle'           =>  $idLibelle,
            'ref_affaire'           =>  $idAffaire,
            'ref_poste'             =>  $idPoste
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$em=null) 
    {
        $refAffaire         = $em->getRepository('Affaire\Entity\Affaire')->find( (int)$data['ref_affaire'] );
        $refPoste           = $em->getRepository('Application\Entity\PosteCout')->find( (int)$data['ref_poste'] );
        $refLibelle         = $em->getRepository('FicheHeure\Entity\SaisieHeureLibelle')->find( (int)$data['ref_libelle'] );
        $refSaisieHoraire   = $em->getRepository('FicheHeure\Entity\SaisieHeureJournee')->find( (int)$data['ref_saisie_horaire'] );

        $affaire        = (!empty($refAffaire)) ? $refAffaire : null;
        $poste          = (!empty($refPoste)) ? $refPoste : null;
        $libelle        = (!empty($refLibelle)) ? $refLibelle : null;
        $saisieHoraire  = (!empty($refSaisieHoraire)) ? $refSaisieHoraire : null;

        if(!is_null($libelle))
        {
            $this->setIntituleSaisie($libelle->getIntituleLibelle());
        }
        else
        {
            $this->setIntutleSaisie($affaire->getRefClient()->getRaisonSociale().' - '.$affaire->getNumeroAffaire());
        }

        $nbHeure = (!empty($data['nb_heure'])) ? str_replace(',','.',$data['nb_heure']) : null;
        
        $this->setId($data['id_saisie_projet']);
        $this->setRefSaisieHoraire($saisieHoraire);
        $this->setRefLibelle($libelle);
        $this->setRefAffaire($affaire);
        $this->setRefPoste($poste);
        $this->setNbHeure($nbHeure);
        // $this->dateCreationModificationFiche = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArrayFromSaisieHoraire($data = array(),$em=null) 
    {
        // $refSaisieHoraire   = $em->getRepository('FicheHeure\Entity\SaisieHeureJournee')->find( (int)$data['id_saisie_horaire'] );
        $refLibelle         = $em->getRepository('FicheHeure\Entity\SaisieHeureLibelle')->find( (int)$data['ref_libelle'] );
        $refAffaire         = $em->getRepository('Affaire\Entity\Affaire')->find( (int)$data['ref_affaire'] );
        $refPoste           = $em->getRepository('Application\Entity\PosteCout')->find( (int)$data['ref_poste'] );

        // $saisieHoraire  = (!empty($refSaisieHoraire)) ? $refSaisieHoraire : null;
        $libelle        = (!empty($refLibelle)) ? $refLibelle : null;
        $affaire        = (!empty($refAffaire)) ? $refAffaire : null;
        $poste          = (!empty($refPoste)) ? $refPoste : null;

        if(!is_null($libelle))
        {
            $this->setIntituleSaisie($libelle->getIntituleLibelle());
        }
        else
        {
            $this->setIntutleSaisie($affaire->getRefClient()->getRaisonSociale().' - '.$affaire->getNumeroAffaire());
        }

        $nbHeure = (!empty($data['nb_heure'])) ? str_replace(',','.',$data['nb_heure']) : null;
        
        $this->setId($data['id_saisie_horaire']);
        $this->setRefLibelle($libelle);
        $this->setRefAffaire($affaire);
        $this->setRefPoste($poste);
        $this->setNbHeure($nbHeure);
    }

    public function getSaisiesHeureCalendar($personnel, $sm=null)
    {
       $query =   
            "SELECT sp.id, sj.date, sp.intitule_saisie, sp.nb_heure 
             FROM saisie_heure_projet AS sp
                LEFT JOIN saisie_heure_journee AS sj 
                    ON sp.ref_saisie_horaire = sj.id
             WHERE sp.supprime = 0 AND sj.ref_personnel = $personnel"
        ;
        
        $statement = $sm->get('Zend\Db\Adapter\Adapter')->query($query);
        $results = $statement->execute();

        if($results->isQueryResult())
        {
            // Recupération des saisies en BD
            $resultSet=new ResultSet;
            $resultSet->initialize($results);

            $saisiesHoraires = $resultSet->toArray();

            // Conversion en JSON exploitable par sigma.js
            $saisiesJson = '[';
            foreach($saisiesHoraires as $key => $saisie)
            {
                $jour = (int) date('j', $saisie['date']); // jour numérique sans les zéros initiaux : 1 à 31
                $mois = (int) date('n', $saisie['date']) - 1; // mois numérique sans les zéros initiaux : 1 à 12
                $annee = (int) date('Y', $saisie['date']); // full year (4 chiffres)

                $saisiesJson .= "{
                    id: ".$saisie['id'].",
                    title: '".$saisie['intitule_saisie']."',
                    start: new Date(".$annee.", ".$mois.", ".$jour."),
                    end: new Date(".$annee.", ".$mois.", ".$jour."),
                    allDay: false
                },";
            }
            $saisiesJson .= ']';

            return $saisiesJson;
        }

        return '[]';
    }


}
