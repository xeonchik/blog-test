<?php
declare(strict_types=1);

namespace Blog\Controller;

use Blog\View\View;
use Laminas\Diactoros\Response\HtmlResponse;

class AbstractController
{
    protected function errorResponse(string $errorText, int $code): HtmlResponse
    {
        $view = new View();
        $html = $view->renderLayout(null, '<h2>Error</h2>' . '<p>'. $errorText .'</p>');
        return new HtmlResponse($html, $code);
    }

    protected function renderWithLayout(View $view): HtmlResponse
    {
        $rendered = $view->render();
        return new HtmlResponse($view->renderLayout(null, $rendered));
    }
}
