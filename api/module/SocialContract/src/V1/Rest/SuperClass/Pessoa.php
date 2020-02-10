<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\SuperClass;

use Doctrine\ORM\Mapping as ORM;

/** 
 * Classe Pessoa
 * 
 * @ORM\MappedSuperclass
 */
class Pessoa {

    /**
     * Nome da instancia de Pessoa
     * 
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * 
     * @var string
     */
    private $nome;


    /**
     * Retorna a propriedade nome
     * 
     * @return string
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Define a propriedade nome
     * 
     * @param string $nome Nome da instância de
     * Pessoa
     * 
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}