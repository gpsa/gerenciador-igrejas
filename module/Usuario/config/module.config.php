<?php
return [
    'router' => [
        'routes' => [
            'usuario.rest.doctrine.usuario' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/usuarios/usuario[/:usuario_id]',
                    'defaults' => [
                        'controller' => 'Usuario\\V1\\Rest\\Usuario\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'usuario.rest.doctrine.usuario',
        ],
    ],
    'api-tools-rest' => [
        'Usuario\\V1\\Rest\\Usuario\\Controller' => [
            'listener' => \Usuario\V1\Rest\Usuario\UsuarioResource::class,
            'route_name' => 'usuario.rest.doctrine.usuario',
            'route_identifier_name' => 'usuario_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'usuarios',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Application\Entity\OAuth2\Usuario::class,
            'collection_class' => \Usuario\V1\Rest\Usuario\UsuarioCollection::class,
            'service_name' => 'Usuario',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Usuario\\V1\\Rest\\Usuario\\Controller' => 'HalJson',
        ],
        'accept-whitelist' => [
            'Usuario\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/vnd.usuario.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'Usuario\\V1\\Rest\\Usuario\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Application\Entity\OAuth2\Usuario::class => [
                'route_identifier_name' => 'usuario_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'usuario.rest.doctrine.usuario',
                'hydrator' => 'Usuario\\V1\\Rest\\Usuario\\UsuarioHydrator',
            ],
            \Usuario\V1\Rest\Usuario\UsuarioCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usuario.rest.doctrine.usuario',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools' => [
        'doctrine-connected' => [
            \Usuario\V1\Rest\Usuario\UsuarioResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Usuario\\V1\\Rest\\Usuario\\UsuarioHydrator',
                'entity_factory' => 'oauth2.doctrineadapter.default',
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'Usuario\\V1\\Rest\\Usuario\\UsuarioHydrator' => [
            'entity_class' => \Application\Entity\OAuth2\Usuario::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
            'filters' => [
                'custom_filter_name' => [
                    'condition' => 'and',
                    'filter' => \Usuario\V1\Rest\Usuario\UsuarioFilter::class,
                ],
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Usuario\\V1\\Rest\\Usuario\\Controller' => [
            'input_filter' => 'Usuario\\V1\\Rest\\Usuario\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Usuario\\V1\\Rest\\Usuario\\Validator' => [
            0 => [
                'name' => 'username',
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
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
            1 => [
                'name' => 'password',
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
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 128,
                        ],
                    ],
                ],
            ],
            2 => [
                'name' => 'displayName',
                'required' => false,
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
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                ],
            ],
            3 => [
                'name' => 'state',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\Boolean::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\ToInt::class,
                        'options' => [],
                    ],
                ],
                'validators' => [],
            ],
            4 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\EmailAddress::class,
                        'options' => [
                            'message' => 'Informe um e-mail válido',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StripNewlines::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StripTags::class,
                        'options' => [],
                    ],
                    2 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                    3 => [
                        'name' => \Laminas\Filter\StringToLower::class,
                        'options' => [],
                    ],
                ],
                'name' => 'email',
                'error_message' => 'Informe um e-mail válido',
                'allow_empty' => true,
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Usuario\V1\Rest\Usuario\UsuarioFilter::class => \Laminas\ServiceManager\Factory\InvokableFactory::class,
            \Usuario\V1\Rest\Usuario\UsuarioFactory::class => \Laminas\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'Usuario\\V1\\Rest\\Usuario\\Controller' => [
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
                    'PUT' => false,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
