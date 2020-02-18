<?php
namespace SocialContract\V1\Rest\PessoaFisica;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\Rest\AbstractResourceListener;
use SocialContract\V1\Rest\Exception\NotFoundException;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;
use SocialContract\V1\Rest\Exception\ValidationException;

class PessoaFisicaResource extends AbstractResourceListener
{
    private $mapper;

    public function __construct(PessoaFisicaMapper $mapper) {
        $this->mapper = $mapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $return = [
            'message' => ''
        ];

        try{
            $this->mapper->create($data);
            $return['message'] = "Pessoa cadastrada com sucesso.";
        } catch (ValidationException $e) {
            return new ApiProblemResponse(
                new ApiProblem(422, 'Failed Validation', null, null, [
                    'validation_messages' => json_decode($e->getMessage())
                ])
            );
        } catch (UniqueConstraintViolationException $e) {
            return new ApiProblemResponse(
                new ApiProblem(422, 'Failed Validation', null, null, [
                    'validation_messages' => json_decode($e->getMessage())
                ])
            );
        } catch (\Exception $e) {
            return new ApiProblem(500, $e->getMessage());
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $return = [
            'person' => null,
            'hasUser' => false,
            'message' => ''
        ];
        try {
            $person = $this->mapper->fetch($id);

            if (!is_null($person)) {
                $return['hasUser'] = !is_null($person->getUser());
                $person->setUser(null);
                $return['person'] = $person;
            }
        } catch (\Exception $e) {
            return new ApiProblem(500, $e->getMessage());
        }

        return $return;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $return = [];

        try {
            $people = $this->mapper->fetchAll();
            foreach ($people as $person) {
                $return[] = [
                    'value' => $person->getId(),
                    'text' => $person->getName() . ' - ' . $person->getCpf()
                ];
            }
        } catch (\Exception $e) {
            return new ApiProblem(500, $e->getMessage());
        }

        return $return;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
