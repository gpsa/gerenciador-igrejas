<?php
return [
    'router' => [
        'routes' => [
            'membro.rest.doctrine.pessoa-membro' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/membro/pessoa[/:pessoa_membro_id]',
                    'defaults' => [
                        'controller' => 'Membro\\V1\\Rest\\PessoaMembro\\Controller',
                    ],
                ],
            ],
            'membro.rpc.relatorio-aniversariantes' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/relatorios/aniversariantes',
                    'defaults' => [
                        'controller' => 'Membro\\V1\\Rpc\\RelatorioAniversariantes\\Controller',
                        'action' => 'relatorioAniversariantes',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'membro.rest.doctrine.pessoa-membro',
            1 => 'membro.rpc.relatorio-aniversariantes',
        ],
    ],
    'zf-rest' => [
        'Membro\\V1\\Rest\\PessoaMembro\\Controller' => [
            'listener' => \Membro\V1\Rest\PessoaMembro\PessoaMembroResource::class,
            'route_name' => 'membro.rest.doctrine.pessoa-membro',
            'route_identifier_name' => 'pessoa_membro_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'pessoa_membro',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => 'page_size',
            'entity_class' => \Application\Entity\PessoaMembro::class,
            'collection_class' => \Membro\V1\Rest\PessoaMembro\PessoaMembroCollection::class,
            'service_name' => 'PessoaMembro',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Membro\\V1\\Rest\\PessoaMembro\\Controller' => 'HalJson',
            'Membro\\V1\\Rpc\\RelatorioAniversariantes\\Controller' => 'HalJson',
        ],
        'accept-whitelist' => [
            'Membro\\V1\\Rest\\PessoaMembro\\Controller' => [
                0 => 'application/vnd.membro.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'Membro\\V1\\Rest\\PessoaMembro\\Controller' => [
                0 => 'application/json',
            ],
        ],
        'accept_whitelist' => [
            'Membro\\V1\\Rpc\\RelatorioAniversariantes\\Controller' => [
                0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ],
        'content_type_whitelist' => [
            'Membro\\V1\\Rpc\\RelatorioAniversariantes\\Controller' => [
                0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Application\Entity\PessoaMembro::class => [
                'route_identifier_name' => 'pessoa_membro_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'membro.rest.doctrine.pessoa-membro',
                'hydrator' => 'Membro\\V1\\Rest\\PessoaMembro\\PessoaMembroHydrator',
            ],
            \Membro\V1\Rest\PessoaMembro\PessoaMembroCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'membro.rest.doctrine.pessoa-membro',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-apigility' => [
        'doctrine-connected' => [
            \Membro\V1\Rest\PessoaMembro\PessoaMembroResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Membro\\V1\\Rest\\PessoaMembro\\PessoaMembroHydrator',
                'query_providers' => [
                    'default' => 'default_orm',
                    'fetch_all' => \Membro\V1\Rest\PessoaMembro\PessoaMembroFetchAll::class,
                ],
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'Membro\\V1\\Rest\\PessoaMembro\\PessoaMembroHydrator' => [
            'entity_class' => \Application\Entity\PessoaMembro::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'dizimos' => \ZF\Doctrine\Hydrator\Strategy\CollectionLink::class,
            ],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation' => [
        'Membro\\V1\\Rest\\PessoaMembro\\Controller' => [
            'input_filter' => 'Membro\\V1\\Rest\\PessoaMembro\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Membro\\V1\\Rest\\PessoaMembro\\Validator' => [
            0 => [
                'name' => 'nome',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                ],
                'error_message' => 'Informe o nome do membro',
            ],
            1 => [
                'name' => 'sexo',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            2 => [
                'name' => 'endereco',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            3 => [
                'name' => 'cep',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            4 => [
                'name' => 'telefoneResidencial',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            5 => [
                'name' => 'telefoneComercial',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            6 => [
                'name' => 'telefoneCelular',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            7 => [
                'name' => 'nomePai',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            8 => [
                'name' => 'nomeMae',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            9 => [
                'name' => 'estadoCivil',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            10 => [
                'name' => 'nomeConjuge',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            11 => [
                'name' => 'dataNascimentoConjuge',
                'required' => false,
                'filters' => [],
                'validators' => [],
            ],
            12 => [
                'name' => 'conjugeEvangelico',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            13 => [
                'name' => 'conjugeIgreja',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            14 => [
                'name' => 'filhos',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            15 => [
                'name' => 'nomeFilho1',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            16 => [
                'name' => 'idadeFilho1',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            17 => [
                'name' => 'nomeFilho2',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            18 => [
                'name' => 'idadeFilho2',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            19 => [
                'name' => 'nomeFilho3',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            20 => [
                'name' => 'idadeFilho3',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
            21 => [
                'name' => 'dataBatismo',
                'required' => false,
                'filters' => [],
                'validators' => [],
            ],
            22 => [
                'name' => 'dataNascimento',
                'required' => false,
                'filters' => [],
                'validators' => [],
            ],
            23 => [
                'name' => 'dataCongregacao',
                'required' => false,
                'filters' => [],
                'validators' => [],
            ],
            24 => [
                'name' => 'cargo',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                ],
                'allow_empty' => true,
            ],
            25 => [
                'name' => 'envelope',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 3,
                        ],
                    ],
                ],
            ],
            26 => [
                'name' => 'categoria',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 3,
                        ],
                    ],
                ],
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Membro\\V1\\Rest\\PessoaMembro\\Controller' => [
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
                    'PATCH' => false,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
    'zf-apigility-doctrine-query-provider' => [
        'factories' => [
            \Membro\V1\Rest\PessoaMembro\PessoaMembroFetchAll::class => \Application\Doctrine\ORMQueryBuilderFactory::class,
        ],
    ],
    'zf-doctrine-querybuilder-filter-orm' => [
        'aliases' => [
            'birthday' => \Application\Filter\ORM\BirthDay::class,
        ],
        'factories' => [
            \Application\Filter\ORM\BirthDay::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            'Membro\\V1\\Rpc\\RelatorioAniversariantes\\Controller' => \Membro\V1\Rpc\RelatorioAniversariantes\RelatorioAniversariantesControllerFactory::class,
        ],
    ],
    'zf-rpc' => [
        'Membro\\V1\\Rpc\\RelatorioAniversariantes\\Controller' => [
            'service_name' => 'RelatorioAniversariantes',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'membro.rpc.relatorio-aniversariantes',
        ],
    ],
];
