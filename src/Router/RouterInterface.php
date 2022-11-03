<?php
declare(strict_types=1);

namespace Blog\Router;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function dispatch(ServerRequestInterface $request): ResponseInterface;
}
