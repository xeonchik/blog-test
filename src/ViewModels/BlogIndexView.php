<?php
declare(strict_types=1);

namespace Blog\ViewModels;

use Blog\View\View;

class BlogIndexView extends View
{
    protected string $template = 'blog_index';

    public array $articles = [];
}
