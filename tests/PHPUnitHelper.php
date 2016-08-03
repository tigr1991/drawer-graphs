<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 02.08.2016
 * Time: 12:17
 */

namespace DrawerGraphsTests;

/**
 * Class PHPUnitHelper
 * Небольшой помошник для тестирования
 */
class PHPUnitHelper
{
    /**
     * @param object $object
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public static function callProtectedMethod($object, $method, array $params)
    {
        assert(is_object($object));
        assert(is_string($method));
        $reflection = new \ReflectionClass($object);
        $reflection_method = $reflection->getMethod($method);
        $reflection_method->setAccessible(true);
        //$reflection_method->
        return $reflection_method->invokeArgs($object, $params);
    }

    /**
     * @param $object
     * @param $name
     * @return mixed
     */
    public static function getProtectedProperty($object, $name)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($name);
        $reflection_property->setAccessible(true);
        return $reflection_property->getValue($object);
    }

    /**
     * @param $object
     * @param $name
     * @param $value
     */
    public static function setProtectedProperty($object, $name, $value)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($name);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }
}