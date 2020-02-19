<?php
namespace SocialContract\V1\Rest\Contrato;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use SocialContract\V1\Rest\Exception\NotFoundException;

class ContratoResource extends AbstractResourceListener {
    protected $mapper;

    public function __construct(ContratoMapper $mapper) {
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
        return new ApiProblem(405, 'The POST method has not been defined');
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
        try {
            $isFile = $this->getEvent()->getQueryParams()->get("isFile");
            $filePath = $this->getEvent()->getQueryParams()->get("file_path");
            if (isset($isFile) && $isFile) {
                if (file_exists($filePath) && is_file($filePath)) {
                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline; filename="contract.pdf"');
                    header('Content-Transfer-Encoding: binary');
                    header("Access-Control-Allow-Origin: *");
                    header('Accept-Ranges: bytes');
                    readfile($filePath);
                } else {
                    throw new NotFoundException("O aquivo requisitado não existe.");
                }
            }
            
            $contract = $this->mapper->fetch($id);

        } catch (NotFoundException $e) {
            return new ApiProblem(404, $e->getMessage());
        } catch (\Exception $e) {
            return new ApiProblem(500, $e->getMessage());
        }

        return $contract;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $contracts = $this->mapper->fetchAll($params);
        return $contracts;
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
        $return = [
            'message' => ''
        ];

        try {
            if (isset($data->validate) && $data->validate) {
                $this->mapper->validate($id);
            }

            $return['message'] = "O contrato social foi validado com sucesso";
        } catch (NotFoundException $e) {
            return new ApiProblem(404, $e->getMessage());
        } catch (\Exception $e) {
            return new ApiProblem(500, $e->getMessage());
        }

        return $return;
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
