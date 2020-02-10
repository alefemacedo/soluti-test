<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\Usuario;

use SocialContract\V1\Rest\SuperClass\PessoaFisica;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Hydrator\ClassMethods;

/**
 * Entidade Usuário
 * 
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class UsuarioEntity extends PessoaFisica {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @var int
     */
    private $id;

    /**
     * Email\Login do Usuário
     * 
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
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
    private $senha;

    /**
     * Colleção de instâncias das subclasses da entidade
     * ResponsabilidadeEntity que vinculam as instâncias
     * da entidade UsuarioEntity a uma instância de ContratoEntity
     * 
     * @ORM\OneToMany(targetEntity="SocialContract\V1\Rest\Contrato\ResponsabilidadeEntity", mappedBy="usuarioId")
     */
    private $responsabilidades;

    public function __construct() {
        $this->responsabilidades = new ArrayCollection();
        // if(!empty($data)) {
        //     (new ClassMethods(false))->hydrate($data, $this);
        // }
    }

    // public function toArray() {
    //     return (new ClassMethods(false))->extract($this);
    // }

    // public function getArrayCopy() {

    //     return [
    //         'id' => $this->getId(),
    //         'name' => $this->getNome(),
    //         'password' => $this->getSenha(),
    //         'email' => $this->getEmail(),
    //         'cpf' => $this->getCpf()
    //     ];
    // }

    // public function exchangeArray($data) {

    //     $this->id = $data['id'];
    //     $this->nome = $data['name'];
    //     $this->senha = $data['password'];
    //     $this->email = $data['email'];
    //     $this->cpf = $data['cpf'];
    // }

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
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Define a propriedade senha
     *
     * @param  string  $senha Senha do Usuário
     *
     * @return  self
     */ 
    public function setSenha(string $senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
