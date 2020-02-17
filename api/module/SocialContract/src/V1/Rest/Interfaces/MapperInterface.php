<?php
namespace SocialContract\V1\Rest\Interfaces;

/**
 * Interface para as classes Mapper
 */
interface MapperInterface {

    /**
     * Cria uma instância de uma entidade no banco
     * de dados
     * 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function create($data);

    /**
     * Busca uma instância de uma entidade no banco
     * de dados
     * 
     * @param string $id 
     * @return Entity
     */
    public function fetch($id);

    /**
     * Retorna uma coleção de instâncias do banco de
     * dados
     * 
     * @return Collection
     */
    public function fetchAll($params = []);

    /**
     * Atualiza uma instância de uma entidade no banco
     * de dados de acordo com o ID da instância e os dados
     * 
     * @param string $id 
     * @param array|\Traversable|\stdClass $data 
     * @return Entity
     */
    public function update($id, $data);

    /**
     * Remove uma instância de uma entidade do banco de
     * dados de acordo com o ID da instância
     * 
     * @param string $id 
     * @return bool
     */
    public function delete($id);
}