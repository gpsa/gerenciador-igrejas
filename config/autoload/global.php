<?php
return [
    'zf-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [
            'dummy' => [],
        ],
    ],
    'zf-oauth2' => [
        'storage' => 'oauth2.doctrineadapter.default',
        'options' => [
            'always_issue_new_refresh_token' => true,
        ]
    ],
    'zf-mvc-auth' => [
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
                'generate_proxies'  => false,
                'datetime_functions' => [
                    'yearmonth' => \DoctrineExtensions\Query\Mysql\YearMonth::class,
                    'date_format' => \DoctrineExtensions\Query\Mysql\DateFormat::class
                ]
            ]
        ]
    ]

];
