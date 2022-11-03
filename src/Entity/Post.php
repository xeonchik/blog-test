<?php
declare(strict_types=1);

namespace Blog\Entity;

class Post
{
    private const CUT_LENGTH = 500;

    public int $id;

    public string $title;

    public string $text;

    public \DateTime $published;

    public int $authorId;

    public User $author;

    public function getAnnounce(): string
    {
        if (strlen($this->text) > self::CUT_LENGTH) {
            return substr($this->text, 0, self::CUT_LENGTH) . '...';
        }

        return $this->text;
    }

    public function getAuthor(): ?User
    {
        $user = new User();
        $user->name = 'FixMe';
        return $user;
    }

    public function getComments(): array
    {
        return [];
    }
}
