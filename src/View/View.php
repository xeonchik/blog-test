<?php
declare(strict_types=1);

namespace Blog\View;

use Laminas\Diactoros\Response\HtmlResponse;

class View
{
    protected static string $viewsDirectory = __DIR__ . '/../../view';

    protected ?string $layout = null;

    protected string $template = '';

    public function __construct(?string $layout = 'layout')
    {
        $this->layout = $layout;
    }

    public function render(?string $template = null, array $vars = []): HtmlResponse
    {
        if ($template === null) {
            $template = $this->template;
        }

        // Important thing: I expect that both $template and $viewsDirectory are strictly set only in the code
        // I'm not checking including of the files outside viewsDirectory
        // That means - Never set template or viewDirectory dynamically. Or check them by your own
        $templatePath = self::$viewsDirectory . DIRECTORY_SEPARATOR . $template . '.php';

        if (!file_exists($templatePath)) {
            throw new \Exception('Template ' . $template . ' not found');
        }

        ob_start();
        extract($vars, EXTR_SKIP);
        include $templatePath;
        $rendered = ob_get_clean();

        if ($this->layout !== null) {
            return $this->renderLayout($rendered);
        }
        return new HtmlResponse($rendered);
    }

    /**
     * @throws \Exception
     */
    public function renderLayout(string $html): HtmlResponse
    {
        $layout = new View(null);
        return $layout->render('layout', [
            'content' => $html
        ]);
    }
}
