<?php
declare(strict_types=1);

namespace Blog\Exception;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function handleException(\Throwable $exception): \Psr\Http\Message\ResponseInterface
    {
        $html = '<h1>Error occurred!</h1> <p>Error: ' . $exception->getMessage() . '</p>';
        $code = 500;

        $html .= '<pre>' . $exception->getTraceAsString() . '</pre>';

        return new \Laminas\Diactoros\Response\HtmlResponse($html, $code);
    }
}
