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
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'social-contract.rest.usuario',
            1 => 'social-contract.rest.empresa',
            2 => 'social-contract.rest.contrato',
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
            'collection_query_whitelist' => [],
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
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'SocialContract\\V1\\Rest\\Usuario\\Controller' => 'HalJson',
            'SocialContract\\V1\\Rest\\Empresa\\Controller' => 'HalJson',
            'SocialContract\\V1\\Rest\\Contrato\\Controller' => 'HalJson',
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
        ],
        'content_type_whitelist' => [
            'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
            ],
            'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
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
            ],
            \SocialContract\V1\Rest\Empresa\EmpresaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.empresa',
                'route_identifier_name' => 'empresa_id',
                'is_collection' => true,
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'SocialContract\V1\Rest\Empresa\EmpresaHydrator' => [
            'entity_class' => 'SocialContract\V1\Rest\Empresa\EmpresaEntity',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
        ]
    ],
];
