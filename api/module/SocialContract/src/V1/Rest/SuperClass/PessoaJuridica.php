<?php
declare(strict_types=1);

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
     * @ORM\Column(type="string", length=14, nullable=false, unique=true)
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
    private $corporateName;


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
    public function getCorporateName()
    {
        return $this->corporateName;
    }

    /**
     * Define a propriedade Rasão Social
     *
     * @param  string  $corporateName Propriedade Rasão Social
     * que define uma Pessoa Jurídica
     *
     * @return  self
     */ 
    public function setCorporateName(string $corporateName)
    {
        $this->corporateName = $corporateName;

        return $this;
    }
}