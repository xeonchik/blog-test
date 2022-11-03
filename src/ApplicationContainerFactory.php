<?php
declare(strict_types=1);

namespace Blog;

use Blog\Authentication\Authenticator;
use Blog\Controller\AuthController;
use Blog\Controller\BlogController;
use Blog\Exception\ExceptionHandler;
use Blog\Mappers\PostMapper;
use Blog\Mappers\UserMapper;
use Doctrine\DBAL\DriverManager;
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
        $container->addInstance(Authenticator::class, new Authenticator());

        // @todo: we could implement config access here
        $container->addInstance('db', DriverManager::getConnection(['url' => 'mysql://blog:blog@localhost/blog']));

        // create services 'on fly'
        $container->addClosure(PostMapper::class, function () use ($container) {
            return new PostMapper($container->get('db'));
        });
        $container->addClosure(UserMapper::class, function () use ($container) {
            return new UserMapper($container->get('db'));
        });

        $container->addClosure(BlogController::class, function () use ($container) {
            return new BlogController($container->get(PostMapper::class));
        });

        $container->addClosure(AuthController::class, function () use ($container) {
            return new AuthController(
                $container->get(UserMapper::class),
                $container->get(Authenticator::class),
            );
        });

        return $container;
    }
}
