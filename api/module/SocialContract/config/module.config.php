<?php
return [
    'doctrine' => [
        'driver' => [
            'SocialContract_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => './module/SocialContract/src/V1/',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'SocialContract' => 'SocialContract_driver',
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \SocialContract\V1\Rest\Usuario\UsuarioResource::class => \SocialContract\V1\Rest\Usuario\UsuarioResourceFactory::class,
            \SocialContract\V1\Rest\Empresa\EmpresaResource::class => \SocialContract\V1\Rest\Empresa\EmpresaResourceFactory::class,
            \SocialContract\V1\Rest\Contrato\ContratoResource::class => \SocialContract\V1\Rest\Contrato\ContratoResourceFactory::class,
            \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaResource::class => \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'social-contract.rest.usuario' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/usuario[/:usuario_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\Usuario\\Controller',
                    ],
                ],
            ],
            'social-contract.rest.empresa' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/empresa[/:empresa_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\Empresa\\Controller',
                    ],
                ],
            ],
            'social-contract.rest.contrato' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/contrato[/:contrato_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\Contrato\\Controller',
                    ],
                ],
            ],
            'social-contract.rest.pessoa-fisica' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/pessoa[/:pessoa_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\PessoaFisica\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'social-contract.rest.usuario',
            1 => 'social-contract.rest.empresa',
            2 => 'social-contract.rest.contrato',
            3 => 'social-contract.rest.pessoa-fisica',
        ],
    ],
    'zf-rest' => [
        'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
            'listener' => \SocialContract\V1\Rest\Usuario\UsuarioResource::class,
            'route_name' => 'social-contract.rest.usuario',
            'route_identifier_name' => 'usuario_id',
            'collection_name' => 'usuarios',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'filter',
                1 => 'pageNumber',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SocialContract\V1\Rest\Usuario\UsuarioEntity::class,
            'collection_class' => \SocialContract\V1\Rest\Usuario\UsuarioCollection::class,
            'service_name' => 'Usuario',
        ],
        'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
            'listener' => \SocialContract\V1\Rest\Empresa\EmpresaResource::class,
            'route_name' => 'social-contract.rest.empresa',
            'route_identifier_name' => 'empresa_id',
            'collection_name' => 'empresas',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SocialContract\V1\Rest\Empresa\EmpresaEntity::class,
            'collection_class' => \SocialContract\V1\Rest\Empresa\EmpresaCollection::class,
            'service_name' => 'Empresa',
        ],
        'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
            'listener' => \SocialContract\V1\Rest\Contrato\ContratoResource::class,
            'route_name' => 'social-contract.rest.contrato',
            'route_identifier_name' => 'contrato_id',
            'collection_name' => 'contratos',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SocialContract\V1\Rest\Contrato\ContratoEntity::class,
            'collection_class' => \SocialContract\V1\Rest\Contrato\ContratoCollection::class,
            'service_name' => 'Contrato',
        ],
        'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
            'listener' => \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaResource::class,
            'route_name' => 'social-contract.rest.pessoa-fisica',
            'route_identifier_name' => 'pessoa_id',
            'collection_name' => 'pessoas',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity::class,
            'collection_class' => \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaCollection::class,
            'service_name' => 'PessoaFisica',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'SocialContract\\V1\\Rest\\Usuario\\Controller' => 'HalJson',
            'SocialContract\\V1\\Rest\\Empresa\\Controller' => 'HalJson',
            'SocialContract\\V1\\Rest\\Contrato\\Controller' => 'HalJson',
            'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
            ],
            'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \SocialContract\V1\Rest\Usuario\UsuarioEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.usuario',
                'route_identifier_name' => 'usuario_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 1,
            ],
            \SocialContract\V1\Rest\Usuario\UsuarioCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.usuario',
                'route_identifier_name' => 'usuario_id',
                'is_collection' => true,
            ],
            \SocialContract\V1\Rest\Contrato\ContratoEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.contrato',
                'route_identifier_name' => 'contrato_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 1,
            ],
            \SocialContract\V1\Rest\Contrato\ContratoCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.contrato',
                'route_identifier_name' => 'contrato_id',
                'is_collection' => true,
            ],
            \SocialContract\V1\Rest\Empresa\EmpresaEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.empresa',
                'route_identifier_name' => 'empresa_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 1,
            ],
            \SocialContract\V1\Rest\Empresa\EmpresaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.empresa',
                'route_identifier_name' => 'empresa_id',
                'is_collection' => true,
            ],
            \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.pessoa-fisica',
                'route_identifier_name' => 'pessoa_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 1,
            ],
            \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.pessoa-fisica',
                'route_identifier_name' => 'pessoa_id',
                'is_collection' => true,
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'SocialContract\\V1\\Rest\\Empresa\\EmpresaHydrator' => [
            'entity_class' => \SocialContract\V1\Rest\Empresa\EmpresaEntity::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation' => [
        'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
            'input_filter' => 'SocialContract\\V1\\Rest\\Usuario\\Validator',
        ],
        'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
            'input_filter' => 'SocialContract\\V1\\Rest\\Empresa\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'SocialContract\\V1\\Rest\\Usuario\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [
                            'message' => 'Por favor informe um e-mail válido',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe o e-mail do usuário',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'email',
                'description' => 'E-mail/Login do usuário',
                'field_type' => 'email',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe o CPF da pessoa',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'cpf',
                'description' => 'CPF da pessoa a qual o usuário pertence',
                'field_type' => 'string',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informar o nome da pessoa',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'nome',
                'description' => 'Nome da pessoa a qual o usuário é vinculado',
                'field_type' => 'string',
                'allow_empty' => false,
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe uma senha para o usuário',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'senha',
                'description' => 'Senha do usuário',
                'field_type' => 'string',
            ],
        ],
        'SocialContract\\V1\\Rest\\Empresa\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'nome',
                'description' => 'Nome fantasia da empresa',
                'field_type' => 'String',
                'allow_empty' => true,
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe o CNPJ da empresa',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'cnpj',
                'description' => 'CNPJ da empresa',
                'field_type' => 'String',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe a Rasão Social da empresa',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'rasao_social',
                'description' => 'Rasão Social da empresa',
                'field_type' => 'String',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
            'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
