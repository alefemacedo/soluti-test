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
                    'route' => '/user[/:user_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\Usuario\\Controller',
                    ],
                ],
            ],
            'social-contract.rest.empresa' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/company[/:company_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\Empresa\\Controller',
                    ],
                ],
            ],
            'social-contract.rest.contrato' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/contract[/:contract_id]',
                    'defaults' => [
                        'controller' => 'SocialContract\\V1\\Rest\\Contrato\\Controller',
                    ],
                ],
            ],
            'social-contract.rest.pessoa-fisica' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/person[/:person_id]',
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
            'route_identifier_name' => 'user_id',
            'collection_name' => 'users',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
                3 => 'POST',
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
            'route_identifier_name' => 'company_id',
            'collection_name' => 'companies',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
                3 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'page',
                1 => 'corporate_name',
                2 => 'cnpj',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SocialContract\V1\Rest\Empresa\EmpresaEntity::class,
            'collection_class' => \SocialContract\V1\Rest\Empresa\EmpresaCollection::class,
            'service_name' => 'Empresa',
        ],
        'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
            'listener' => \SocialContract\V1\Rest\Contrato\ContratoResource::class,
            'route_name' => 'social-contract.rest.contrato',
            'route_identifier_name' => 'contract_id',
            'collection_name' => 'contracts',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
                3 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'page',
                1 => 'cnpj',
                2 => 'corporate_name',
            ],
            'page_size' => '25',
            'page_size_param' => null,
            'entity_class' => \SocialContract\V1\Rest\Contrato\ContratoEntity::class,
            'collection_class' => \SocialContract\V1\Rest\Contrato\ContratoCollection::class,
            'service_name' => 'Contrato',
        ],
        'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
            'listener' => \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaResource::class,
            'route_name' => 'social-contract.rest.pessoa-fisica',
            'route_identifier_name' => 'person_id',
            'collection_name' => 'people',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
                3 => 'POST',
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
                2 => 'multipart/form-data',
                3 => 'text/html',
            ],
            'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
                0 => 'application/vnd.social-contract.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Doctrine\ORM\PersistentCollection::class => [
                'hydrator' => 'ArraySerializable',
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.contrato',
                'route_identifier_name' => 'contract_id',
                'isCollection' => true,
            ],
            \SocialContract\V1\Rest\Usuario\UsuarioEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.usuario',
                'route_identifier_name' => 'user_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 1,
            ],
            \SocialContract\V1\Rest\Usuario\UsuarioCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.usuario',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ],
            \SocialContract\V1\Rest\Contrato\ContratoEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.contrato',
                'route_identifier_name' => 'contract_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 4,
            ],
            \SocialContract\V1\Rest\Contrato\ResponsabilidadeEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.contrato',
                'route_identifier_name' => 'contract_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 2,
            ],
            \SocialContract\V1\Rest\Contrato\ContratoCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.contrato',
                'route_identifier_name' => 'contract_id',
                'is_collection' => true,
            ],
            \SocialContract\V1\Rest\Empresa\EmpresaEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.empresa',
                'route_identifier_name' => 'company_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 2,
            ],
            \SocialContract\V1\Rest\Empresa\EmpresaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.empresa',
                'route_identifier_name' => 'company_id',
                'is_collection' => true,
            ],
            \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.pessoa-fisica',
                'route_identifier_name' => 'person_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
                'max_depth' => 1,
            ],
            \SocialContract\V1\Rest\PessoaFisica\PessoaFisicaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'social-contract.rest.pessoa-fisica',
                'route_identifier_name' => 'person_id',
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
        'SocialContract\\V1\\Rest\\Contrato\\ContratoHydrator' => [
            'entity_class' => \SocialContract\V1\Rest\Contrato\ContratoEntity::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'responsible' => 'ZF\\Doctrine\\Hydrator\\Strategy\\CollectionExtract',
            ],
            'use_generated_hydrator' => true,
        ],
        'SocialContract\\V1\\Rest\\Contrato\\ResponsabilidadeHydrator' => [
            'entity_class' => \SocialContract\V1\Rest\Contrato\ResponsabilidadeEntity::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'socialContract' => 'ZF\\Doctrine\\Hydrator\\Strategy\\EntityLink',
            ],
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
        'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
            'input_filter' => 'SocialContract\\V1\\Rest\\Contrato\\Validator',
        ],
        'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
            'input_filter' => 'SocialContract\\V1\\Rest\\PessoaFisica\\Validator',
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
                            'message' => 'Por favor informe seu nome',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'Nome da pessoa a qual o usuário é vinculado',
                'field_type' => 'String',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor defina a senha para o usuário',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'password',
                'description' => 'Senha da instância de Usuário',
                'field_type' => 'String',
                'allow_empty' => true,
            ],
        ],
        'SocialContract\\V1\\Rest\\Empresa\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe o CNPJ da empresa',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '14',
                            'min' => '14',
                            'message' => 'Por favor informe um CNPJ válido. Deve conter exatamente 14 caracteres',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'cnpj',
                'description' => 'CNPJ da empresa',
                'field_type' => 'String',
                'continue_if_empty' => false,
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'name',
                'description' => 'Nome fantasia da empresa',
                'field_type' => 'String',
                'allow_empty' => true,
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\File\MimeType::class,
                        'options' => [
                            'mimeType' => 'application/pdf',
                            'message' => 'O arquivo informado não possui um tipo permitido. Por favor, informe um arquivo do tipo PDF (application/pdf)',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\File\RenameUpload::class,
                        'options' => [
                            'randomize' => true,
                            'target' => 'data/Files',
                        ],
                    ],
                ],
                'name' => 'file',
                'description' => 'Arquivo PDF representando o Contrato Social da empresa',
                'field_type' => 'File',
                'type' => \Zend\InputFilter\FileInput::class,
                'allow_empty' => true,
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe a rasão social da empresa',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'corporate_name',
                'description' => 'Rasão Social da empresa',
                'field_type' => 'String',
            ],
            4 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'responsible',
                'description' => 'Responsáveis pela empresa de acordo com o Contrato Social',
                'field_type' => 'Object',
                'allow_empty' => true,
            ],
            5 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'userFile',
                'description' => 'Identificador do usuário que realizou o último upload de arquivo para o contrato social da empresa',
                'field_type' => 'String',
                'allow_empty' => true,
            ],
        ],
        'SocialContract\\V1\\Rest\\Contrato\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor insira o arquivo PDF do contrato social',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\Validator\File\MimeType::class,
                        'options' => [
                            'mimeType' => 'application/pdf',
                            'message' => 'O arquivo selecionado é do tipo incorreto. Por favor selecione um arquivo do tipo PDF (application/pdf)',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\File\RenameUpload::class,
                        'options' => [
                            'randomize' => true,
                            'target' => 'data/Files',
                        ],
                    ],
                ],
                'name' => 'file',
                'description' => 'Arquivo PDF representando o Contrato Social da empresa',
                'field_type' => 'File',
                'allow_empty' => false,
                'type' => \Zend\InputFilter\FileInput::class,
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe os dados dos responsáveis descritos no Contrato Social',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'responsible',
                'description' => 'Coleção de objetos com os dados dos responsáveis descritos no Contrato Social, como ID da pessoa e sua responsabilidade',
                'field_type' => 'Object',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe o ID da empresa a qual o Contrato Social é referente',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'company_id',
                'description' => 'Identificador (ID do banco de dados) da empresa a qual o Contrato Social é referente',
                'field_type' => 'Integer',
                'allow_empty' => false,
            ],
            3 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'validated',
                'description' => 'Define se a instância em questão já foi validada',
                'field_type' => 'Boolean',
                'allow_empty' => true,
            ],
        ],
        'SocialContract\\V1\\Rest\\PessoaFisica\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\NotEmpty::class,
                        'options' => [
                            'message' => 'Por favor informe o nome da pessoa',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'Nome da pessoa',
                'field_type' => 'String',
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
                'description' => 'CPF que identifica a pessoa',
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
                    'GET' => true,
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
            'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
            'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
