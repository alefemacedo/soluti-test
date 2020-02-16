<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\Usuario;

use ZF\OAuth2\Doctrine\Entity\UserInterface;
use SocialContract\V1\Rest\SuperClass\PessoaFisica;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\ArrayCollection;
use Zend\Hydrator\ClassMethods;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Entidade Usuário
 * 
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class UsuarioEntity implements UserInterface, ArraySerializableInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @var int
     */
    private $id;

    /**
     * Referência a tabela Client utilizada pelo OAuth2
     */
    protected $client;

    /**
     * Referência a tabela AcessToken utilizada pelo OAuth2
     */
    protected $accessToken;

    /**
     * Referência a tabela AuthorizationCode utilizada pelo OAuth2
     */
    protected $authorizationCode;

    /**
     * Referência a tabela RefreshToken utilizada pelo OAuth2
     */
    protected $refreshToken;

    /**
     * Email\Login do Usuário
     * 
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     * 
     * @var string
     */
    private $email;

    /**
     * Senha do Usuário
     * 
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * 
     * @var string
     */
    private $password;

    /**
     * Referência para a instância na tabela de Pessoa
     * a qual o Usuário é referente
     * 
     * @ORM\OneToOne(targetEntity="SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity", inversedBy="user")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", onDelete="CASCADE")
     * 
     * @var SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity
     */
    private $person;

    /**
     * Colleção de instâncias de Constrato Social que representam
     * todos os contratos sociais que o usuário já fez upload
     * 
     * @ORM\OneToMany(targetEntity="SocialContract\V1\Rest\Contrato\ContratoEntity", mappedBy="user")
     */
    private $socialContracts;

    public function __construct() {
        $this->socialContracts = new ArrayCollection();
    }

    public function getArrayCopy() {

        return [
            'id' => $this->getId(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail()
        ];
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'email':
                    $this->setEmail($value);
                    break;
                case 'password':
                    $this->setPassword($value);
                    break;
                default:
                    break;
            }
        }

        return $this;
    }

    /**
     * Retorna o ID
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retorna a propriedade email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Define a propriedade email
     *
     * @param  string  $email Email\Login do Usuário
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Retorna a propriedade senha
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Define a propriedade senha
     *
     * @param  string  $password Senha do Usuário
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Retorna a Pessoa Física a qual o Usuário é referente
     *
     * @return  SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity
     */ 
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Define a Pessoa Física a qual o Usuário é referente
     *
     * @param  SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity  $person
     * Instância de Pessoa Física a qual o Usuário é referente
     *
     * @return  self
     */ 
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Retorna a referência da tabela Client utilizada pelo OAuth2
     */ 
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Define a referência da tabela Client utilizada pelo OAuth2
     *
     * @return  self
     */ 
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Retorna a referência da tabela AcessToken utilizada pelo OAuth2
     */ 
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Define a referência da tabela AcessToken utilizada pelo OAuth2
     *
     * @return  self
     */ 
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Retorna a referência da tabela AuthorizationCode utilizada pelo OAuth2
     */ 
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Define a referência da tabela AuthorizationCode utilizada pelo OAuth2
     *
     * @return  self
     */ 
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;

        return $this;
    }

    /**
     * Retorna a referência da tabela RefreshToken utilizada pelo OAuth2
     */ 
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Define a referência da tabela RefreshToken utilizada pelo OAuth2
     *
     * @return  self
     */ 
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }
}
