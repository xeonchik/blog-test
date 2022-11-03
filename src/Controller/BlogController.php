<?php
declare(strict_types=1);

namespace Blog\Controller;

use Blog\ViewModels\BlogIndexView;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BlogController extends AbstractController
{
    public function index(RequestInterface $request): ResponseInterface
    {
        $view = new BlogIndexView();
        $view->articles = [];

        return $view->render();
    }
}
