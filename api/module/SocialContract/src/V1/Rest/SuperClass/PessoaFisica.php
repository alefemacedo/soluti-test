<?php
namespace SocialContract\V1\Rest\SuperClass;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe para Pessoa Física que herda da classe Pessoa
 * 
 * @ORM\MappedSuperclass
 */
class PessoaFisica extends Pessoa {

    /**
     * Propriedade CPF que identifica uma Pessoa Física
     * 
     * @ORM\Column(type="string", length=11, nullable=false)
     * 
     * @var string
     */
    private $cpf;


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
}