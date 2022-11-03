<?php
declare(strict_types=1);

namespace Blog\Authentication;

interface UserInterface
{
    public function getUsername(): string;

    public function getPassword(): string;

    public function getSalt();

    public function eraseCredentials();
}
