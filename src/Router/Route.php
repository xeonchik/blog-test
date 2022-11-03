<?php
declare(strict_types=1);

namespace Blog\Router;

use Psr\Http\Message\ServerRequestInterface;

class Route
{
    public string $method;

    public string $path;

    public \Closure $handler;

    public function __construct(string $method, string $path, \Closure $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    public function match(ServerRequestInterface $request): bool
    {
        if ($request->getUri()->getPath() !== $this->path) {
            return false;
        }

        if ($this->method !== Router::ANY && $this->method !== $request->getMethod()) {
            return false;
        }

        return true;
    }

    public function getHandler(): \Closure
    {
        return $this->handler;
    }
}
