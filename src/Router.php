<?php
declare(strict_types=1);

namespace Blog;

use Blog\Controller\BlogController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        $controller = new BlogController();
        return $controller->index($request);
    }
}
