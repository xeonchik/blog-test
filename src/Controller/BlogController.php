<?php
declare(strict_types=1);

namespace Blog\Controller;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BlogController extends AbstractController
{
    public function index(RequestInterface $request): ResponseInterface
    {
        return new HtmlResponse('test test');
    }
}
