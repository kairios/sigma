<?php

namespace DoctrineORMModule\Proxy\__CG__\Fournisseur\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Fournisseur extends \Fournisseur\Entity\Fournisseur implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'id', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'codeFournisseur', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'codeClient', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'raisonSociale', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'telephone', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'fax', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'siteWeb', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'email', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'dateCreationModificationFiche', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'numeroTva', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'numeroSiret', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'numeroApe', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refConditionReglement', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refModeReglement', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refPosteParDefaut', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refActivite', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refCategorie', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'adresses', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'interlocuteurs', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'actif', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'supprime');
        }

        return array('__isInitialized__', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'id', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'codeFournisseur', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'codeClient', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'raisonSociale', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'telephone', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'fax', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'siteWeb', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'email', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'dateCreationModificationFiche', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'numeroTva', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'numeroSiret', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'numeroApe', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refConditionReglement', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refModeReglement', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refPosteParDefaut', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refActivite', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'refCategorie', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'adresses', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'interlocuteurs', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'actif', '' . "\0" . 'Fournisseur\\Entity\\Fournisseur' . "\0" . 'supprime');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Fournisseur $proxy) {
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
    public function getCodeFournisseur()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodeFournisseur', array());

        return parent::getCodeFournisseur();
    }

    /**
     * {@inheritDoc}
     */
    public function setCodeFournisseur($codeFournisseur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodeFournisseur', array($codeFournisseur));

        return parent::setCodeFournisseur($codeFournisseur);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeClient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodeClient', array());

        return parent::getCodeClient();
    }

    /**
     * {@inheritDoc}
     */
    public function setCodeClient($codeClient)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodeClient', array($codeClient));

        return parent::setCodeClient($codeClient);
    }

    /**
     * {@inheritDoc}
     */
    public function getRaisonSociale()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRaisonSociale', array());

        return parent::getRaisonSociale();
    }

    /**
     * {@inheritDoc}
     */
    public function setRaisonSociale($raisonSociale)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRaisonSociale', array($raisonSociale));

        return parent::setRaisonSociale($raisonSociale);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelephone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelephone', array());

        return parent::getTelephone();
    }

    /**
     * {@inheritDoc}
     */
    public function setTelephone($telephone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTelephone', array($telephone));

        return parent::setTelephone($telephone);
    }

    /**
     * {@inheritDoc}
     */
    public function getFax()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFax', array());

        return parent::getFax();
    }

    /**
     * {@inheritDoc}
     */
    public function setFax($fax)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFax', array($fax));

        return parent::setFax($fax);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteWeb()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSiteWeb', array());

        return parent::getSiteWeb();
    }

    /**
     * {@inheritDoc}
     */
    public function setSiteWeb($siteWeb)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSiteWeb', array($siteWeb));

        return parent::setSiteWeb($siteWeb);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', array());

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', array($email));

        return parent::setEmail($email);
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
    public function getNumeroTva()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumeroTva', array());

        return parent::getNumeroTva();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumeroTva($numeroTva)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumeroTva', array($numeroTva));

        return parent::setNumeroTva($numeroTva);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumeroSiret()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumeroSiret', array());

        return parent::getNumeroSiret();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumeroSiret($numeroSiret)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumeroSiret', array($numeroSiret));

        return parent::setNumeroSiret($numeroSiret);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumeroApe()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumeroApe', array());

        return parent::getNumeroApe();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumeroApe($numeroApe)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumeroApe', array($numeroApe));

        return parent::setNumeroApe($numeroApe);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefCategorie()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefCategorie', array());

        return parent::getRefCategorie();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefCategorie($refCategorie)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefCategorie', array($refCategorie));

        return parent::setRefCategorie($refCategorie);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefActivite()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefActivite', array());

        return parent::getRefActivite();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefActivite($refActivite)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefActivite', array($refActivite));

        return parent::setRefActivite($refActivite);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefModeReglement()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefModeReglement', array());

        return parent::getRefModeReglement();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefModeReglement($refModeReglement)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefModeReglement', array($refModeReglement));

        return parent::setRefModeReglement($refModeReglement);
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
    public function setRefConditionReglement($refConditionReglement)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefConditionReglement', array($refConditionReglement));

        return parent::setRefConditionReglement($refConditionReglement);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefPosteParDefaut()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefPosteParDefaut', array());

        return parent::getRefPosteParDefaut();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefPosteParDefaut($refPosteParDefaut)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefPosteParDefaut', array($refPosteParDefaut));

        return parent::setRefPosteParDefaut($refPosteParDefaut);
    }

    /**
     * {@inheritDoc}
     */
    public function getActif()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getActif', array());

        return parent::getActif();
    }

    /**
     * {@inheritDoc}
     */
    public function setActif($actif)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setActif', array($actif));

        return parent::setActif($actif);
    }

    /**
     * {@inheritDoc}
     */
    public function getSupprime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSupprime', array());

        return parent::getSupprime();
    }

    /**
     * {@inheritDoc}
     */
    public function setSupprime($supprime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSupprime', array($supprime));

        return parent::setSupprime($supprime);
    }

    /**
     * {@inheritDoc}
     */
    public function addAdresse(\Adresse\Entity\Adresse $adresse)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addAdresse', array($adresse));

        return parent::addAdresse($adresse);
    }

    /**
     * {@inheritDoc}
     */
    public function removeAdresse(\Adresse\Entity\Adresse $adresse)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeAdresse', array($adresse));

        return parent::removeAdresse($adresse);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdresses()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdresses', array());

        return parent::getAdresses();
    }

    /**
     * {@inheritDoc}
     */
    public function addInterlocuteur(\Fournisseur\Entity\InterlocuteurFournisseur $interlocuteur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addInterlocuteur', array($interlocuteur));

        return parent::addInterlocuteur($interlocuteur);
    }

    /**
     * {@inheritDoc}
     */
    public function removeInterlocuteur(\Fournisseur\Entity\InterlocuteurFournisseur $interlocuteur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeInterlocuteur', array($interlocuteur));

        return parent::removeInterlocuteur($interlocuteur);
    }

    /**
     * {@inheritDoc}
     */
    public function getInterlocuteurs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInterlocuteurs', array());

        return parent::getInterlocuteurs();
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
), $em = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exchangeArray', array($data, $em));

        return parent::exchangeArray($data, $em);
    }

    /**
     * {@inheritDoc}
     */
    public function findAllFournisseur($em = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'findAllFournisseur', array($em));

        return parent::findAllFournisseur($em);
    }

    /**
     * {@inheritDoc}
     */
    public function getListeFournisseur($sm, $criteres = array (
), $limit = 100)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getListeFournisseur', array($sm, $criteres, $limit));

        return parent::getListeFournisseur($sm, $criteres, $limit);
    }

    /**
     * {@inheritDoc}
     */
    public function getFournisseurs($sm, $critere, $limit = 100)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFournisseurs', array($sm, $critere, $limit));

        return parent::getFournisseurs($sm, $critere, $limit);
    }

    /**
     * {@inheritDoc}
     */
    public function getFournisseursFromForms($sm, $codeFournisseur = '', $raisonSociale = NULL, $limit = 100)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFournisseursFromForms', array($sm, $codeFournisseur, $raisonSociale, $limit));

        return parent::getFournisseursFromForms($sm, $codeFournisseur, $raisonSociale, $limit);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodesFournisseur($sm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodesFournisseur', array($sm));

        return parent::getCodesFournisseur($sm);
    }

    /**
     * {@inheritDoc}
     */
    public function getFournisseurssByActivitiesAndCategories($sm, $activites = NULL, $categories = NULL, $motCle = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFournisseurssByActivitiesAndCategories', array($sm, $activites, $categories, $motCle));

        return parent::getFournisseurssByActivitiesAndCategories($sm, $activites, $categories, $motCle);
    }

}
