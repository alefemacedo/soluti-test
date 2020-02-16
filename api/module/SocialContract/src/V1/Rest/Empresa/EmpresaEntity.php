<?php
namespace SocialContract\V1\Rest\Empresa;

use SocialContract\V1\Rest\SuperClass\PessoaJuridica;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade Empresa
 * 
 * @ORM\Table(name="companies")
 * @ORM\Entity
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="name",
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
    private $name;

    /**
     * Instância de ContratoEntity que representa o Contrato Social
     * que descreve a Empresa
     * 
     * @ORM\OneToOne(targetEntity="SocialContract\V1\Rest\Contrato\ContratoEntity", mappedBy="company")
     * 
     * @var SocialContract\V1\Rest\Contrato\ContratoEntity
     */
    private $socialContract;

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
     * Retorna a instância de Contrato Social que descreve a Empresa
     *
     * @return  SocialContract\V1\Rest\Contrato\ContratoEntity
     */ 
    public function getSocialContract()
    {
        return $this->socialContract;
    }

    /**
     * Define a instância de Contrato Social que descreve a Empresa
     *
     * @param  SocialContract\V1\Rest\Contrato\ContratoEntity  $socialContract
     * que descreve a Empresa
     *
     * @return  self
     */ 
    public function setSocialContract($socialContract)
    {
        $this->socialContract = $socialContract;

        return $this;
    }
}
