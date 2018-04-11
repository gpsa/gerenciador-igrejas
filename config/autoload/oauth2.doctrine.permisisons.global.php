<?php

return [
    'zf-oauth2-doctrine-permissions-acl' => [
        'role' => [
            'entity' => 'Application\Entity\OAuth2\Role',
            'object_manager' => 'doctrine.entitymanager.orm_default',
        ],
    ],
];
