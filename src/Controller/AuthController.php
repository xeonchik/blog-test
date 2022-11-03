<?php
declare(strict_types=1);

namespace Blog\Controller;

use Blog\Authentication\Authenticator;
use Blog\Mappers\UserMapper;
use Blog\View\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AbstractController
{
    private UserMapper $userMapper;
    private Authenticator $authenticator;

    public function __construct(UserMapper $userMapper, Authenticator $authenticator)
    {
        $this->userMapper = $userMapper;
        $this->authenticator = $authenticator;
    }

    public function loginForm(ServerRequestInterface $request): ResponseInterface
    {
        $view = new View();
        $view->setTemplate('login/login');

        return $this->renderWithLayout($view);
    }

    public function login(ServerRequestInterface $request): ResponseInterface
    {
        // No getPost(name, def) in this request object...
        $params = $request->getParsedBody();

        $login = $params['login'] ?? null;
        $password = $params['password'] ?? null;

        if (!$login || !$password) {
            return $this->errorResponse('No login or password provided', 400);
        }

        $user = $this->userMapper->getByLogin($login);

        $view = new View();

        if (!$user || !$this->authenticator->authenticate($user, $password)) {
            $view->error = 'Invalid username or password';
        }

        $view->setTemplate('login/login');
        return $this->renderWithLayout($view);
    }
}
