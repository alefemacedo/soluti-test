<?php
namespace SocialContract\V1\Rest\PessoaFisica;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;
use SocialContract\V1\Rest\Interfaces\MapperInterface;

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
        $connection = $this->entityManager->getConnection();
        $pessoaId = null;
        $connection->beginTransaction();
        try {
            $sql = 'INSERT INTO people (name, cpf) VALUES (?, ?)';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $data->nome);
            $stmt->bindValue(2, $data->cpf);
            $stmt->execute();
            $pessoaId = $connection->lastInsertId();
            $connection->commit();                
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }

        return $pessoaId;
    }

    /**
     * Busca uma instância de uma entidade no banco
     * de dados
     * 
     * @param string $id 
     * @return Entity
     */
    public function fetchAll() {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity', 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'nome');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        // $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity' , 'u', 'p', 'usuario');
        // $rsm->addFieldResult('u', 'user_id', 'id');
        // $rsm->addFieldResult('u', 'email', 'email');
        // $rsm->addFieldResult('u', 'password', 'senha');

        // $sql =  'SELECT p.id, p.cpf, p.name, u.id AS user_id, u.email, u.password FROM people AS p ' .
        //         'LEFT JOIN users as u ON u.person_id = p.id';
        $sql = 'SELECT id, name, cpf  FROM people';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);

        $pessoas = $query->getResult();

        return $pessoas;
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
        $rsm->addFieldResult('p', 'name', 'nome');
        $rsm->addFieldResult('p', 'cpf', 'cpf');
        $rsm->addJoinedEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity' , 'u', 'p', 'usuario');
        $rsm->addFieldResult('u', 'user_id', 'id');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'password', 'senha');

        $sql =  'SELECT p.id, p.cpf, p.name, u.id AS user_id, u.email, u.password FROM people AS p ' .
                'LEFT JOIN users as u ON u.person_id = p.id WHERE p.id=? OR p.cpf=?';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $id);
        $query->setParameter(2, $id);

        $pessoa = $query->getOneOrNullResult();

        return $pessoa;
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