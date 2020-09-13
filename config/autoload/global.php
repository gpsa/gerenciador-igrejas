<?php
return [
    'api-tools-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [],
    ],
    'api-tools-oauth2' => [
        'storage' => 'oauth2.doctrineadapter.default',
        'options' => [
            'always_issue_new_refresh_token' => true,
        ],
    ],
    'api-tools-mvc-auth' => [
        'authentication' => [
            'map' => [
                'Membro\\V1' => 'oauth2_doctrine',
                'Usuario\\V1' => 'oauth2_doctrine',
                'Dizimo\\V1' => 'oauth2_doctrine',
            ],
        ],
    ],
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'generate_proxies' => false,
                'datetime_functions' => [
                    'yearmonth' => \DoctrineExtensions\Query\Mysql\YearMonth::class,
                    'date_format' => \DoctrineExtensions\Query\Mysql\DateFormat::class,
                ],
            ],
        ],
    ],
];
