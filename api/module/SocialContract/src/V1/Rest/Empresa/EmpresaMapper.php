<?php
namespace SocialContract\V1\Rest\Empresa;

use SocialContract\V1\Rest\Interfaces\MapperInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use SocialContract\V1\Rest\Exception\ValidationException;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;
use SocialContract\V1\Rest\Contrato\ContratoMapper;

class EmpresaMapper implements MapperInterface {
    protected $entityManager;
    protected $contratoMapper;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->contratoMapper = new ContratoMapper($this->entityManager);
    }

    /**
     * Cria uma instância de uma entidade no banco
     * de dados
     * 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function create($data) {
        // Array com mensagens de erro do formulário
        $messages = [];
        $connection = $this->entityManager->getConnection();
        $this->verifyCorporateNameUnique($data->corporate_name, $messages);
        $this->verifyCnpjUnique($data->cnpj, $messages);
        
        if (sizeof($messages) > 0) {
            throw new UniqueConstraintViolationException(json_encode($messages));
        }

        // Cadastra a empresa no banco de dados
        $connection->beginTransaction();
        try {
            $sql = 'INSERT INTO companies (fancy_name, corporate_name, cnpj) VALUES (?, ?, ?)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $data->name);
            $stmt->bindValue(2, $data->corporate_name);
            $stmt->bindValue(3, $data->cnpj);
            $stmt->execute();
            $data->company_id = $connection->lastInsertId();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }

        if (isset($data->file) && !is_null($data->file) && !empty($data->file)) {
            try {
                // Cria uma instância de ContratoEntity vinculando
                // esta empresa ao seu Contrato Social, bem como
                // os responsáveis descritos
                $this->contratoMapper->create($data);

            } catch (\Exception $e) {
                $this->delete($data->company_id);
                throw $e;
            }
        }
        
    }

    /**
     * Verifica se a rasao social da empresa é única,
     * ou seja, não existem instâncias de empresa cadastradas no
     * banco de dados com esse valor para o atributo corporate_name
     * 
     * @param String $corporateName Rasão Social da empresa
     * @return void
     */
    public function verifyCorporateNameUnique($corporateName, &$messages) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity', 'c');
        $rsm->addFieldResult('c', 'id', 'id');

        $sql =  'SELECT c.id FROM companies as c WHERE c.corporate_name = ?';

        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $corporateName);

        $companies = $query->getResult();

        if (sizeof($companies) > 0) {
            $messages['corporate_name'] = [
                'uniqueError' => "A rasão social informada já pertence a uma empresa cadastrada!"
            ];
        }
    }

    /**
     * Verifica se o cnpj da empresa é único, ou seja,
     * não existem instâncias de empresa cadastradas no
     * banco de dados com esse valores para o atributo
     * cnpj
     * 
     * @param String $cnpj CNPJ da empresa
     * @return void
     */
    public function verifyCnpjUnique($cnpj, &$messages) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity', 'c');
        $rsm->addFieldResult('c', 'id', 'id');

        $sql =  'SELECT c.id FROM companies as c WHERE c.cnpj = ?';

        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $cnpj);

        $companies = $query->getResult();

        if (sizeof($companies) > 0) {
            $messages['cnpj'] = [
                'uniqueError' => "O CNPJ informado já pertence a uma empresa cadastrada!"
            ];
        }
    }

    /**
     * Retorna uma coleção de instâncias do banco de
     * dados
     * 
     * @return Collection
     */
    public function fetchAll() {
        
    }

    /**
     * Busca uma instância de uma entidade no banco
     * de dados
     * 
     * @param string $id 
     * @return Entity
     */
    public function fetch($id) {
        
    }

    /**
     * Atualiza uma instância de uma entidade no banco
     * de dados de acordo com o ID da instância e os dados
     * 
     * @param string $id 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function update($id, $data) {

    }

    /**
     * Remove uma instância de uma entidade do banco de
     * dados de acordo com o ID da instância
     * 
     * @param string $id 
     * @return bool
     */
    public function delete($id) {
        $connection = $this->entityManager->getConnection();
        // Remove uma instância de Empresa do banco de
        // dados de acordo com seu ID
        $connection->beginTransaction();
        try {
            $sql = 'DELETE FROM companies WHERE id = ?';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }
    }
}