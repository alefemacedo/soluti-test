<?php
namespace SocialContract\V1\Rest\Contrato;

use SocialContract\V1\Rest\Interfaces\MapperInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use SocialContract\V1\Rest\Exception\ValidationException;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;

class ResponsabilidadeMapper implements MapperInterface {
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
     * Cria uma instância de uma entidade no banco
     * de dados
     * 
     * @param array|\Traversable|\stdClass $data 
     * @param array|\Traversable|\stdClass $savedResponsible
     * @param Integer $socialContractId
     * @return Entity
     */
    public function save($data, $savedResponsible, $socialContractId) {
        $connection = $this->entityManager->getConnection();
       
        $newResponsible = $this->normalizeResponsibleCollection($data->responsible, $savedResponsible);

        $insertSql = 'INSERT INTO responsabilities (person_id, social_contract_id, type) VALUES ';
        
        $count = 0;
        $len = count($newResponsible['toInsert']);
        foreach ($newResponsible['toInsert'] as $key => $value) {
            $insertSql .= '(';
            $insertSql .= ':' . $key . 'person_id, ';
            $insertSql .= ':' . $key . 'social_contract_id, ';
            $insertSql .= ':' . $key . 'type';
            $insertSql .= ')';
            $insertSql .= $count == ($len-1) ? '' : ', ';
            $count +=1;
        }

        if (count($newResponsible['toDelete']) > 0) {
            $deleteSql = 'DELETE FROM responsabilities WHERE id IN (' . implode(',', $newResponsible['toDelete']) . ')';
        }

        // Cadastra os responsáveis descritos no Contrato Social
        // no banco de dados
        $connection->beginTransaction();
        try {
            // Insere as novas instâncias no banco de dados
            if ($insertSql) {
                $stmt = $connection->prepare($insertSql);
                foreach ($newResponsible['toInsert'] as $key => $value) {
                    $stmt->bindValue(':' . $key . 'person_id', $value->person_id);
                    $stmt->bindValue(':' . $key . 'social_contract_id', $socialContractId);
                    $stmt->bindValue(':' . $key . 'type', $value->type);
                }
                $stmt->execute();
            }
            // Remove as instâncias do banco de dados
            if($deleteSql) {
                $stmt->prepare($deleteSql);
                $stmt->execute();
            }
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }
    }

    /**
     * Normaliza a coleção de responsáveis vindos do
     * formulário, de modo a definir quais devem ser inseridos
     * no banco de dados e quais devem ser removidos
     * 
     * @param JSON $responsible String JSON com a coleção de dados
     * dos responsáveis vindos do formulário, como ID da pessoa e
     * sua responsabilidade
     * @param Collection $savedResponsible Coleção com as instâncias
     * de ResponsabilidadeEntity salvas no banco e vinculadas ao Contrato
     * Social
     * 
     * @return Array $return Array contendo os IDs das instâncias de
     * ResponsabilidadeEntity a serem removidas e os dados das novas a
     * serem inseridas
     */
    public function normalizeResponsibleCollection($responsible, $savedResponsible) {
        $messages = [];
        // Converte a String JSON que contém os dados
        // vindos do formulário em um Objeto/Collection
        $responsible = get_object_vars(json_decode($responsible));

        // Array de retorno com os dados dos responsáveis
        // a serem inseridos no banco e os IDs daqueles a serem
        // removidos
        $return = [
            'toDelete' => [],
            'toInsert' => []
        ];

        // Verifica se o array de responsáveis não está vazio,
        // caso esteja significa que o usuário inseriu um arquivo
        // mas não definiu os responsáveis descritos no Contrato
        // Social, portanto lança-se uma exceção
        if (!isset($responsible) || is_null($responsible) || empty($responsible)) {
            $messages['file'] = [
                'uniqueError' => "Por favor informe os dados dos responsáveis descritos no contrato social."
            ];
            throw new UniqueConstraintViolationException(json_encode($messages));
        }

        foreach ($responsible as $key => $value) {
            $this->validateResponsibleData($value, $messages);
        }

        if(sizeof($messages) > 0) {
            throw new ValidationException(json_encode($messages));
        }

        // Recupera os objetos das responsabilidades/responsaveis que
        // foram removidos
        $removedResponsable = array_diff_key($savedResponsible, $responsible);
        // Recupera os objetos das responsabilidades/responsaveis que
        // foram adicionados
        $return['toInsert'] = array_diff_key($responsible, $savedResponsible);
        
        // Todos as instâncias de ResponsabilidadeEntity de todas
        // as pessoas que foram removidas serão também removidas do banco,
        // portanto constrói-se um array com os IDs dessas instâncias
        $return['toDelete'] = array_map(function ($responsability) {
            return $responsability->getId();
        } , $removedResponsable);

        // Remove todos os itens duplicados que estão no array de objetos
        // a serem inseridos
        $return['toInsert'] = $this->verifyDuplicatedInsertedsResponsabilities($return['toInsert']);

        return $return;
    }

    /**
     * Verifica quais itens do array de responsavéis a serem inseridos
     * estão duplicados, e os remove do array
     * 
     * @param $responsabilities Array com os items que representam os
     * responsaveis descritos no Contrato Social a serem inseridos no
     * banco
     */
    public function verifyDuplicatedInsertedsResponsabilities($responsable) {
        $counters = [
            'S' => 0,
            'A' => 0,
            'RL' => 0,
            'C' => 0
        ];

        // Mapeia o array contanto quantos itens de cada
        // tipo de responsabilidade há de modo a remover os
        // duplicados
        $responsable = array_filter($responsable, function ($value) use (&$counters) {
            if (!isset($counters[$value->person_id])) {
                $counters[$value->person_id] = [
                    'S' => 0,
                    'A' => 0,
                    'RL' => 0,
                    'C' => 0
                ];
            }

            $flag = $counters[$value->person_id][$value->type] == 0;
            $counters[$value->person_id][$value->type] += 1;
            
            return $flag;
        });
        
        return $responsable;
    }

    /**
     * Valida os dados de um item da coleção de responsáveis
     * de modo a verficar dados faltantes
     * 
     * @param Object $responsibleItem Item da coleção de responsáveis
     * @param Array $messages Ponteiro para o Array contendo as mensagens
     * de validação a serem mostradas no formulário
     * 
     * @return void
     */
    public function validateResponsibleData($responsibleItem, &$messages) {
        if (empty($responsibleItem->person_id) || is_null($responsibleItem->person_id)) {
            $messages['responsible[' . $responsibleItem->id . ']']['person_id'] = [
                'notEmpty' => 'Por favor selecione a pessoa a ser responsável'
            ];
        }

        if (empty($responsibleItem->type) || is_null($responsibleItem->type)) {
            $messages['responsible[' . $responsibleItem->id . ']']['type'] = [
                'notEmpty' => 'Por favor selecione o tipo de responsabilidade'
            ];
        } else if (!in_array($responsibleItem->type, ["S", "C", "RL", "A"])) {
            $messages['responsible[' . $responsibleItem->id . ']']['type'] = [
                'invalidValue' => 'O tipo de responsabilidade informado não é valido'
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

    }
}