<?php
declare(strict_types=1);

namespace Blog\ViewModels;

use Blog\Entity\Comment;
use Blog\Entity\Post;
use Blog\View\View;

class DetailedView extends View
{
    protected string $template = 'blog_detailed';

    public Post $post;

    /**
     * @var Comment[]
     */
    public array $comments;
}
