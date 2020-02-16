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
 * @ORM\Table(name="responsabilities")
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
     * Referência para a tabela de PessoaFisicaEntity 
     * de modo a vincular uma instância de Contrato Social
     * a uma instância de Pessoa Física
     * 
     * @ORM\ManyToOne(targetEntity="SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity", inversedBy="responsabilities")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * 
     * @var int
     */
    private $person;

    /**
     * Refência para a tabela de ContratoEntity 
     * de modo a vincular uma instância de Contrato Social
     * a uma instância de Usuário
     * 
     * @ORM\ManyToOne(targetEntity="ContratoEntity", inversedBy="responsible")
     * @ORM\JoinColumn(name="social_contract_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * 
     * @var int
     */
    private $socialContract;
    

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
     * Retorna a referência da tabela de PessoaFisicaEntity
     * 
     * @return int
     */ 
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Define o valor da referência da
     * tabela de PessoaFisicaEntity
     *
     * @param int $person Referência para a tabela de
     * PessoaFisicaEntity
     * 
     * @return  self
     */ 
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Retorna a referência da tabela de ContratoEntity
     * 
     * @return int
     */ 
    public function getSocialContract()
    {
        return $this->socialContract;
    }

    /**
     * Define o valor da referência da tabela de ContratoEntity
     * 
     * @param int $socialContract Referência para a
     * tabela de ContratoEntity
     * 
     * @return  self
     */ 
    public function setSocialContract($socialContract)
    {
        $this->socialContract = $socialContract;

        return $this;
    }
}