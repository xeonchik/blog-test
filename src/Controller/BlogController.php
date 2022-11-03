<?php
declare(strict_types=1);

namespace Blog\Controller;

use Blog\Mappers\PostMapper;
use Blog\ViewModels\BlogIndexView;
use Blog\ViewModels\DetailedView;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogController extends AbstractController
{
    protected PostMapper $postMapper;

    public function __construct(PostMapper $postMapper)
    {
        $this->postMapper = $postMapper;
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $posts = $this->postMapper->getPosts();

        $view = new BlogIndexView();
        $view->posts = $posts;

        return $this->renderWithLayout($view);
    }

    public function view(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getQueryParams()['id'] ?? null;

        if ($id === null) {
            return $this->errorResponse('Wrong parameter id', 400);
        }

        $post = $this->postMapper->get((int)$id);

        if ($post === null) {
            return $this->errorResponse('Article not found', 404);
        }

        $view = new DetailedView();
        $view->post = $post;

        return $this->renderWithLayout($view);
    }
}
