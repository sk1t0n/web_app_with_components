<?php

namespace Sk1t0n\WebAppWithComponents\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sk1t0n\WebAppWithComponents\App;

class MainController
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $responseFactory = App::getContainer()->get('response_factory');
        $response = $responseFactory->createResponse(200);
        $response->getBody()->write('<h1>Example</h1>');

        return $response;
    }
}
