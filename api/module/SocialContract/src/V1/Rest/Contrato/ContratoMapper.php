<?php
namespace SocialContract\V1\Rest\Contrato;

use SocialContract\V1\Rest\Interfaces\MapperInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use SocialContract\V1\Rest\Exception\ValidationException;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;
use Zend\Paginator\Adapter\ArrayAdapter;

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
    public function fetchAll($params = []) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Contrato\ContratoEntity', 'c');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'filename', 'filename');
        $rsm->addFieldResult('c', 'validated', 'validated');
        $rsm->addFieldResult('c', 'size', 'size');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity' , 'e', 'c', 'company');
        $rsm->addFieldResult('e', 'company_id', 'id');
        $rsm->addFieldResult('e', 'cnpj', 'cnpj');
        $rsm->addFieldResult('e', 'corporate_name', 'corporateName');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity' , 'u', 'c', 'user');
        $rsm->addFieldResult('u', 'user_id', 'id');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'u', 'person');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'user_name', 'name');

        $sql =  'SELECT c.id, c.filename, c.validated, c.size, e.id as company_id, e.cnpj, e.corporate_name, u.id as user_id, p.id as person_id, p.name as user_name ' .
                'FROM social_contracts as c LEFT JOIN companies as e ON c.company_id = e.id ' .
                'LEFT JOIN users as u ON c.user_id = u.id ' .
                'LEFT JOIN people as p ON u.person_id = p.id ' .
                'WHERE e.corporate_name LIKE ? AND e.cnpj LIKE ?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, "%" . (isset($params['corporate_name']) ? $params['corporate_name'] : "") . "%");
        $query->setParameter(2, "%" . (isset($params['cnpj']) ? $params['cnpj'] : "") . "%");
        $interatorAdapter = new ArrayAdapter($query->getResult());
        $contracts = new ContratoCollection($interatorAdapter);
        $contracts->setCurrentPageNumber($params['page']);
        $contracts->setItemCountPerPage(25);

        return $contracts;
    }

    /**
     * Busca uma instância de uma entidade no banco
     * de dados
     * 
     * @param string $id 
     * @return Entity
     */
    public function fetch($id) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Contrato\ContratoEntity', 'c');
        $rsm->addFieldResult('c', 'id', 'id');
        $rsm->addFieldResult('c', 'file_path', 'filePath');
        $rsm->addFieldResult('c', 'validated', 'validated');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity' , 'e', 'c', 'company');
        $rsm->addFieldResult('e', 'company_id', 'id');
        $rsm->addFieldResult('e', 'cnpj', 'cnpj');
        $rsm->addFieldResult('e', 'corporate_name', 'corporateName');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Contrato\ResponsabilidadeEntity' , 'r', 'c', 'responsible');
        $rsm->addFieldResult('r', 'responsibility_id', 'id');
        $rsm->addMetaResult('r', 'type', 'type'); // discriminator column
        $rsm->setDiscriminatorColumn('r', 'type');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'r', 'person');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');

        $sql =  'SELECT c.id, c.file_path, c.validated, e.id as company_id, e.cnpj, e.corporate_name, ' .
                'r.id as responsibility_id, r.type, p.id as person_id, p.name ' .
                'FROM social_contracts as c LEFT JOIN companies as e ON c.company_id = e.id ' .
                'RIGHT JOIN responsibilities as r ON r.social_contract_id = c.id ' .
                'LEFT JOIN people as p ON r.person_id = p.id WHERE c.id=?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $id);
        $contract = $query->getOneOrNullResult();

        $file = file_get_contents($contract->getFilePath());
        $return = [
            'responsible' => [],
            'file' => null,
            'company' => [
                'corporate_name' => $contract->getCompany()->getCorporateName(),
                'cnpj' => $contract->getCompany()->getCnpj()
            ]
        ];

        foreach ($contract->getResponsible() as $responsiblity) {
            if (!isset($return['responsible'][$responsiblity->getPerson()->getId()])) {
                $return['responsible'][$responsiblity->getPerson()->getId()] = [
                    'name'  => $responsiblity->getPerson()->getName(),
                    'responsibilities' => []
                ];
            }

            $return['responsible'][$responsiblity->getPerson()->getId()]['responsibilities'][] = [
                'type' => $responsiblity->getResponsibilityType(),
                'id' => $responsiblity->getId()
            ];
        }

        return $return;
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
        // Verifica se um novo arquivo foi definido para o contrato
        // social
        if (isset($data->file) && !is_null($data->file) && !empty($data->file)) {
            $connection = $this->entityManager->getConnection();
            $data->file['filename'] = preg_replace("/[^a-zA-Z0-9\-\._]/", '', $data->file['name']);
            $data->file['file_path'] = 'data' . DIRECTORY_SEPARATOR . 'Files' . DIRECTORY_SEPARATOR  .
                pathinfo($data->file['filename'], PATHINFO_FILENAME) . microtime(true) . "." .
                pathinfo($data->file['filename'], PATHINFO_EXTENSION);

            // Atualiza o contrato social com os novos dados do
            // arquivo no banco de dados
            $connection->beginTransaction();
            try {
                $sql = 'UPDATE social_contracts SET user_id=?, filename=?, file_path=?, size=? WHERE id=?';
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(2, $data->userFile);
                $stmt->bindValue(3, $data->file['filename']);
                $stmt->bindValue(4, $data->file['file_path']);
                $stmt->bindValue(5, $data->file['size']);
                $stmt->bindValue(6, $id);
                $stmt->execute();
                $connection->commit();
            } catch (\Exception $e) {
                $connection->rollBack();
                throw $e;
            }

            // Salva o arquivo do Contrato Social
            move_uploaded_file($data->file['tmp_name'], $data->file['file_path']);
        }

        // Buscar istâncias de ResponsabilidadeEntity de acordo
        // com o ID do contrato indexadas por ID
        $savedResponsible = $this->responsabilidadeMapper->fetchAllByContractIndexed($id);
        
        // Atualiza os responsáveis
        $this->responsabilidadeMapper->save($data, $savedResponsible, $id);
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