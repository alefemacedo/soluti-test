<?php
namespace SocialContract\V1\Rest\Empresa;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\Rest\AbstractResourceListener;
use SocialContract\V1\Rest\Exception\UniqueConstraintViolationException;
use SocialContract\V1\Rest\Exception\ValidationException;

class EmpresaResource extends AbstractResourceListener {

    protected $mapper;

    public function __construct(EmpresaMapper $mapper) {
        $this->mapper = $mapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $return = [
            'message' => ''
        ];

        try {
            $this->mapper->create($data);
            $return['message'] = 'Empresa cadastrada com sucesso';

        } catch (UniqueConstraintViolationException $e) {
            return new ApiProblemResponse(
                new ApiProblem(422, 'Failed Validation', null, null, [
                    'validation_messages' => json_decode($e->getMessage())
                ])
            );
        } catch (ValidationException $e) {
            return new ApiProblemResponse(
                new ApiProblem(422, 'Failed Validation', null, null, [
                    'validation_messages' => json_decode($e->getMessage())
                ])
            );
        } catch (\Exception $e) {
            return new ApiProblem(500, $e->getMessage());
        }
        
        return $return;
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
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
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
