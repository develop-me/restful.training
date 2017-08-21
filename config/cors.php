<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedMethods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
    'allowedHeaders' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,
];
