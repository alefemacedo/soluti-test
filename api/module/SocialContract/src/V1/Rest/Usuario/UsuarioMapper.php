<?php
namespace SocialContract\V1\Rest\Usuario;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;
use SocialContract\V1\Rest\Interfaces\MapperInterface;
use SocialContract\V1\Rest\PessoaFisica\PessoaFisicaMapper;

class UsuarioMapper implements MapperInterface {
    
    protected $entityManager;
    protected $pessoaMapper;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->pessoaMapper = new PessoaFisicaMapper($this->entityManager);
    }

    /**
     * Cria uma instância de uma entidade no banco
     * de dados
     * 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function create($data) {
        $pessoa = $this->pessoaMapper->fetch($data->cpf);
        $connection = $this->entityManager->getConnection();

        if (!is_null($pessoa) && !is_null($pessoa->getUsuario())) {
            throw new \Exception("Já existe um usuário cadastrado para esta pessoa!");
        } else if (is_null($pessoa)) {
            $pessoaId = $this->pessoaMapper->create($data);
        } else {
            $pessoaId = $pessoa->getId();
        }

        $connection->beginTransaction();
        try {
            $sql = 'INSERT INTO users (person_id, email, password) VALUES (?, ?, ?)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $pessoaId);
            $stmt->bindValue(2, $data->email);
            $stmt->bindValue(3, $data->cpf);
            $stmt->execute();
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
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
        $rsm->addFieldResult('u', 'password', 'senha');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'u', 'pessoa');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addFieldResult('p', 'name', 'nome');
        // $rsm->addMetaResult('u', 'discr', 'discr'); // discriminator column
        // $rsm->setDiscriminatorColumn('u', 'discr');

        $sql =  'SELECT u.id, u.email, u.password, p.id AS person_id, p.cpf, p.name FROM users as u LEFT JOIN people as p ' .
                'ON u.person_id = p.id;';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);

        $usuarios = $query->getResult();

        return $usuarios;
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
        $rsm->addFieldResult('u', 'password', 'senha');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity' , 'p', 'u', 'pessoa');
        $rsm->addFieldResult('p', 'person_id', 'id');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addFieldResult('p', 'name', 'nome');

        $sql =  'SELECT u.id, u.email, u.password, p.id AS person_id, p.cpf, p.name FROM users as u LEFT JOIN people as p ' .
                'ON u.person_id = p.id WHERE u.id = ?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $id);

        $usuario = $query->getOneOrNullResult();

        return $usuario;
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