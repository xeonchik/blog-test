<?php
declare(strict_types=1);

namespace Blog\Controller;

use Blog\Mappers\PostMapper;
use Blog\ViewModels\BlogIndexView;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BlogController extends AbstractController
{
    protected PostMapper $postMapper;

    public function __construct(PostMapper $postMapper)
    {
        $this->postMapper = $postMapper;
    }

    public function index(RequestInterface $request): ResponseInterface
    {
        $posts = $this->postMapper->getPosts();

        $view = new BlogIndexView();
        $view->articles = [];

        return $view->render();
    }
}
