<?php
namespace SocialContract\V1\Rest\Contrato;

class ContratoResourceFactory
{
    public function __invoke($services)
    {
        return new ContratoResource(new ContratoMapper($services->get('doctrine.entitymanager.orm_default')));
    }
}
