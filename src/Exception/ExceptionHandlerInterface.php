<?php
declare(strict_types=1);

namespace Blog\Exception;

interface ExceptionHandlerInterface
{
    public function handleException(\Throwable $exception): \Psr\Http\Message\ResponseInterface;
}
