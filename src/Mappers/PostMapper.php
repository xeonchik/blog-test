<?php
declare(strict_types=1);

namespace Blog\Mappers;

use Blog\Entity\Post;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class PostMapper implements MapperInterface
{
    public const TABLE_NAME = 'posts';

    protected Connection $db;

    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * Get single post by ID
     *
     * @param int $id
     *
     * @return Post|null
     * @throws Exception
     */
    public function get(int $id): ?Post
    {
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')
            ->from(self::TABLE_NAME)
            ->where('id = ?')
            ->setParameter(0, $id);

        $result = $qb->executeQuery()->fetchAssociative();

        if (!$result) {
            return null;
        }

        return $this->hydrate($result);
    }

    /**
     * Get all posts
     *
     * @return Post[]
     * @throws Exception
     */
    public function getPosts(): array
    {
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')
            ->from(self::TABLE_NAME)
            ->orderBy('published', 'desc');

        $results = $qb->executeQuery()->fetchAllAssociative();

        $dataSet = [];

        foreach ($results as $row) {
            $dataSet[] = $this->hydrate($row);
        }

        return $dataSet;
    }

    public function hydrate(array $row): Post
    {
        $obj = new Post();
        $obj->id = (int)($row['id'] ?? null);
        $obj->authorId = (int)($row['author_id'] ?? null);
        $obj->title = $row['title'] ?? null;
        $obj->text = $row['text'] ?? null;
        $obj->published = isset($row['published']) ? new \DateTime($row['published']) : null;

        return $obj;
    }

    /**
     * @param Post $entity
     *
     * @return array
     */
    public function toArray($entity): array
    {
        if (!$entity instanceof Post) {
            throw new \Exception('PostMapper allowed only for transforming Enitiy\\Post');
        }

        $row = [];
        $row['id'] = $entity->id;
        $row['title'] = $entity->title;
        $row['published'] = $entity->published->format('c');
        $row['text'] = $entity->text;
        $row['author_id'] = $entity->authorId;
        return $row;
    }
}
