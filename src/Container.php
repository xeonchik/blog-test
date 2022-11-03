<?php
declare(strict_types=1);

namespace Blog;

class Container implements \Psr\Container\ContainerInterface
{
    protected array $services;

    /**
     * Add service to DI container (by instance)
     *
     * @param string $serviceId
     * @param        $instance
     *
     * @return void
     */
    public function add(string $serviceId, $instance)
    {
        $this->services[$serviceId] = $instance;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new \Exception('There is no service ' . $id . ' inside container');
        }

        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}
