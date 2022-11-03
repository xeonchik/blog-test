<?php
declare(strict_types=1);

namespace Blog;

use Blog\Exception\ExceptionHandler;
use Blog\Exception\ExceptionHandlerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{
    public const DEP_ROUTER = 'router';
    public const DEP_EXCEPTION_HANDLER = 'exceptionHandler';

    protected ExceptionHandlerInterface $exceptionHandler;

    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->exceptionHandler = $container->get(self::DEP_EXCEPTION_HANDLER);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $router = $this->container->get(self::DEP_ROUTER);
            return $router->dispatch($request);
        } catch (\Throwable $exception) {
            return $this->handleException($exception);
        }
    }

    public function handleException(\Throwable $exception): ResponseInterface
    {
        return $this->exceptionHandler->handleException($exception);
    }
}
