<?php

namespace DoctrineORMModule\Proxy\__CG__\Affaire\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Affaire extends \Affaire\Entity\Affaire implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'id', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'numeroAuto', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'numeroAffaire', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'designationAffaire', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'dateCreationModificationFiche', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'exercice', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'demandeClient', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'remise', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'fraisPort', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'referenceCommandeClient', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'referenceDemandePrix', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'suiviBudgetActif', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'dateDebut', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'dateFin', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'raisonPerte', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refEtatAffaire', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refInterlocuteur', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refPersonnel', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refConditionReglement', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refConcurrent', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refDevisSigne', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refCentreProfit', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refClient');
        }

        return array('__isInitialized__', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'id', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'numeroAuto', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'numeroAffaire', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'designationAffaire', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'dateCreationModificationFiche', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'exercice', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'demandeClient', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'remise', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'fraisPort', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'referenceCommandeClient', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'referenceDemandePrix', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'suiviBudgetActif', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'dateDebut', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'dateFin', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'raisonPerte', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refEtatAffaire', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refInterlocuteur', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refPersonnel', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refConditionReglement', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refConcurrent', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refDevisSigne', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refCentreProfit', '' . "\0" . 'Affaire\\Entity\\Affaire' . "\0" . 'refClient');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Affaire $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', array($id));

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setNumeroAuto($numeroAuto)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumeroAuto', array($numeroAuto));

        return parent::setNumeroAuto($numeroAuto);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumeroAuto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumeroAuto', array());

        return parent::getNumeroAuto();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumeroAffaire($numeroAffaire)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumeroAffaire', array($numeroAffaire));

        return parent::setNumeroAffaire($numeroAffaire);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumeroAffaire()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumeroAffaire', array());

        return parent::getNumeroAffaire();
    }

    /**
     * {@inheritDoc}
     */
    public function setDesignationAffaire($designationAffaire)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDesignationAffaire', array($designationAffaire));

        return parent::setDesignationAffaire($designationAffaire);
    }

    /**
     * {@inheritDoc}
     */
    public function getDesignationAffaire()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDesignationAffaire', array());

        return parent::getDesignationAffaire();
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreationModificationFiche()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreationModificationFiche', array());

        return parent::getDateCreationModificationFiche();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreationModificationFiche($dateCreationModificationFiche)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreationModificationFiche', array($dateCreationModificationFiche));

        return parent::setDateCreationModificationFiche($dateCreationModificationFiche);
    }

    /**
     * {@inheritDoc}
     */
    public function setExercice($exercice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExercice', array($exercice));

        return parent::setExercice($exercice);
    }

    /**
     * {@inheritDoc}
     */
    public function getExercice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExercice', array());

        return parent::getExercice();
    }

    /**
     * {@inheritDoc}
     */
    public function setDemandeClient($demandeClient)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDemandeClient', array($demandeClient));

        return parent::setDemandeClient($demandeClient);
    }

    /**
     * {@inheritDoc}
     */
    public function getDemandeClient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDemandeClient', array());

        return parent::getDemandeClient();
    }

    /**
     * {@inheritDoc}
     */
    public function setRemise($remise)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRemise', array($remise));

        return parent::setRemise($remise);
    }

    /**
     * {@inheritDoc}
     */
    public function getRemise()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRemise', array());

        return parent::getRemise();
    }

    /**
     * {@inheritDoc}
     */
    public function setFraisPort($fraisPort)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFraisPort', array($fraisPort));

        return parent::setFraisPort($fraisPort);
    }

    /**
     * {@inheritDoc}
     */
    public function getFraisPort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFraisPort', array());

        return parent::getFraisPort();
    }

    /**
     * {@inheritDoc}
     */
    public function setReferenceCommandeClient($referenceCommandeClient)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReferenceCommandeClient', array($referenceCommandeClient));

        return parent::setReferenceCommandeClient($referenceCommandeClient);
    }

    /**
     * {@inheritDoc}
     */
    public function getReferenceCommandeClient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReferenceCommandeClient', array());

        return parent::getReferenceCommandeClient();
    }

    /**
     * {@inheritDoc}
     */
    public function setReferenceDemandePrix($referenceDemandePrix)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReferenceDemandePrix', array($referenceDemandePrix));

        return parent::setReferenceDemandePrix($referenceDemandePrix);
    }

    /**
     * {@inheritDoc}
     */
    public function getReferenceDemandePrix()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReferenceDemandePrix', array());

        return parent::getReferenceDemandePrix();
    }

    /**
     * {@inheritDoc}
     */
    public function setSuiviBudgetActif($suiviBudgetActif)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuiviBudgetActif', array($suiviBudgetActif));

        return parent::setSuiviBudgetActif($suiviBudgetActif);
    }

    /**
     * {@inheritDoc}
     */
    public function getSuiviBudgetActif()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSuiviBudgetActif', array());

        return parent::getSuiviBudgetActif();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateDebut($dateDebut)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateDebut', array($dateDebut));

        return parent::setDateDebut($dateDebut);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateDebut()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateDebut', array());

        return parent::getDateDebut();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateFin($dateFin)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateFin', array($dateFin));

        return parent::setDateFin($dateFin);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateFin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateFin', array());

        return parent::getDateFin();
    }

    /**
     * {@inheritDoc}
     */
    public function setRaisonPerte($raisonPerte)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRaisonPerte', array($raisonPerte));

        return parent::setRaisonPerte($raisonPerte);
    }

    /**
     * {@inheritDoc}
     */
    public function getRaisonPerte()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRaisonPerte', array());

        return parent::getRaisonPerte();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefEtatAffaire($refEtatAffaire)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefEtatAffaire', array($refEtatAffaire));

        return parent::setRefEtatAffaire($refEtatAffaire);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefEtatAffaire()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefEtatAffaire', array());

        return parent::getRefEtatAffaire();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefInterlocuteur(\Client\Entity\InterlocuteurClient $refInterlocuteur = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefInterlocuteur', array($refInterlocuteur));

        return parent::setRefInterlocuteur($refInterlocuteur);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefInterlocuteur()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefInterlocuteur', array());

        return parent::getRefInterlocuteur();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefPersonnel(\Personnel\Entity\Personnel $refPersonnel = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefPersonnel', array($refPersonnel));

        return parent::setRefPersonnel($refPersonnel);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefPersonnel()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefPersonnel', array());

        return parent::getRefPersonnel();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefConditionReglement(\Application\Entity\ConditionReglement $refConditionReglement = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefConditionReglement', array($refConditionReglement));

        return parent::setRefConditionReglement($refConditionReglement);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefConditionReglement()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefConditionReglement', array());

        return parent::getRefConditionReglement();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefConcurrent(\Fournisseur\Entity\Fournisseur $refConcurrent = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefConcurrent', array($refConcurrent));

        return parent::setRefConcurrent($refConcurrent);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefConcurrent()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefConcurrent', array());

        return parent::getRefConcurrent();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefDevisSigne(\Devis\Entity\Devis $refDevisSigne = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefDevisSigne', array($refDevisSigne));

        return parent::setRefDevisSigne($refDevisSigne);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefDevisSigne()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefDevisSigne', array());

        return parent::getRefDevisSigne();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefCentreProfit(\Affaire\Entity\CentreDeProfit $refCentreProfit = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefCentreProfit', array($refCentreProfit));

        return parent::setRefCentreProfit($refCentreProfit);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefCentreProfit()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefCentreProfit', array());

        return parent::getRefCentreProfit();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefClient(\Client\Entity\Client $refClient = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefClient', array($refClient));

        return parent::setRefClient($refClient);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefClient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefClient', array());

        return parent::getRefClient();
    }

    /**
     * {@inheritDoc}
     */
    public function getArrayCopy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArrayCopy', array());

        return parent::getArrayCopy();
    }

    /**
     * {@inheritDoc}
     */
    public function exchangeArray($data = array (
), $sm = NULL, $em = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exchangeArray', array($data, $sm, $em));

        return parent::exchangeArray($data, $sm, $em);
    }

    /**
     * {@inheritDoc}
     */
    public function getListeAffaire($sm, $motCle = NULL, $centres = NULL, $etat = NULL, $projetSigne = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getListeAffaire', array($sm, $motCle, $centres, $etat, $projetSigne));

        return parent::getListeAffaire($sm, $motCle, $centres, $etat, $projetSigne);
    }

    /**
     * {@inheritDoc}
     */
    public function getAffairesFicheHeure($sm, $motCle = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAffairesFicheHeure', array($sm, $motCle));

        return parent::getAffairesFicheHeure($sm, $motCle);
    }

    /**
     * {@inheritDoc}
     */
    public function createNumeroAuto($em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'createNumeroAuto', array($em));

        return parent::createNumeroAuto($em);
    }

    /**
     * {@inheritDoc}
     */
    public function alreadyExisteNumero($numero, $em = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'alreadyExisteNumero', array($numero, $em));

        return parent::alreadyExisteNumero($numero, $em);
    }

    /**
     * {@inheritDoc}
     */
    public function getListeDevis($sm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getListeDevis', array($sm));

        return parent::getListeDevis($sm);
    }

}
