<?php
declare(strict_types=1);

namespace Blog\Authentication;

class Authenticator
{
    public function authenticate(UserInterface $user, string $password): bool
    {
        return password_verify($password, $user->getSalt());
    }
}
