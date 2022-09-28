<?php

namespace Sk1t0n\WebAppWithComponents;

use League\Container\Container;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    private static $container = null;

    public static function getContainer(): Container
    {
        if (self::$container === null) {
            self::$container = new Container();
        }

        return self::$container;
    }

    public function initContainer()
    {
        $di_config = require_once dirname(__DIR__) . '/config/di.php';
        $container = self::getContainer();

        foreach ($di_config as $service => $config) {
            $container->add($service, $config['class'])
                ->addArguments($config['arguments'] ?? []);
        }
    }

    public function handle(ServerRequestInterface $request)
    {
        $container = self::getContainer();

        $relay = $container->get('relay');
        $response = $relay->handle($request);
        $container->get('sapi_emitter')->emit($response);
    }
}
