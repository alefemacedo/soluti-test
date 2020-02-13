<?php
/**
 * This file contains all OAuth2 server settings.
 */
return [
    'zf-oauth2' => [
        'storage' => 'oauth2.doctrineadapter.default',
        'options' => [
            'unset_refresh_token_after_use' => false
        ]
    ]
];