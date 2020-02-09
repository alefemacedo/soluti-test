<?php
namespace SocialContract\V1\Rest\SuperClass;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe para Pessoa Jurídica que herda de Pessoa
 * 
 * @ORM\MappedSuperclass
 */
class PessoaJuridica extends Pessoa {

    /**
     * Propriedade CNPJ que identifica uma Pessoa Jurídica
     * 
     * @ORM\Column(type="string", length=11, nullable=false, unique=true)
     * 
     * @var string
     */
    private $cnpj;

    /**
     * Propriedade Rasão Social que define uma Pessoa Jurídica
     * 
     * @ORM\Column(name="corporate_name", type="string", length=255, nullable=false, unique=true)
     * 
     * @var string
     */
    private $rasaoSocial;


    /**
     * Retorna a propriedade CNPJ
     *
     * @return  string
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Define a propriedade CNPJ
     *
     * @param  string  $cnpj Propriedade CNPJ que identifica uma
     * Pessoa Jurídica
     *
     * @return  self
     */ 
    public function setCnpj(string $cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Retorna a propriedade Rasão Social
     *
     * @return  string
     */ 
    public function getRasaoSocial()
    {
        return $this->rasaoSocial;
    }

    /**
     * Define a propriedade Rasão Social
     *
     * @param  string  $rasaoSocial Propriedade Rasão Social
     * que define uma Pessoa Jurídica
     *
     * @return  self
     */ 
    public function setRasaoSocial(string $rasaoSocial)
    {
        $this->rasaoSocial = $rasaoSocial;

        return $this;
    }
}