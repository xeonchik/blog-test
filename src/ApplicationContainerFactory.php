<?php
declare(strict_types=1);

namespace Blog;

use Blog\Controller\AuthController;
use Blog\Controller\BlogController;
use Blog\Exception\ExceptionHandler;
use Blog\Router\Router;
use Psr\Container\ContainerInterface;

/**
 * Just a factory for container only for Blog application
 *
 */
class ApplicationContainerFactory
{
    public function init(): ContainerInterface
    {
        $container = new Container();
        $routerFactory = new ApplicationRouterFactory();

        // create services on each request (by instance)
        $container->addInstance(Application::DEP_EXCEPTION_HANDLER, new ExceptionHandler());
        $container->addInstance(Application::DEP_ROUTER, $routerFactory->init($container));

        // create services 'on fly'
        $container->addClosure(BlogController::class, function () {
            return new BlogController();
        });

        $container->addClosure(AuthController::class, function () {
            return new AuthController();
        });

        return $container;
    }
}
