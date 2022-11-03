<?php
declare(strict_types=1);

namespace Blog\Entity;

class Post
{
    public int $id;

    public string $title;

    public string $text;

    public \DateTime $published;

    public int $authorId;
}
