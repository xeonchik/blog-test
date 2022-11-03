<?php
declare(strict_types=1);

namespace Blog\Exception;

use Laminas\Diactoros\Response\HtmlResponse;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function handleException(\Throwable $exception): \Psr\Http\Message\ResponseInterface
    {
        /**
         * We can add error logging for example, or add multiple error handlers (like middlewares)
         */

        $html = '<h1>Error occurred!</h1> <p>Error: ' . $exception->getMessage() . '</p>';
        $code = 500;

        $html .= '<pre>' . $exception->getTraceAsString() . '</pre>';

        return new HtmlResponse($html, $code);
    }
}
