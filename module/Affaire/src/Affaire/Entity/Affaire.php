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
 * Affaire
 *
 * @ORM\Table(name="affaire", indexes={@ORM\Index(name="fk_affaire_client1_idx", columns={"ref_client"}), @ORM\Index(name="fk_affaire_interlocuteur_client1_idx", columns={"ref_interlocuteur"}), @ORM\Index(name="fk_affaire_tbl_personnel1_idx", columns={"ref_personnel"}), @ORM\Index(name="fk_affaire_centre_de_profit1_idx", columns={"ref_centre_profit"}), @ORM\Index(name="fk_affaire_condition_reglement1_idx", columns={"ref_condition_reglement"}), @ORM\Index(name="ref_concurrent", columns={"ref_concurrent"}), @ORM\Index(name="ref_devis_signe", columns={"ref_devis_signe"})})
 * @ORM\Entity
 */
class Affaire
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
     * @ORM\Column(name="numero_auto", type="integer", nullable=false)
     */
    private $numeroAuto;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_affaire", type="string", length=30, nullable=false)
     */
    private $numeroAffaire;

    /**
     * @var string
     *
     * @ORM\Column(name="designation_affaire", type="string", length=150, nullable=true)
     */
    private $designationAffaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_creation_modification_fiche", type="integer", nullable=false)
     */
    private $dateCreationModificationFiche;

    /**
     * @var integer
     *
     * @ORM\Column(name="exercice", type="integer", nullable=false)
     */
    private $exercice;

    /**
     * @var string
     *
     * @ORM\Column(name="demande_client", type="text", nullable=true)
     */
    private $demandeClient;

    /**
     * @var float
     *
     * @ORM\Column(name="remise", type="float", precision=10, scale=0, nullable=false)
     */
    private $remise = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="frais_port", type="float", precision=10, scale=0, nullable=false)
     */
    private $fraisPort = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_commande_client", type="string", length=70, nullable=true)
     */
    private $referenceCommandeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_demande_prix", type="string", length=50, nullable=true)
     */
    private $referenceDemandePrix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suivi_budget_actif", type="boolean", nullable=false)
     */
    private $suiviBudgetActif = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_debut", type="integer", nullable=false)
     */
    private $dateDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_fin", type="integer", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_perte", type="string", length=150, nullable=true)
     */
    private $raisonPerte;

    /**
     * @var \Affaire\Entity\EtatAffaire
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\EtatAffaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_etat_affaire", referencedColumnName="id")
     * })
     */
    private $refEtatAffaire;

    /**
     * @var \Client\Entity\InterlocuteurClient
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\InterlocuteurClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_interlocuteur", referencedColumnName="id")
     * })
     */
    private $refInterlocuteur;

    /**
     * @var \Personnel\Entity\Personnel
     *
     * @ORM\ManyToOne(targetEntity="Personnel\Entity\Personnel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_personnel", referencedColumnName="id")
     * })
     */
    private $refPersonnel;

    /**
     * @var \Application\Entity\ConditionReglement
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ConditionReglement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_condition_reglement", referencedColumnName="id")
     * })
     */
    private $refConditionReglement;

    /**
     * @var \Fournisseur\Entity\Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur\Entity\Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_concurrent", referencedColumnName="id")
     * })
     */
    private $refConcurrent;

    /**
     * @var \Devis\Entity\Devis
     *
     * @ORM\ManyToOne(targetEntity="Devis\Entity\Devis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_devis_signe", referencedColumnName="id")
     * })
     */
    private $refDevisSigne;

    /**
     * @var \Affaire\Entity\CentreDeProfit
     *
     * @ORM\ManyToOne(targetEntity="Affaire\Entity\CentreDeProfit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_centre_profit", referencedColumnName="id")
     * })
     */
    private $refCentreProfit;

    /**
     * @var \Client\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Client\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_client", referencedColumnName="id")
     * })
     */
    private $refClient;

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
     * @param integer $id
     * @return Affaire
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set numeroAuto
     *
     * @param integer $numeroAuto
     * @return Affaire
     */
    public function setNumeroAuto($numeroAuto)
    {
        $this->numeroAuto = $numeroAuto;
    
        return $this;
    }

    /**
     * Get numeroAuto
     *
     * @return string 
     */
    public function getNumeroAuto()
    {
        return $this->numeroAuto;
    }

    /**
     * Set numeroAffaire
     *
     * @param string $numeroAffaire
     * @return Affaire
     */
    public function setNumeroAffaire($numeroAffaire)
    {
        $this->numeroAffaire = $numeroAffaire;
    
        return $this;
    }

    /**
     * Get numeroAffaire
     *
     * @return string 
     */
    public function getNumeroAffaire()
    {
        return $this->numeroAffaire;
    }

    /**
     * Set designationAffaire
     *
     * @param string $designationAffaire
     * @return Affaire
     */
    public function setDesignationAffaire($designationAffaire)
    {
        $this->designationAffaire = $designationAffaire;
    
        return $this;
    }

    /**
     * Get designationAffaire
     *
     * @return string 
     */
    public function getDesignationAffaire()
    {
        return $this->designationAffaire;
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
     * Set dateCreationModificationFiche
     *
     * @param integer $dateCreationModificationFiche
     * @return Affaire
     */
    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {
        $this->dateCreationModificationFiche=$dateCreationModificationFiche;
    }

    /**
     * Set exercice
     *
     * @param integer $exercice
     * @return Affaire
     */
    public function setExercice($exercice)
    {
        $this->exercice = $exercice;
    
        return $this;
    }

    /**
     * Get exercice
     *
     * @return integer 
     */
    public function getExercice()
    {
        return $this->exercice;
    }

    /**
     * Set demandeClient
     *
     * @param string $demandeClient
     * @return Affaire
     */
    public function setDemandeClient($demandeClient)
    {
        $this->demandeClient = $demandeClient;
    
        return $this;
    }

    /**
     * Get demandeClient
     *
     * @return string 
     */
    public function getDemandeClient()
    {
        return $this->demandeClient;
    }

    /**
     * Set remise
     *
     * @param float $remise
     * @return Affaire
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;
    
        return $this;
    }

    /**
     * Get remise
     *
     * @return float 
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set fraisPort
     *
     * @param float $fraisPort
     * @return Affaire
     */
    public function setFraisPort($fraisPort)
    {
        $this->fraisPort = $fraisPort;
    
        return $this;
    }

    /**
     * Get fraisPort
     *
     * @return float 
     */
    public function getFraisPort()
    {
        return $this->fraisPort;
    }

    /**
     * Set referenceCommandeClient
     *
     * @param string $referenceCommandeClient
     * @return Affaire
     */
    public function setReferenceCommandeClient($referenceCommandeClient)
    {
        $this->referenceCommandeClient = $referenceCommandeClient;
    
        return $this;
    }

    /**
     * Get referenceCommandeClient
     *
     * @return string 
     */
    public function getReferenceCommandeClient()
    {
        return $this->referenceCommandeClient;
    }

    /**
     * Set referenceDemandePrix
     *
     * @param string $referenceDemandePrix
     * @return Affaire
     */
    public function setReferenceDemandePrix($referenceDemandePrix)
    {
        $this->referenceDemandePrix = $referenceDemandePrix;
    
        return $this;
    }

    /**
     * Get referenceDemandePrix
     *
     * @return string 
     */
    public function getReferenceDemandePrix()
    {
        return $this->referenceDemandePrix;
    }

    /**
     * Set suiviBudgetActif
     *
     * @param boolean $suiviBudgetActif
     * @return Affaire
     */
    public function setSuiviBudgetActif($suiviBudgetActif)
    {
        $this->suiviBudgetActif = $suiviBudgetActif;
    
        return $this;
    }

    /**
     * Get suiviBudgetActif
     *
     * @return boolean 
     */
    public function getSuiviBudgetActif()
    {
        return $this->suiviBudgetActif;
    }

    /**
     * Set dateDebut
     *
     * @param integer $dateDebut
     * @return Affaire
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return integer 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param integer $dateFin
     * @return Affaire
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return integer 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set raisonPerte
     *
     * @param string $raisonPerte
     * @return Affaire
     */
    public function setRaisonPerte($raisonPerte)
    {
        $this->raisonPerte = $raisonPerte;
    
        return $this;
    }

    /**
     * Get raisonPerte
     *
     * @return string 
     */
    public function getRaisonPerte()
    {
        return $this->raisonPerte;
    }

    /**
     * Set refEtatAffaire
     *
     * @param \Affaire\Entity\EtatAffaire $refEtatAffaire
     * @return Affaire
     */
    public function setRefEtatAffaire($refEtatAffaire)
    {
        $this->refEtatAffaire = $refEtatAffaire;
    
        return $this;
    }

    /**
     * Get refEtatAffaire
     *
     * @return \Affaire\Entity\EtatAffaire 
     */
    public function getRefEtatAffaire()
    {
        return $this->refEtatAffaire;
    }

    /**
     * Set refInterlocuteur
     *
     * @param \Client\Entity\InterlocuteurClient $refInterlocuteur
     * @return Affaire
     */
    public function setRefInterlocuteur(\Client\Entity\InterlocuteurClient $refInterlocuteur = null)
    {
        $this->refInterlocuteur = $refInterlocuteur;
    
        return $this;
    }

    /**
     * Get refInterlocuteur
     *
     * @return \Client\Entity\InterlocuteurClient 
     */
    public function getRefInterlocuteur()
    {
        return $this->refInterlocuteur;
    }

    /**
     * Set refPersonnel
     *
     * @param \Personnel\Entity\Personnel $refPersonnel
     * @return Affaire
     */
    public function setRefPersonnel(\Personnel\Entity\Personnel $refPersonnel = null)
    {
        $this->refPersonnel = $refPersonnel;
    
        return $this;
    }

    /**
     * Get refPersonnel
     *
     * @return \Personnel\Entity\Personnel 
     */
    public function getRefPersonnel()
    {
        return $this->refPersonnel;
    }

    /**
     * Set refConditionReglement
     *
     * @param \Application\Entity\ConditionReglement $refConditionReglement
     * @return Affaire
     */
    public function setRefConditionReglement(\Application\Entity\ConditionReglement $refConditionReglement = null)
    {
        $this->refConditionReglement = $refConditionReglement;
    
        return $this;
    }

    /**
     * Get refConditionReglement
     *
     * @return \Application\Entity\ConditionReglement 
     */
    public function getRefConditionReglement()
    {
        return $this->refConditionReglement;
    }

    /**
     * Set refConcurrent
     *
     * @param \Fournisseur\Entity\Fournisseur $refConcurrent
     * @return Affaire
     */
    public function setRefConcurrent(\Fournisseur\Entity\Fournisseur $refConcurrent = null)
    {
        $this->refConcurrent = $refConcurrent;
    
        return $this;
    }

    /**
     * Get refConcurrent
     *
     * @return \Fournisseur\Entity\Fournisseur 
     */
    public function getRefConcurrent()
    {
        return $this->refConcurrent;
    }

    /**
     * Set refDevisSigne
     *
     * @param \Devis\Entity\Devis $refDevisSigne
     * @return Affaire
     */
    public function setRefDevisSigne(\Devis\Entity\Devis $refDevisSigne = null)
    {
        $this->refDevisSigne = $refDevisSigne;
    
        return $this;
    }

    /**
     * Get refDevisSigne
     *
     * @return \Devis\Entity\Devis 
     */
    public function getRefDevisSigne()
    {
        return $this->refDevisSigne;
    }

    /**
     * Set refCentreProfit
     *
     * @param \Affaire\Entity\CentreDeProfit $refCentreProfit
     * @return Affaire
     */
    public function setRefCentreProfit(\Affaire\Entity\CentreDeProfit $refCentreProfit = null)
    {
        $this->refCentreProfit = $refCentreProfit;
    
        return $this;
    }

    /**
     * Get refCentreProfit
     *
     * @return \Affaire\Entity\CentreDeProfit 
     */
    public function getRefCentreProfit()
    {
        return $this->refCentreProfit;
    }

    /**
     * Set refClient
     *
     * @param \Client\Entity\Client $refClient
     * @return Affaire
     */
    public function setRefClient(\Client\Entity\Client $refClient = null)
    {
        $this->refClient = $refClient;
    
        return $this;
    }

    /**
     * Get refClient
     *
     * @return \Client\Entity\Client 
     */
    public function getRefClient()
    {
        return $this->refClient;
    }

    public function __construct()
    {
        $this->dateDebut = time();
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        $idCentre = $this->getRefCentreProfit();
        if(!(empty($idCentre)))
            $idCentre=$idCentre->getId();

        $idClient = $this->getRefClient();
        if(!(empty($idClient)))
            $idClient=$idClient->getId();

        $idInterlocuteur = $this->getRefInterlocuteur();
        if(!(empty($idInterlocuteur)))
            $idInterlocuteur=$idInterlocuteur->getId();

        $idPersonnel = $this->getRefPersonnel();
        if(!(empty($idPersonnel)))
            $idPersonnel=$idPersonnel->getId();

        $idEtat = $this->getRefEtatAffaire();
        if(!(empty($idEtat)))
            $idEtat=$idEtat->getId();

        $idConcurrent = $this->getRefConcurrent();
        if(!(empty($idConcurrent)))
            $idConcurrent=$idConcurrent->getId();

        $idDevis = $this->getRefDevisSigne();
        if(!(empty($idDevis)))
            $idDevis=$idDevis->getId();

        $idConditionReglement = $this->getRefConditionReglement();
        if(!(empty($idConditionReglement)))
            $idConditionReglement=$idConditionReglement->getId();

        // $idModeReglement = $this->getRefModeReglement();
        // if(!(empty($idModeReglement)))
        //     $idModeReglement=$idModeReglement->getId();

        return array(
            'id_affaire'                =>  $this->getId(),
            'numero_auto'               =>  $this->getNumeroAuto(),
            'numero_affaire'            =>  $this->getNumeroAffaire(),
            'designation_affaire'       =>  $this->getDesignationAffaire(),
            'exercice'                  =>  $this->getExercice(),
            'demande_client'            =>  $this->getDemandeClient(),
            'remise'                    =>  $this->getRemise(),
            'frais_port'                =>  $this->getFraisPort(),
            'reference_commande_client' =>  $this->getReferenceCommandeClient(),
            'reference_demande_prix'    =>  $this->getReferenceDemandePrix(),
            'suivi_budget_actif'        =>  $this->getSuiviBudgetActif(),
            'date_debut'                =>  $this->getDateDebut(),
            'date_fin'                  =>  $this->getDateFin(),
            'raison_perte'              =>  $this->getRaisonPerte(),

            'ref_centre_profit'         =>  $idCentre,
            'ref_client'                =>  $idClient,
            'ref_interlocuteur'         =>  $idInterlocuteur,
            'ref_condition_reglement'   =>  $idConditionReglement,
            'ref_personnel'             =>  $idPersonnel,
            'ref_etat_affaire'              =>  $idEtat(),
            'ref_concurrent'            =>  $idConcurrent,
            'ref_devis_signe'           =>  $idDevis
        );
    }
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array(),$sm=null,$em=null) 
    {
        $refCentreProfit                    = $em->getRepository('Affaire\Entity\CentreDeProfit')->find( (int)$data['ref_centre_profit'] );
        $refClient                          = $em->getRepository('Client\Entity\Client')->find( (int)$data['ref_client'] );
        $refInterlocuteur                   = $em->getRepository('Client\Entity\InterlocuteurClient')->find( (int)$data['ref_interlocuteur'] );
        $refPersonnel                       = $em->getRepository('Personnel\Entity\Personnel')->find( (int)$data['ref_personnel'] );
        $refConditionReglement              = $em->getRepository('Application\Entity\ConditionReglement')->find( (int)$data['ref_condition_reglement'] );
        $refEtatAffaire                     = $em->getRepository('Affaire\Entity\EtatAffaire')->find( (int)$data['ref_etat_affaire'] );
        // $refConcurrent                      = $em->getRepository('Fournisseur\Entity\Fournisseur')->find( (int)$data['ref_concurrent'] );
        // $refModeReglement                   = $em->getRepository('Application\Entity\ModeReglement')->find( (int)$data['ref_mode_reglement'] );
        // $refDevisSigne                      = $em->getRepository('Devis\Entity\Devis')->find( (int)$data['ref_devis_signe'] ); // Mis à jour lorsqu'un devis de l'affaire est signé
        $centreProfit                       = (!empty($refCentreProfit)) ? $refCentreProfit : null;
        $client                             = (!empty($refClient)) ? $refClient : null;
        $interlocuteur                      = (!empty($refInterlocuteur)) ? $refInterlocuteur : null;
        $personnel                          = (!empty($refPersonnel)) ? $refPersonnel : null;
        $conditionReglement                 = (!empty($refConditionReglement)) ? $refConditionReglement : null;
        $etat                               = (!empty($refEtatAffaire)) ? $refEtatAffaire : $em->getRepository('Affaire\Entity\EtatAffaire')->findOneBy(array('intituleEtat'=>'En cours'));
        // $concurrent                         = (!empty($refConcurrent)) ? $refConcurrent : null;

        $numeroAuto                         = (!empty($data['numero_auto'])) ? $data['numero_auto'] : $this->createNumeroAuto($em);
        $numeroAffaire                      = (!empty($data['numero_affaire'])) ? $data['numero_affaire'] : $centreProfit->getNumero().'-'.$numeroAuto;
        $designationAffaire                 = (!empty($data['designation_affaire'])) ? $data['designation_affaire'] : null;
        $exercice                           = (!empty($data['exercice'])) ? $data['exercice'] : null; // date('Y', $data['date_creation'])
        $demandeClient                      = (!empty($data['demande_client'])) ? $data['demande_client'] : null;
        $remise                             = (!empty($data['remise'])) ? $data['remise'] : 0;
        $fraisPort                          = (!empty($data['frais_port'])) ? $data['frais_port'] : 0;
        $referenceCommandeClient            = (!empty($data['reference_commande_client'])) ? $data['reference_commande_client'] : null;
        $referenceDemandePrix               = (!empty($data['reference_demande_prix'])) ? $data['reference_demande_prix'] : null;
        // $dateFin                            = (!empty($data['date_fin'])) ? $data['date_fin'] : null;
        // $etatAffaire                        = (!empty($data['etat_affaire'])) ? $data['etat_affaire'] : null; // refEtatAffaire ? Pour la recherche dans le listing, mieux vaux avoir une reference
        // $raisonPerte                        = (!empty($data['raison_perte'])) ? $data['raison_perte'] : null;
        $dateCreationModificationFiche      = time();

        $this->id = $data['id_affaire'];
        $this->setNumeroAuto($numeroAuto);
        $this->setNumeroAffaire($numeroAffaire);
        $this->setDesignationAffaire($designationAffaire);
        $this->setExercice($exercice);
        $this->setDemandeClient($demandeClient);
        $this->setRemise($remise);
        $this->setFraisPort($fraisPort);
        $this->setReferenceCommandeClient($referenceCommandeClient);
        $this->setReferenceDemandePrix($referenceDemandePrix);
        // $this->setDateFin($dateFin);
        // $this->setRaisonPerte($raisonPerte);
        $this->setRefCentreProfit($centreProfit);
        $this->setRefClient($client);
        $this->setRefInterlocuteur($interlocuteur);
        $this->setRefPersonnel($personnel);
        $this->setEtatAffaire($etat);
        $this->setRefConditionReglement($conditionReglement);
        // $this->setRefConcurrent($concurrent);
        $this->setSuiviBudgetActif($data['suivi_budget_actif']);
        $this->setDateCreationModificationFiche($dateCreationModificationFiche);
    }

    public function getListeAffaire($sm, $motCle = null, $centres = null, $etat = null, $projetSigne = null)
    {
        $query =   
            "SELECT a.id, a.numero_affaire, c.raison_sociale, ad.code_postal, ad.ville, ad.pays, FROM_UNIXTIME(a.date_debut,'%d/%m/%Y') as date_debut, a.ref_devis_signe, e.intitule_etat
             FROM affaire AS a
                LEFT JOIN etat_affaire AS e
                    ON a.ref_etat_affaire = e.id
                LEFT JOIN client AS c
                    ON a.ref_client = c.id
                    LEFT JOIN adresse AS ad
                        ON ad.ref_client = c.id
             WHERE ( ad.adresse_principale = 1 OR ad.adresse_principale IS NULL ) "
        ;

        if(!is_null($centres))
        {
            $idCentres = implode(',', $centres);
            $query.= " AND a.ref_centre_profit IN ($idCentres) ";
        }

        if(!is_null($etat))
        {
            $query.= " AND a.ref_etat_affaire = $etat ";
        }

        if(!is_null($projetSigne))
        {
            if($projetSigne)
            {
                $query.= " AND a.ref_devis_signe IS NOT NULL ";
            }
            else
            {
                $query.= " AND a.ref_devis_signe IS NULL ";
            }
        }

        if(!is_null($motCle))
        {
            $query.=
                " AND (a.numero_affaire LIKE '%$motCle%' 
                  OR FROM_UNIXTIME(a.date_debut,'%d/%m/%Y') LIKE '%$motCle%'
                  OR c.raison_sociale LIKE '%$motCle%' 
                  OR ad.code_postal LIKE '%$motCle%' 
                  OR ad.ville LIKE '%$motCle%' 
                  OR ad.pays LIKE '%$motCle%')
                ";
        }
        
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

    public function getAffairesFicheHeure($sm)
    {
        $query =   
            "SELECT a.id, CONCAT_WS(' - ', c.raison_sociale, a.numero_affaire) as numero_affaire
             FROM affaire AS a
                LEFT JOIN client AS c
                    ON a.ref_client = c.id
             WHERE a.date_fin IS NULL /*AND c.supprime = 0*/
             ORDER BY numero_affaire ASC "
        ;
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

    public function createNumeroAuto($em)
    {
        $query = $em->createQuery("SELECT MAX(a.numeroAuto) as numero_auto FROM Affaire\Entity\Affaire a");
        $numero = (int) $query->getSingleScalarResult() + 1; // retourne plusieurs résultat sous forme de tableau

        while($this->alreadyExisteNumero($numero,$em))
        {
            $numero++;
        }

        return $numero;
    }

     public function alreadyExisteNumero($numero, $em = null)
    {
        $query = $em->createQuery("SELECT COUNT(a.numeroAuto) as numero_max FROM Affaire\Entity\Affaire a WHERE a.numeroAuto = :numero");
        $query->setParameter('numero',$numero);
        $numeroExiste = (bool)$query->getSingleScalarResult();

        return $numeroExiste;
    }


}

?>