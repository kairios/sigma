<?php

namespace DoctrineORMModule\Proxy\__CG__\Personnel\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Personnel extends \Personnel\Entity\Personnel implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'id', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'prenom', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'nom', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'email', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'motDePasse', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'dateCreationModification', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'administrateur', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'tauxHoraire');
        }

        return array('__isInitialized__', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'id', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'prenom', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'nom', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'email', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'motDePasse', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'dateCreationModification', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'administrateur', '' . "\0" . 'Personnel\\Entity\\Personnel' . "\0" . 'tauxHoraire');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Personnel $proxy) {
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
    public function getPrenom()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrenom', array());

        return parent::getPrenom();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrenom($prenom)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrenom', array($prenom));

        return parent::setPrenom($prenom);
    }

    /**
     * {@inheritDoc}
     */
    public function getNom()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNom', array());

        return parent::getNom();
    }

    /**
     * {@inheritDoc}
     */
    public function setNom($nom)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNom', array($nom));

        return parent::setNom($nom);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrenomNom()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrenomNom', array());

        return parent::getPrenomNom();
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
    public function getMotDePasse()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotDePasse', array());

        return parent::getMotDePasse();
    }

    /**
     * {@inheritDoc}
     */
    public function setMotDePasse($motDePasse)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMotDePasse', array($motDePasse));

        return parent::setMotDePasse($motDePasse);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreationModification()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreationModification', array());

        return parent::getDateCreationModification();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreationModification($dateCreationModification)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreationModification', array($dateCreationModification));

        return parent::setDateCreationModification($dateCreationModification);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdministrateur()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdministrateur', array());

        return parent::getAdministrateur();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminitrateur($administrateur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdminitrateur', array($administrateur));

        return parent::setAdminitrateur($administrateur);
    }

    /**
     * {@inheritDoc}
     */
    public function getTauxHoraire()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTauxHoraire', array());

        return parent::getTauxHoraire();
    }

    /**
     * {@inheritDoc}
     */
    public function setTauxHoraire($tauxHoraire)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTauxHoraire', array($tauxHoraire));

        return parent::setTauxHoraire($tauxHoraire);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeureDebut($day)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeureDebut', array($day));

        return parent::getHeureDebut($day);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeureFin($day)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeureFin', array($day));

        return parent::getHeureFin($day);
    }

    /**
     * {@inheritDoc}
     */
    public function getDureePause($day)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDureePause', array($day));

        return parent::getDureePause($day);
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
    public function loadByEmailAndPassword($em = NULL, $email = '', $motDePasse = '')
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'loadByEmailAndPassword', array($em, $email, $motDePasse));

        return parent::loadByEmailAndPassword($em, $email, $motDePasse);
    }

    /**
     * {@inheritDoc}
     */
    public function existeAdministrateur($em = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'existeAdministrateur', array($em));

        return parent::existeAdministrateur($em);
    }

    /**
     * {@inheritDoc}
     */
    public function getListeUtilisateurs($sm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getListeUtilisateurs', array($sm));

        return parent::getListeUtilisateurs($sm);
    }

    /**
     * {@inheritDoc}
     */
    public function getNomsPersonnels($sm, $limit = 100)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNomsPersonnels', array($sm, $limit));

        return parent::getNomsPersonnels($sm, $limit);
    }

}
