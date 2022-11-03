<?php
declare(strict_types=1);

namespace Blog\Controller;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AbstractController
{
    public function login(ServerRequestInterface $request): ResponseInterface
    {


        return new HtmlResponse('login');
    }
}
