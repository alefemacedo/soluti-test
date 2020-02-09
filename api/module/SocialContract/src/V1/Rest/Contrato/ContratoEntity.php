<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\Contrato;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade que representa o Contrato Social de uma
 * Empresa
 * 
 * @ORM\Table(name="social_contract")
 * @ORM\Entity
 */
class ContratoEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @var int
     */
    private $id;

    /**
     * Chave estrangeira para a tabela de Empresa
     * 
     * @ORM\OneToOne(targetEntity="SocialContract\V1\Rest\Empresa\EmpresaEntity")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * 
     * @var int
     */
    private $empresaId;

    /**
     * Caminho para o arquivo do Contrato Social
     * 
     * @ORM\Column(name="file_path", type="string", length=600, nullable=false)
     * 
     * @var string
     */
    private $filePath;

    /**
     * Propriedade que define se o Contrato Social e seus
     * responsáveis foram validados
     * 
     * @ORM\Column(name="validated", type="boolean", nullable=false, options={"default"=false})
     * 
     * @var bool
     */
    private $validado;

    /**
     * Colleção de instâncias das subclasses da entidade
     * ResponsabilidadeEntity que vinculam as instâncias
     * da entidade UsuarioEntity a uma instância de ContratoEntity
     * 
     * @ORM\OneToMany(targetEntity="ResponsabilidadeEntity", mappedBy="contratoSocialId")
     */
    private $responsaveis;

    public function __construct() {
        $this->responsaveis = [];
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
     * Retorna a chave estrangeira para a tabela de
     * Empresa
     * 
     * @return int
     */ 
    public function getEmpresaId()
    {
        return $this->empresaId;
    }

    /**
     * Define o valor para a chave estrangeira para
     * a tabela de Empresa
     *
     * @param  int  $empresaId Chave estrangeira para a tabela de Empresa
     * 
     * @return  self
     */ 
    public function setEmpresaId($empresaId)
    {
        $this->empresaId = $empresaId;

        return $this;
    }

    /**
     * Retorna o caminho para o arquivo do Contrato Social
     *
     * @return  string
     */ 
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Define o caminho para o arquivo do Contrato Social
     *
     * @param  string  $filePath  Caminho para o arquivo do Contrato Social
     *
     * @return  self
     */ 
    public function setFilePath(string $filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Retorna se o contrato social e seus responsáveis
     * foram validados
     *
     * @return  bool
     */ 
    public function getValidado()
    {
        return $this->validado;
    }

    /**
     * Set responsáveis foram validados
     *
     * @param  bool  $validado  responsáveis foram validados
     *
     * @return  self
     */ 
    public function setValidado(bool $validado)
    {
        $this->validado = $validado;

        return $this;
    }
}
