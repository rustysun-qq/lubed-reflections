<?php
namespace Lubed\Reflections;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

interface ReflectionFactory {
    public function getClass(string $class) : ?ReflectionClass;

    public function getMethod(string $class, string $method) : ?ReflectionMethod;

    public function getProperty(string $class, string $property) : ?ReflectionProperty;

    public function getClassAncestors(string $class) : array;

    public function getClassAncestorsAndInterfaces(string $class) : array;
}
