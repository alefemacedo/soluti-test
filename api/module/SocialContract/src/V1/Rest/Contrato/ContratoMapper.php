<?php
namespace SocialContract\V1\Rest\Contrato;

use SocialContract\V1\Rest\Interfaces\MapperInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use SocialContract\V1\Rest\Exception\ValidationException;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;

class ContratoMapper implements MapperInterface {
    protected $entityManager;
    protected $responsabilidadeMapper;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->responsabilidadeMapper = new ResponsabilidadeMapper($this->entityManager);
    }

    /**
     * Cria uma instância de uma entidade no banco
     * de dados
     * 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function create($data) {
        $connection = $this->entityManager->getConnection();
        $data->file['filename'] = preg_replace("/[^a-zA-Z0-9\-\._]/", '', $data->file['name']);
        $data->file['file_path'] = 'data' . DIRECTORY_SEPARATOR . 'Files' . DIRECTORY_SEPARATOR  .
            pathinfo($data->file['filename'], PATHINFO_FILENAME) . microtime(true) . "." .
            pathinfo($data->file['filename'], PATHINFO_EXTENSION);

        // Cadastra o contrato social da empresa no banco de dados
        $connection->beginTransaction();
        try {
            $sql = 'INSERT INTO social_contracts (company_id, user_id, filename, file_path, size, validated) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $data->company_id);
            $stmt->bindValue(2, $data->userFile);
            $stmt->bindValue(3, $data->file['filename']);
            $stmt->bindValue(4, $data->file['file_path']);
            $stmt->bindValue(5, $data->file['size']);
            $stmt->bindValue(6, 0);
            $stmt->execute();
            $socialContractId = $connection->lastInsertId();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }

        // Salva as instâncias
        try {
            $this->responsabilidadeMapper->save($data, [], $socialContractId);
        } catch (\Exception $e) {
            // Remove a instância criada para o Contrato Social
            $this->delete($socialContractId);
            throw $e;
        }

        // Salva o arquivo do Contrato Social
        move_uploaded_file($data->file['tmp_name'], $data->file['file_path']);
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
        // Remove uma instância de ContratoEntity do banco de
        // dados de acordo com seu ID
        $connection->beginTransaction();
        try {
            $sql = 'DELETE FROM social_contracts WHERE id = ?';
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