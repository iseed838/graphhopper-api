<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 23.12.19
 * Time: 12:22
 */

namespace Graphhopper;


use Graphhopper\Traits\ConfigurableTrait;

/**
 * Dependency Injection pattern
 * Class Di
 * @package Graphhopper
 */
class Di
{
    private static $instances   = [];
    private static $definitions = [];

    /**
     * Get instanse
     * @param string $key
     * @param array|null $params
     * @return ConfigurableTrait|mixed|null|object
     * @throws \ReflectionException
     */
    public static function get(string $key, $params = null)
    {
        if (isset(self::$instances[$key])) {
            return self::$instances[$key];
        }
        if (!class_exists($key) && !interface_exists($key)) {
            return null;
        }

        return self::build($key, $params);
    }

    /**
     * Set instanse
     * @param string $key
     * @param $value
     * @return mixed
     */
    public static function set(string $key, $value)
    {
        return self::$instances[$key] = $value;
    }

    /**
     * Build instance with definition
     * @param string $classname
     * @param array $params
     * @return object|ConfigurableTrait
     * @throws \ReflectionException
     */
    private static function build(string $classname, $params = null): object
    {
        $reflection = new \ReflectionClass($classname);
        if (!$reflection->isInstantiable()) {
            throw new \ReflectionException("Class {$classname} is not instantiable");
        }
        if (!is_null($params) || is_array($params)) {
            $instance = $reflection->newInstance($params);
        } else {
            $instance = $reflection->newInstance();
        }
        if (isset(self::$definitions[$classname])) {
            self::addDefinition($instance, $reflection);
        }

        return $instance;
    }

    /**
     * Add definitions
     * @param object $object
     * @param \ReflectionClass $reflection
     */
    private static function addDefinition(object $object, \ReflectionClass $reflection)
    {
        $definitions = self::$definitions[$reflection->getName()];
        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();
            if (!isset($definitions[$propertyName])) {
                continue;
            }
            $value = $definitions[$propertyName];
            $property->setAccessible(true);
            $property->setValue($object, $value);
            $property->setAccessible(false);
        }
    }

    /**
     * Set definition
     * @param string $key
     * @param array $definition
     */
    public static function setDefinition(string $key, array $definition)
    {
        self::$definitions[$key] = $definition;
    }
}