<?php
namespace SocialContract\V1\Rest\Empresa;

class EmpresaResourceFactory
{
    public function __invoke($services)
    {
        return new EmpresaResource();
    }
}
