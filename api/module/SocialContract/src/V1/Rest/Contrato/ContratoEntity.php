<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\Contrato;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entidade que representa o Contrato Social de uma
 * Empresa
 * 
 * @ORM\Table(name="social_contracts")
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
     * Referência para a instância na tabela de Empresa
     * a qual o Contrato Social é referente
     * 
     * @ORM\OneToOne(targetEntity="SocialContract\V1\Rest\Empresa\EmpresaEntity", inversedBy="socialContract")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", onDelete="CASCADE")
     * 
     * @var SocialContract\V1\Rest\Empresa\EmpresaEntity
     */
    private $company;

    /**
     * Referência para a instância na tabela de Usuário
     * que fez o upload do arquivo do Contrato Social
     * 
     * @ORM\ManyToOne(targetEntity="SocialContract\V1\Rest\Usuario\UsuarioEntity", inversedBy="socialContracts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     * 
     * @var SocialContract\V1\Rest\Usuario\UsuarioEntity
     */
    private $user;

    /**
     * Caminho para o arquivo do Contrato Social
     * 
     * @ORM\Column(name="file_path", type="string", length=600, nullable=false)
     * 
     * @var string
     */
    private $filePath;

    /**
     * Tamanho do arquivo do Contrato Social
     * 
     * @ORM\Column(name="size", type="bigint", nullable=false)
     * 
     * @var string
     */
    private $size;

    /**
     * Nome do arquivo do Contrato Social
     * 
     * @ORM\Column(name="filename", type="string", length=600, nullable=false)
     * 
     * @var string
     */
    private $filename;

    /**
     * Propriedade que define se o Contrato Social e seus
     * responsáveis foram validados
     * 
     * @ORM\Column(name="validated", type="boolean", nullable=false, options={"default"=false})
     * 
     * @var bool
     */
    private $validated;

    /**
     * Colleção de instâncias das subclasses da entidade
     * ResponsabilidadeEntity que vinculam as instâncias
     * da entidade UsuarioEntity a uma instância de ContratoEntity
     * 
     * @ORM\OneToMany(targetEntity="ResponsabilidadeEntity", mappedBy="socialContract", fetch="EAGER")
     */
    private $responsible;

    public function __construct() {
        $this->responsible = new ArrayCollection();
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
     * Retorna a referência para a tabela de
     * Empresa
     * 
     * @return SocialContract\V1\Rest\Empresa\EmpresaEntity
     */ 
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Define o valor para a referência da tabela de Empresa
     *
     * @param  SocialContract\V1\Rest\Empresa\EmpresaEntity  $company
     * Instância da entidade Empresa definida por esta entidade
     * Contrato Social
     * 
     * @return  self
     */ 
    public function setCompany($company)
    {
        $this->company = $company;

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
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Set responsáveis foram validados
     *
     * @param  bool  $validated  responsáveis foram validados
     *
     * @return  self
     */ 
    public function setValidated(bool $validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Retorna a instância de Usuário que fez o upload
     * do arquivo do Contrato Social
     *
     * @return  SocialContract\V1\Rest\Usuario\UsuarioEntity
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Define o Usuário que fez o upload do arquivo do
     * Contrato Social
     *
     * @param  SocialContract\V1\Rest\Usuario\UsuarioEntity  $user
     * Usuário que fez o upload do arquivo do Contrato Social
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Retorna o tamanho do arquivo do Contrato Social
     *
     * @return  Integer
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Define o tamanho do arquivo do Contrato Social
     *
     * @param  Integer  $size  Tamanho do arquivo do Contrato Social
     *
     * @return  self
     */ 
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Retorna o nome do arquivo do Contrato Social
     *
     * @return  string
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Define o nome do arquivo do Contrato Social
     *
     * @param  string  $filename  Nome do arquivo do Contrato Social
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Retorna a colleção de instâncias das subclasses da
     * entidade ResponsabilidadeEntity
     */ 
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Define o valor para a colleção de instâncias
     * das subclasses da entidade ResponsabilidadeEntity
     *
     * @return  self
     */ 
    public function setResponsible($responsible)
    {
        $this->responsible = $responsible;

        return $this;
    }
}
