<?php
namespace SocialContract\V1\Rest\Usuario;

class UsuarioResourceFactory
{
    public function __invoke($services) {
        return new UsuarioResource(new UsuarioMapper($services->get('doctrine.entitymanager.orm_default')));
    }
}
