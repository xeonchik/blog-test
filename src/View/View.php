<?php
declare(strict_types=1);

namespace Blog\View;

class View
{
    protected static string $viewsDirectory = __DIR__ . '/../../view';

    protected ?string $defaultLayout = 'layout';

    protected string $template = '';

    protected array $vars = [];

    /**
     * @param string $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function __get($name)
    {
        return $this->vars[$name] ?? null;
    }

    /**
     * @throws \Exception
     */
    public function render(?string $template = null, array $vars = []): string
    {
        if ($template === null) {
            $template = $this->template;
        }

        // Important thing: I expect that both $template and $viewsDirectory are strictly set only in the code
        // I'm not checking inclusion of the files outside viewsDirectory
        // That means - Never set template or viewDirectory dynamically. Or check them by your own
        $templatePath = self::$viewsDirectory . DIRECTORY_SEPARATOR . $template . '.php';

        if (!file_exists($templatePath)) {
            throw new \Exception('Template ' . $template . ' not found');
        }

        ob_start();
        extract($vars, EXTR_SKIP);
        include $templatePath;
        $rendered = ob_get_clean();

        return $rendered;
    }

    /**
     * @throws \Exception
     */
    public function renderLayout(string $layoutName = null, string $html = ''): string
    {
        if ($layoutName === null) {
            $layoutName = $this->defaultLayout;
        }

        $layout = new View();
        return $layout->render($layoutName, [
            'content' => $html
        ]);
    }
}
