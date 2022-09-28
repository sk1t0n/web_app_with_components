<?php

use Laminas\Diactoros\ServerRequestFactory;
use Sk1t0n\WebAppWithComponents\App;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();

$app = new App();
$app->initContainer();
$app->handle($request);
