<?php
namespace SocialContract\V1\Rest\Empresa;

use SocialContract\V1\Rest\SuperClass\PessoaJuridica;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Empresa
 * 
 * @ORM\Table(name="company")
 * @ORM\Entity
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="nome",
 *          column=@ORM\Column(
 *              name     = "fancy_name",
 *              nullable = true,
 *              unique   = false,
 *              length   = 255
 *          )
 *      )
 * })
 */
class EmpresaEntity extends PessoaJuridica {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @var int
     */
    private $id;
   
    /**
     * Nome fantasia da empresa
     * 
     * @var string
     */
    private $nome;

    /**
     * Retorna a propriedade ID
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }
}
