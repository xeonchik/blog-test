<?php
declare(strict_types=1);

namespace Blog\Router;

use Blog\Controller\BlogController;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const ANY = '*';

    /**
     * @var Route[]
     */
    protected array $routes = [];

    /**
     * @throws \Exception
     */
    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                $handler = $route->getHandler();

                $response = $handler($request);

                if (!$response instanceof ResponseInterface) {
                    // we could implement classes for different exception types
                    throw new \Exception('Route handler should return ResponseInterface object. Returned "' . gettype($response) . '"');
                }

                return $response;
            }
        }

        // throw 404 exception if no route found
        return new HtmlResponse('<h2>Page not found</h2>', 404);
    }

    public function addRoute(string $method, string $path, \Closure $handler)
    {
        $route = new Route($method, $path, $handler);
        $this->routes[] = $route;
    }
}
