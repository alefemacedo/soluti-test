<?php

namespace DoctrineORMModule\Proxy\__CG__\SocialContract\V1\Rest\Usuario;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class UsuarioEntity extends \SocialContract\V1\Rest\Usuario\UsuarioEntity implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
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
            return ['__isInitialized__', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'id', 'client', 'accessToken', 'authorizationCode', 'refreshToken', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'email', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'password', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'person', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'socialContracts'];
        }

        return ['__isInitialized__', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'id', 'client', 'accessToken', 'authorizationCode', 'refreshToken', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'email', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'password', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'person', '' . "\0" . 'SocialContract\\V1\\Rest\\Usuario\\UsuarioEntity' . "\0" . 'socialContracts'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (UsuarioEntity $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
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
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
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
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getArrayCopy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArrayCopy', []);

        return parent::getArrayCopy();
    }

    /**
     * {@inheritDoc}
     */
    public function exchangeArray(array $data)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exchangeArray', [$data]);

        return parent::exchangeArray($data);
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function getPerson()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPerson', []);

        return parent::getPerson();
    }

    /**
     * {@inheritDoc}
     */
    public function setPerson($person)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPerson', [$person]);

        return parent::setPerson($person);
    }

    /**
     * {@inheritDoc}
     */
    public function getClient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClient', []);

        return parent::getClient();
    }

    /**
     * {@inheritDoc}
     */
    public function setClient($client)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setClient', [$client]);

        return parent::setClient($client);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccessToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccessToken', []);

        return parent::getAccessToken();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccessToken($accessToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccessToken', [$accessToken]);

        return parent::setAccessToken($accessToken);
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthorizationCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthorizationCode', []);

        return parent::getAuthorizationCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthorizationCode($authorizationCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAuthorizationCode', [$authorizationCode]);

        return parent::setAuthorizationCode($authorizationCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getRefreshToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRefreshToken', []);

        return parent::getRefreshToken();
    }

    /**
     * {@inheritDoc}
     */
    public function setRefreshToken($refreshToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRefreshToken', [$refreshToken]);

        return parent::setRefreshToken($refreshToken);
    }

}
