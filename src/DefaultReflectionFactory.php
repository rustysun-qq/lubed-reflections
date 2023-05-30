<?php
namespace Lubed\Reflections;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

class DefaultReflectionFactory implements ReflectionFactory {
    private $reflection_classes=[];
    private $reflection_methods=[];
    private $reflection_properties=[];

    public function getClass(string $class) : ?ReflectionClass {
        if (isset($this->reflection_classes[$class])) {
            return $this->reflection_classes[$class];
        }

        $this->reflection_classes[$class]=new ReflectionClass($class);
        return $this->reflection_classes[$class];
    }

    public function getMethod(string $class, string $method) : ?ReflectionMethod {
        if (isset($this->reflection_methods[$class][$method])) {
            return $this->reflection_methods[$class][$method];
        }

        if (!isset($this->reflection_methods[$class])) {
            $this->reflection_methods[$class]=[];
        }

        $this->reflection_methods[$class][$method]=new ReflectionMethod($class, $method);
        return $this->reflection_methods[$class][$method];
    }

    public function getProperty(string $class, string $property) : ?ReflectionProperty {
        if (isset($this->reflection_properties[$class][$property])) {
            return $this->reflection_properties[$class][$property];
        }

        if (!isset($this->reflection_properties[$class])) {
            $this->reflection_properties[$class]=[];
        }

        $this->reflection_properties[$class][$property]=new ReflectionProperty($class, $property);
        return $this->reflection_properties[$class][$property];
    }

    public function getClassAncestors(string $class) : array {
        $ret=[];
        $rClass=$this->getClass($class);

        while ($rClass=$rClass->getParentClass()) {
            $ret[]=$rClass->getName();
        }

        return $ret;
    }

    public function getClassAncestorsAndInterfaces(string $class) : array {
        $ret=$this->getClassAncestors($class);
        $ret=array_merge($ret, $this->getClass($class)->getInterfaceNames());
        return $ret;
    }

}
