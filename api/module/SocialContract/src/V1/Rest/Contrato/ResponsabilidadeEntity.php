<?php
declare(strict_types=1);

namespace SocialContract\V1\Rest\Contrato;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe que vincula um Contrato Social a um ou mais Usuários
 * 
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *      "R" = "ResponsabilidadeEntity",
 *      "S" = "SocioEntity",
 *      "RL" = "ResponsavelLegalEntity",
 *      "C" = "CotistaEntity",
 *      "A" = "AdministradorEntity"
 * })
 * @ORM\Table(name="responsability")
 */
class ResponsabilidadeEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @var int
     */
    private $id;

    /**
     * Chave estrangeira para a tabela de PessoaFisicaEntity 
     * de modo a vincular uma instância de Contrato Social
     * a uma instância de Pessoa Física
     * 
     * @ORM\ManyToOne(targetEntity="SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity", inversedBy="responsabilidades")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     * 
     * @var int
     */
    private $pessoaId;

    /**
     * Chave estrangeira para a tabela de ContratoEntity 
     * de modo a vincular uma instância de Contrato Social
     * a uma instância de Usuário
     * 
     * @ORM\ManyToOne(targetEntity="ContratoEntity", inversedBy="responsaveis")
     * @ORM\JoinColumn(name="social_contract_id", referencedColumnName="id")
     * 
     * @var int
     */
    private $contratoSocialId;
    

    /**
     * Retorna a propriedade ID
     * 
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retorna a chave estrangeira para a tabela
     * de PessoaFisicaEntity
     * 
     * @return int
     */ 
    public function getPessoaId()
    {
        return $this->pessoaId;
    }

    /**
     * Define o valor da chave estrangeira para a
     * tabela de PessoaFisicaEntity
     *
     * @param int $pessoaId Chave estrangeira para a tabela de
     * PessoaFisicaEntity
     * 
     * @return  self
     */ 
    public function setPessoaId($pessoaId)
    {
        $this->pessoaId = $pessoaId;

        return $this;
    }

    /**
     * Retorna a chave estrangeira para a
     * tabela de ContratoEntity
     * 
     * @return int
     */ 
    public function getContratoSocialId()
    {
        return $this->contratoSocialId;
    }

    /**
     * Define o valor da chave estrangeira para
     * a tabela de ContratoEntity
     * 
     * @param int $contratoSocialId Chave estrangeira para a
     * tabela de ContratoEntity
     * 
     * @return  self
     */ 
    public function setContratoSocialId($contratoSocialId)
    {
        $this->contratoSocialId = $contratoSocialId;

        return $this;
    }
}