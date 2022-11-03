<?php
declare(strict_types=1);

namespace Blog;

class Container implements \Psr\Container\ContainerInterface
{
    protected array $services;
    protected array $closures;

    /**
     * Add service to DI container (by instance)
     *
     * @param string $serviceId
     * @param        $instance
     *
     * @return void
     */
    public function addInstance(string $serviceId, $instance)
    {
        $this->services[$serviceId] = $instance;
    }

    /**
     * Add service factory (via closure)
     *
     * @param string $serviceId
     * @param \Closure $closure
     *
     * @return void
     */
    public function addClosure(string $serviceId, \Closure $closure)
    {
        $this->closures[$serviceId] = $closure;
    }

    /**
     * @throws \Exception
     */
    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new \Exception('There is no service ' . $id . ' inside container');
        }

        if (isset($this->services[$id])) {
            return $this->services[$id];
        } else if (isset($this->closures[$id])) {
            $closure = $this->closures[$id];
            return $closure();
        }

        return null;
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]) || isset($this->closures[$id]);
    }
}
