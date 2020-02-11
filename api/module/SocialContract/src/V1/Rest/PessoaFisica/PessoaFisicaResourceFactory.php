<?php
namespace SocialContract\V1\Rest\PessoaFisica;

class PessoaFisicaResourceFactory
{
    public function __invoke($services)
    {
        return new PessoaFisicaResource();
    }
}
