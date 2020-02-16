<?php
namespace SocialContract\V1\Rest\Usuario;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;
use SocialContract\V1\Rest\Interfaces\MapperInterface;
use SocialContract\V1\Rest\PessoaFisica\PessoaFisicaMapper;
use Zend\Crypt\Password\Bcrypt;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;

class UsuarioMapper implements MapperInterface {
    
    protected $entityManager;
    protected $personMapper;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->personMapper = new PessoaFisicaMapper($this->entityManager);
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
        $person = $this->personMapper->fetch($data->cpf);
        $connection = $this->entityManager->getConnection();
        $bcrypt = new Bcrypt();

        if (!is_null($person) && !is_null($person->getUser())) {
            throw new \Exception("Já existe um usuário cadastrado para esta pessoa!");
        } else if (is_null($person)) {
            $personId = $this->personMapper->create($data);
        } else {
            $personId = $person->getId();
        }

        $this->verifyEmailUnique($data->email, $messages);
        if (sizeof($messages) > 0) {
            throw new UniqueConstraintViolationException(json_encode($messages));
        }

        $connection->beginTransaction();
        try {
            $sql = 'INSERT INTO users (person_id, email, password) VALUES (?, ?, ?)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $personId);
            $stmt->bindValue(2, $data->email);
            $stmt->bindValue(3, $bcrypt->create($data->password));
            $stmt->execute();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }
    }

    /**
     * Verifica se o email/login informado para o usuário
     * é único, ou seja, não existe nenhum outro usuário
     * com este email cadastrado no banco de dados
     * 
     * @param String $email
     * @return void
     */
    public function verifyEmailUnique($email, &$messages) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity', 'u');
        $rsm->addFieldResult('u', 'id', 'id');

        $sql =  'SELECT u.id FROM users as u WHERE u.email = ?';

        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $email);

        $user = $query->getOneOrNullResult();

        if (!is_null($user)) {
            $messages['email'] = [
                'uniqueError' => "O e-email informado já pertence a um usuário cadastrado!"
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
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'password', 'password');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'u', 'person');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addFieldResult('p', 'name', 'name');

        $sql =  'SELECT u.id, u.email, u.password, p.id AS person_id, p.cpf, p.name FROM users as u LEFT JOIN people as p ' .
                'ON u.person_id = p.id;';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);

        $users = $query->getResult();

        return $users;
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
        $rsm->addEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'password', 'password');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'u', 'person');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addFieldResult('p', 'name', 'name');

        $sql =  'SELECT u.id, u.email, u.password, p.id AS person_id, p.cpf, p.name FROM users as u LEFT JOIN people as p ' .
                'ON u.person_id = p.id WHERE u.id = ?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $id);

        $user = $query->getOneOrNullResult();

        return $user;
    }

    /**
     * Busca uma instância de uma entidade Usuário no banco
     * de dados de acordo com um Access Token
     * 
     * @param string $token 
     * @return Entity
     */
    public function fetchByToken($token) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'u', 'person');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addFieldResult('p', 'name', 'name');

        $sql =  'SELECT u.id, u.email, p.id AS person_id, p.cpf, p.name FROM users as u ' .
                'LEFT JOIN people as p ON u.person_id = p.id ' .
                'LEFT JOIN AccessToken_OAuth2 as at ON u.id = at.user_id ' .
                'WHERE at.accessToken = ?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $token);

        $user = $query->getOneOrNullResult();

        return $user;
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