<?php
namespace SocialContract\V1\Rest\Usuario;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManager;
use SocialContract\V1\Rest\Interfaces\MapperInterface;

class UsuarioMapper implements MapperInterface {
    
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
        $rsm->addEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'nome');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'cpf', 'cpf');
        $rsm->addFieldResult('u', 'password', 'senha');
        // $rsm->addMetaResult('u', 'discr', 'discr'); // discriminator column
        // $rsm->setDiscriminatorColumn('u', 'discr');

        $query = $this->entityManager->createNativeQuery('SELECT id, name, email, cpf, password FROM users', $rsm);

        $users = $query->getResult();

        return $users;
    }

    /**
     * Retorna uma coleção de instâncias do banco de
     * dados
     * 
     * @return Collection
     */
    public function fetch(int $id) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SocialContract\V1\Rest\Usuario\UsuarioEntity', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'nome');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'cpf', 'cpf');
        $rsm->addFieldResult('u', 'password', 'senha');
        // $rsm->addMetaResult('u', 'discr', 'discr'); // discriminator column
        // $rsm->setDiscriminatorColumn('u', 'discr');

        $query = $this->entityManager->createNativeQuery('SELECT id, name, email, cpf, password FROM users WHERE id = ?', $rsm);
        $query->setParameter(1, $id);

        $user = $query->getSingleResult();

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