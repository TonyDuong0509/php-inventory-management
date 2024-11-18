<?php

namespace Container;

use ReflectionClass;

class ServiceContainer
{
    protected $instances = [];

    public function add($name, $instance)
    {
        $this->instances[$name] = $instance;
    }

    public function resolve($className)
    {
        if (isset($this->instances[$className])) {
            return $this->instances[$className];
        }
        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $className;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencyClass = $parameter->getType()->getName();
            $dependencies[] = $this->resolve($dependencyClass);
        }

        $instance = $reflectionClass->newInstanceArgs($dependencies);
        $this->add($className, $instance);
        return $instance;
    }
}
