<?php
declare(strict_types=1);

namespace Blog\Mappers;

interface MapperInterface
{
    public function hydrate(array $row);

    public function toArray($entity): array;
}
