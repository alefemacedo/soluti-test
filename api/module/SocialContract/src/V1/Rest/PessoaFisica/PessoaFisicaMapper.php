<?php
namespace SocialContract\V1\Rest\PessoaFisica;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;
use SocialContract\V1\Rest\Interfaces\MapperInterface;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;

class PessoaFisicaMapper implements MapperInterface {
    
    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Cria uma instância de uma entidade no banco
     * de dados
     * 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function create($data) {
        $messages = [];
        $this->verifyCpfUnique($data->cpf, $messages);
        if (sizeof($messages) > 0) throw new UniqueConstraintViolationException(json_encode($messages));

        $connection = $this->entityManager->getConnection();
        $personId = null;
        $connection->beginTransaction();
        try {
            $sql = 'INSERT INTO people (name, cpf) VALUES (?, ?)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $data->name);
            $stmt->bindValue(2, $data->cpf);
            $stmt->execute();
            $personId = $connection->lastInsertId();
            $connection->commit();                
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }

        return $personId;
    }

    /**
     * Verifica se o cpf informado para a pessoa
     * é único, ou seja, não existe nenhuma outra pessoa
     * com este cpf cadastrada no banco de dados
     * 
     * @param String $cpf
     * @return void
     */
    public function verifyCpfUnique($cpf, &$messages, $id = 0) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity', 'p');
        $rsm->addFieldResult('p', 'id', 'id');

        $sql =  'SELECT p.id FROM people as p WHERE p.cpf = ?';
        $sql .= $id != 0 ? ' AND p.id <> ?' : '';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $cpf);
        if($id != 0) $query->setParameter(2, $id);

        $person = $query->getOneOrNullResult();

        if (!is_null($person)) {
            $messages['cpf'] = [
                'uniqueError' => "O CPF informado já pertence a uma pessoa cadastrada!"
            ];
        }
    }

    /**
     * Busca uma instância de uma entidade no banco
     * de dados
     * 
     * @param string $id 
     * @return Entity
     */
    public function fetchAll($params = []) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity', 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'cpf', 'cpf');

        $sql = 'SELECT id, name, cpf  FROM people';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);

        $people = $query->getResult();

        return $people;
    }

    /**
     * Retorna uma instância da entidade Pesoa Física
     * do banco de dados
     * 
     * @return SocialContract\V1\Rest\PessoaFisica
     */
    public function fetch($id) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity', 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity' , 'u', 'p', 'user');
        $rsm->addFieldResult('u', 'user_id', 'id');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'password', 'password');

        $sql =  'SELECT p.id, p.cpf, p.name, u.id AS user_id, u.email, u.password FROM people AS p ' .
                'LEFT JOIN users as u ON u.person_id = p.id WHERE p.id=? OR p.cpf=?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $id);
        $query->setParameter(2, $id);

        $person = $query->getOneOrNullResult();

        return $person;
    }

    /**
     * Retorna uma instância da entidade Pesoa Física
     * do banco de dados de acordo com o ID da instância
     * de usuário vinculada à ela
     * 
     * @return SocialContract\V1\Rest\PessoaFisica
     */
    public function fetchByUser($userId) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity', 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity' , 'u', 'p', 'user');
        $rsm->addFieldResult('u', 'user_id', 'id');
        $rsm->addFieldResult('u', 'email', 'email');

        $sql =  'SELECT p.id, p.cpf, p.name, u.id AS user_id, u.email FROM people AS p ' .
                'LEFT JOIN users as u ON u.person_id = p.id WHERE u.id=?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $userId);

        $person = $query->getOneOrNullResult();

        return $person;
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

    }
}