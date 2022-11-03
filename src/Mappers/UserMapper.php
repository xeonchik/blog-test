<?php
declare(strict_types=1);

namespace Blog\Mappers;

use Blog\Entity\User;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class UserMapper implements MapperInterface
{
    public const TABLE_NAME = 'users';

    protected Connection $db;

    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * Get user by ID
     *
     * @param int $id
     *
     * @return User|null
     * @throws Exception
     */
    public function get(int $id): ?User
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

    public function getByLogin(string $login): ?User
    {
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')
            ->from(self::TABLE_NAME)
            ->where('login = ?')
            ->setParameter(0, $login);

        $result = $qb->executeQuery()->fetchAssociative();

        if (!$result) {
            return null;
        }

        return $this->hydrate($result);
    }

    public function hydrate(array $row): User
    {
        $obj = new User();
        $obj->setId((int)($row['id'] ?? null));
        $obj->setName($row['name'] ?? null);
        $obj->setLogin($row['login'] ?? null);
        $obj->setPassword($row['password'] ?? null);
        $obj->setSalt($row['salt'] ?? null);

        return $obj;
    }

    public function toArray($entity): array
    {
        return [];
    }
}
