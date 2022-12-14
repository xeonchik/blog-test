<?php
declare(strict_types=1);

namespace Blog;

use Blog\Controller\AuthController;
use Blog\Controller\BlogController;
use Blog\Router\Router;
use Blog\Router\RouterInterface;
use Psr\Container\ContainerInterface;

class ApplicationRouterFactory
{
    public function init(ContainerInterface $container): RouterInterface
    {
        $router = new Router();

        $router->addRoute(Router::GET, '/', function ($request) use ($container) {
            /** @var BlogController $controller */
            $controller = $container->get(BlogController::class);
            return $controller->index($request);
        });

        // Not enough time to implement paths like /view/{$post}
        $router->addRoute(Router::GET, '/view', function ($request) use ($container) {
            /** @var BlogController $controller */
            $controller = $container->get(BlogController::class);
            return $controller->view($request);
        });

        $router->addRoute(Router::GET, '/login', function ($request) use ($container) {
            /** @var AuthController $controller */
            $controller = $container->get(AuthController::class);
            return $controller->loginForm($request);
        });

        $router->addRoute(Router::POST, '/login', function ($request) use ($container) {
            /** @var AuthController $controller */
            $controller = $container->get(AuthController::class);
            return $controller->login($request);
        });

        return $router;
    }
}
