<?php
declare(strict_types=1);

namespace Blog;

use Blog\Exception\ExceptionHandler;
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


        $container->add(Application::DEP_EXCEPTION_HANDLER, new ExceptionHandler());
        $container->add(Application::DEP_ROUTER, new Router());

        return $container;
    }
}
