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
    private $name;


    /**
     * Retorna a propriedade nome
     * 
     * @return string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Define a propriedade nome
     * 
     * @param string $name Nome da instância de
     * Pessoa
     * 
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}