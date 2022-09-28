<?php

namespace Sk1t0n\WebAppWithComponents\Middleware;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Router;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sk1t0n\WebAppWithComponents\App;

class RouterMiddleware implements MiddlewareInterface
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->addRoutes();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $response = $this->router->dispatch($request);
        } catch (NotFoundException $e) {
            $html = "<h1>{$e->getMessage()}</h1>";
            $responseFactory = App::getContainer()->get('response_factory');
            $response = $responseFactory->createResponse(404);
            $response->getBody()->write($html);
        } finally {
            return $response;
        }
    }

    private function addRoutes()
    {
        $this->router->get('/', 'Sk1t0n\WebAppWithComponents\Controller\MainController::index');
    }
}
