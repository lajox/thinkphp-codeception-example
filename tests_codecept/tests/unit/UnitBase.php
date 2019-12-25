<?php
# 文件 tests/unit/UnitBase.php
class UnitBase extends Codeception\Test\Unit
{
    /**
     * debug
     */
    protected function debugSection($title, $message)
    {
        if (is_object($message)) {
            try {
                $message = var_export($message, true);
            } catch (\Exception $exception) {
                $message = print_r($message, true);
            }
        } else if(is_array($message)) {
            $message = stripslashes(json_encode($message));
        } else if(is_bool($message) || is_null($message)) {
            $message = json_encode($message);
        }
        \codecept_debug("[$title] $message");
    }

    /**
     * 调用类的私有方法
     * @param object $object
     * @param string $className
     * @param string $methodName
     * @param array  $params
     * @return mixed
     */
    protected function callPrivateMethod($object, string $className, string $methodName, array $params)
    {
        $method = $this->getPrivateMethod($className, $methodName);
        return $method->invokeArgs($object, $params);
    }

    /**
     * 获取对象的私有属性
     * @param object $object
     * @param string $className
     * @param string $propertyName
     * @return mixed
     */
    protected function getPrivatePropertyValue($object, string $className, string $propertyName)
    {
        $property = $this->getPrivateProperty($className, $propertyName);
        return $property->getValue($object);
    }

    /**
     * getPrivateProperty
     *
     * @param string $className
     * @param string $propertyName
     * @return    ReflectionProperty
     * @author    Joe Sexton <joe@webtipblog.com>
     */
    protected function getPrivateProperty(string $className, string $propertyName): \ReflectionProperty
    {
        $reflector = new ReflectionClass($className);
        $property  = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * getPrivateMethod
     *
     * @param string $className
     * @param string $methodName
     * @return    ReflectionMethod
     * @author    Joe Sexton <joe@webtipblog.com>
     */
    protected function getPrivateMethod(string $className, string $methodName): \ReflectionMethod
    {
        $reflector = new ReflectionClass($className);
        $method    = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }
}