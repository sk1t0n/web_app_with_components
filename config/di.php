<?php

use Laminas\Diactoros\ResponseFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Relay\Relay;
use Sk1t0n\WebAppWithComponents\Middleware\RouterMiddleware;

return [
    'relay' => [
        'class' => Relay::class,
        'arguments' => [
            [
                new RouterMiddleware()
            ]
        ]
    ],
    'sapi_emitter' => [
        'class' => SapiEmitter::class
    ],
    'response_factory' => [
        'class' => ResponseFactory::class
    ]
];
