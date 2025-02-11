<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\PessoaFisica;

use Doctrine\ORM\Mapping as ORM;
use SocialContract\V1\Rest\SuperClass\Pessoa;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Classe para Pessoa Física que herda da classe Pessoa
 * 
 * @ORM\Table(name="people")
 * @ORM\Entity
 */
class PessoaFisicaEntity extends Pessoa {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @var int
     */
    private $id;

    /**
     * Propriedade CPF que identifica uma Pessoa Física
     * 
     * @ORM\Column(type="string", length=11, nullable=false, unique=true)
     * 
     * @var string
     */
    private $cpf;

    /**
     * Referência a instância da tabela de Usuario
     * relacionada a esta entidade de Pessoa Física
     * 
     * @ORM\OneToOne(targetEntity="SocialContract\V1\Rest\Usuario\UsuarioEntity", mappedBy="person")
     * 
     * @var SocialContract\V1\Rest\Usuario\UsuarioEntity
     */
    private $user;

    /**
     * Colleção de instâncias das subclasses da entidade
     * ResponsabilidadeEntity que vinculam as instâncias
     * da entidade PessoaFisicaEntity a uma instância de
     * ContratoEntity
     * 
     * @ORM\OneToMany(targetEntity="SocialContract\V1\Rest\Contrato\ResponsabilidadeEntity", mappedBy="person")
     */
    private $responsibilities;

    public function __construct() {
        $this->responsibilities = new ArrayCollection();
    }

    /**
     * Retorna a propriedade ID
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retorna a propriedade CPF
     * 
     * @return string
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Define a propriedade CPF
     *
     * @param string $cpf Propriedade CPF que identifica uma
     * Pessoa Física
     * 
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Retorna a instância da tabela de Usuário relacionada a esta
     * entidade de Pessoa Física
     *
     * @return  SocialContract\V1\Rest\Usuario\UsuarioEntity
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Define a instância da tabela de Usuário relacionada a esta
     * entidade de Pessoa Física
     *
     * @param  SocialContract\V1\Rest\Usuario\UsuarioEntity  $user
     * Instância da tabela de Usuário relacionada a esta entidade de 
     * Pessoa Física
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
