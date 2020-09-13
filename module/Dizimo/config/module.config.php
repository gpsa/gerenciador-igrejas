<?php
return [
    'router' => [
        'routes' => [
            'dizimo.rest.doctrine.financas-dizimo' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/dizimos/dizimo[/:financas_dizimo_id]',
                    'defaults' => [
                        'controller' => 'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller',
                    ],
                ],
            ],
            'dizimo.rpc.relatorio' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/relatorios/dizimos',
                    'defaults' => [
                        'controller' => 'Dizimo\\V1\\Rpc\\Relatorio\\Controller',
                        'action' => 'relatorio',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'dizimo.rest.doctrine.financas-dizimo',
            1 => 'dizimo.rpc.relatorio',
        ],
    ],
    'api-tools-rest' => [
        'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
            'listener' => \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoResource::class,
            'route_name' => 'dizimo.rest.doctrine.financas-dizimo',
            'route_identifier_name' => 'financas_dizimo_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'financas_dizimo',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
                2 => 'POST',
                3 => 'PATCH',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => '12',
            'page_size_param' => 'page_size',
            'entity_class' => \Application\Entity\FinancasDizimo::class,
            'collection_class' => \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoCollection::class,
            'service_name' => 'FinancasDizimo',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => 'HalJsonOrXLSX',
            'Dizimo\\V1\\Rpc\\Relatorio\\Controller' => 'HalJson',
        ],
        'accept-whitelist' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
                0 => 'application/vnd.dizimo.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
                3 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ],
        'content-type-whitelist' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
                0 => 'application/json',
                1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ],
        'accept_whitelist' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
                0 => 'application/json',
                1 => 'application/*+json',
                2 => 'application/vnd.ms-excel',
                3 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
            'Dizimo\\V1\\Rpc\\Relatorio\\Controller' => [
                0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ],
        'content_type_whitelist' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
                0 => 'application/json',
                1 => 'application/vnd.ms-excel',
                2 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
            'Dizimo\\V1\\Rpc\\Relatorio\\Controller' => [
                0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ],
        'selectors' => [
            'HalJson' => [
                \Laminas\ApiTools\Hal\View\HalJsonModel::class => [
                    0 => 'application/json',
                    1 => 'application/*+json',
                ],
            ],
            'XSLX' => [
                'Application\\ContentNegotiation\\XLSX' => [
                    0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ],
            ],
            'HalJsonOrXLSX' => [
                \Laminas\ApiTools\Hal\View\HalJsonModel::class => [
                    0 => 'application/json',
                    1 => 'application/*+json',
                ],
                'Application\\ContentNegotiation\\XLSX' => [
                    0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ],
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Application\Entity\FinancasDizimo::class => [
                'route_identifier_name' => 'financas_dizimo_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'dizimo.rest.doctrine.financas-dizimo',
                'hydrator' => 'Dizimo\\V1\\Rest\\FinancasDizimo\\FinancasDizimoHydrator',
            ],
            \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'dizimo.rest.doctrine.financas-dizimo',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'doctrine-connected' => [
            \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Dizimo\\V1\\Rest\\FinancasDizimo\\FinancasDizimoHydrator'
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'Dizimo\\V1\\Rest\\FinancasDizimo\\FinancasDizimoHydrator' => [
            'entity_class' => \Application\Entity\FinancasDizimo::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'membro' => \ApiSkeletons\Doctrine\Hydrator\Strategy\EntityLink::class,
            ],
            'use_generated_hydrator' => true,
        ],
    ],
    'api-tools-content-validation' => [
        'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
            'input_filter' => 'Dizimo\\V1\\Rest\\FinancasDizimo\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Dizimo\\V1\\Rest\\FinancasDizimo\\Validator' => [
            0 => [
                'name' => 'data',
                'required' => true,
                'filters' => [],
                'validators' => [
                    0 => [
                        'name' => \Laminas\I18n\Validator\DateTime::class,
                        'options' => [
                            'message' => 'Formato de data inválido',
                            'pattern' => 'Y-m-d',
                        ],
                    ],
                ],
            ],
            1 => [
                'name' => 'valor',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Laminas\I18n\Validator\IsFloat::class,
                        'options' => [
                            'message' => 'Informe o valor no formato 0000.00',
                        ],
                    ],
                    1 => [
                        'name' => \Laminas\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/^([0-9]{0,8})\\.[0-9]{1,2}/',
                            'message' => 'O número deve seguir o seguinte padrão: 0.00, e são permitidos apenas 8 números à esquerda.',
                            'breakchainonfailure' => true,
                        ],
                    ],
                    2 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '11',
                        ],
                    ],
                ],
            ],
            2 => [
                'name' => 'membro',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Laminas\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
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
            'Dizimo\\V1\\Rpc\\Relatorio\\Controller' => [
                'actions' => [
                    'Relatorio' => [
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'Dizimo\\V1\\Rpc\\Relatorio\\Controller' => \Dizimo\V1\Rpc\Relatorio\RelatorioControllerFactory::class,
        ],
    ],
    'api-tools-rpc' => [
        'Dizimo\\V1\\Rpc\\Relatorio\\Controller' => [
            'service_name' => 'RelatorioDizimos',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'dizimo.rpc.relatorio',
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoMembroStrategy::class => \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoMembroStrategy::class
        ]
    ]
];
