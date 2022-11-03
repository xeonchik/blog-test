<?php
declare(strict_types=1);

namespace Blog\Entity;

class Comment
{
    public int $id;

    public string $text;

    public \DateTime $created_at;

    public bool $published;
}
