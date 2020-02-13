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
    'zf-mvc-auth' => [
        'authentication' => [
            'map' => [
                'SocialContract\\V1' => 'oauth2_doctrine',
            ],
        ],
    ],
];
