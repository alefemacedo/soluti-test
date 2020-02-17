<?php
namespace SocialContract\V1\Rest\Empresa;

use SocialContract\V1\Rest\Interfaces\MapperInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use SocialContract\V1\Rest\Exception\ValidationException;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;
use SocialContract\V1\Rest\Contrato\ContratoMapper;
use Zend\Paginator\Adapter\ArrayAdapter;

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
        
        if (sizeof($messages) > 0) throw new UniqueConstraintViolationException(json_encode($messages));

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
    public function verifyCorporateNameUnique($corporateName, &$messages, $id = 0) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity', 'c');
        $rsm->addFieldResult('c', 'id', 'id');

        $sql =  'SELECT c.id FROM companies as c WHERE c.corporate_name = ?';
        $sql .= $id != 0 ? ' AND c.id <> ?' : '';

        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $corporateName);
        if ($id != 0) $query->setParameter(2, $id);

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
    public function verifyCnpjUnique($cnpj, &$messages, $id = 0) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity', 'c');
        $rsm->addFieldResult('c', 'id', 'id');

        $sql =  'SELECT c.id FROM companies as c WHERE c.cnpj = ?';
        $sql .= $id != 0 ? ' AND c.id <> ?' : '';

        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $cnpj);
        if ($id != 0) $query->setParameter(2, $id);

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
    public function fetchAll($params = []) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity' , 'e');
        $rsm->addFieldResult('e', 'id', 'id');
        $rsm->addFieldResult('e', 'cnpj', 'cnpj');
        $rsm->addFieldResult('e', 'corporate_name', 'corporateName');
        $rsm->addFieldResult('e', 'fancy_name', 'name');

        $sql =  'SELECT id, cnpj, corporate_name, fancy_name FROM companies ' .
                'WHERE corporate_name LIKE ? AND cnpj LIKE ?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, "%" . (isset($params['corporate_name']) ? $params['corporate_name'] : "") . "%");
        $query->setParameter(2, "%" . (isset($params['cnpj']) ? $params['cnpj'] : "") . "%");
        $interatorAdapter = new ArrayAdapter($query->getResult());
        $companies = new EmpresaCollection($interatorAdapter);
        $companies->setCurrentPageNumber($params['page']);
        $companies->setItemCountPerPage(25);

        return $companies;
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
        $rsm->addEntityResult('SocialContract\V1\Rest\Empresa\EmpresaEntity' , 'e');
        $rsm->addFieldResult('e', 'id', 'id');
        $rsm->addFieldResult('e', 'cnpj', 'cnpj');
        $rsm->addFieldResult('e', 'corporate_name', 'corporateName');
        $rsm->addFieldResult('e', 'fancy_name', 'name');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Contrato\ContratoEntity', 'c', 'e', 'socialContract');
        $rsm->addFieldResult('c', 'contract_id', 'id');
        $rsm->addFieldResult('c', 'file_path', 'filePath');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Contrato\ResponsabilidadeEntity' , 'r', 'c', 'responsible');
        $rsm->addFieldResult('r', 'responsibility_id', 'id');
        $rsm->addMetaResult('r', 'type', 'type'); // discriminator column
        $rsm->setDiscriminatorColumn('r', 'type');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'r', 'person');
        $rsm->addFieldResult('p', 'person_id', 'id');

        $sql =  'SELECT e.id, e.cnpj, e.corporate_name, e.fancy_name, c.id as contract_id, c.file_path, r.id as responsibility_id, r.type, p.id as person_id ' .
                'FROM companies as e LEFT JOIN social_contracts as c ON c.company_id = e.id ' .
                'LEFT JOIN responsibilities as r ON r.social_contract_id = c.id ' .
                'LEFT JOIN people as p ON r.person_id = p.id ' .
                'WHERE e.id=?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $id);
        $company = $query->getOneOrNullResult();

        $return = [
            'company' => $company,
            'responsible' => []
        ];

        if (!is_null($company->getSocialContract())) {
            foreach ($company->getSocialContract()->getResponsible() as $responsibility) {
                $return['responsible'][$responsibility->getId()] = [
                    'id' => $responsibility->getId(),
                    'type' => $responsibility->getResponsibilityType(),
                    'person_id' => $responsibility->getPerson()->getId()
                ];
            }
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
        $messages = [];
        $fetchData = $this->fetch($id);
        if(is_null($fetchData['company'])) throw new NotFoundException("Não foi encontrado nenhuma empresa para este ID");
        
        $this->verifyCorporateNameUnique($data->corporate_name, $messages, $id);
        $this->verifyCnpjUnique($data->cnpj, $messages, $id);
        
        if (sizeof($messages) > 0) throw new UniqueConstraintViolationException(json_encode($messages));

        $connection = $this->entityManager->getConnection();

        // Cadastra a empresa no banco de dados
        $connection->beginTransaction();
        try {
            $sql = 'UPDATE companies SET fancy_name=?, corporate_name=?, cnpj=? WHERE id=?';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $data->name);
            $stmt->bindValue(2, $data->corporate_name);
            $stmt->bindValue(3, $data->cnpj);
            $stmt->bindValue(4, $id);
            $stmt->execute();
            $data->company_id = $id;
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }

        if (!is_null($fetchData['company']->getSocialContract())) {
            // Atualiza a instância de ContratoEntity vinculada
            // a esta empresa, e atualizando os responsáveis descritos
            $this->contratoMapper->update($fetchData['company']->getSocialContract()->getId(), $data);

        } else if (isset($data->file) && !is_null($data->file) && !empty($data->file)) {
            // Cria uma instância de ContratoEntity vinculando
            // esta empresa ao seu Contrato Social, bem como
            // os responsáveis descritos
            $this->contratoMapper->create($data);
        }
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