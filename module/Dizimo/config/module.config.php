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
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'dizimo.rest.doctrine.financas-dizimo',
        ],
    ],
    'zf-rest' => [
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
    'zf-content-negotiation' => [
        'controllers' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => 'HalJson',
        ],
        'accept-whitelist' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
                0 => 'application/vnd.dizimo.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'Dizimo\\V1\\Rest\\FinancasDizimo\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
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
    'zf-apigility' => [
        'doctrine-connected' => [
            \Dizimo\V1\Rest\FinancasDizimo\FinancasDizimoResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Dizimo\\V1\\Rest\\FinancasDizimo\\FinancasDizimoHydrator',
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'Dizimo\\V1\\Rest\\FinancasDizimo\\FinancasDizimoHydrator' => [
            'entity_class' => \Application\Entity\FinancasDizimo::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'membro' => \ZF\Doctrine\Hydrator\Strategy\EntityLink::class,
            ],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation' => [
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
                        'name' => \Zend\I18n\Validator\DateTime::class,
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
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\IsFloat::class,
                        'options' => [
                            'message' => 'Informe o valor no formato 0000.00',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/^([0-9]{0,8})\\.[0-9]{1,2}/',
                            'message' => 'O número deve seguir o seguinte padrão: 0.00, e são permitidos apenas 8 números à esquerda.',
                            'breakchainonfailure' => true,
                        ],
                    ],
                    2 => [
                        'name' => \Zend\Validator\StringLength::class,
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
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                    ],
                ],
                'validators' => [],
            ],
        ],
    ],
    'zf-mvc-auth' => [
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
        ],
    ],
];
