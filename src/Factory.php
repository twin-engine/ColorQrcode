<?php

namespace rotoos\colorQrcode;

use rotoos\colorQrcode\Exception\InvalidException;

class Factory
{
    protected static $providers;

    /**
     * 直接通过方法名得到真实的实例
     * 然后实例化这个真实的实例
     * @param $method
     * @param $parameters
     * @return mixed
     * @throws InvalidException
     */
    public static function __callStatic($method, $parameters)
    {
        $instance = static::getInstance($method);

        return new $instance(...$parameters);
    }

    /**
     * 通过工厂方法获取可能存在的实例
     * 目前只有两种实例
     * 1. color
     * 2. image
     * @param $abstract
     * @return string
     * @throws InvalidException
     */
    protected static function getInstance($abstract): string
    {
        if (!static::hasInstance($abstract)) {
            throw new InvalidException('NOT TYPE FACTORY');
        }

        $providers = static::getProviders();

        return $providers[$abstract];
    }

    /**
     * 在预定义的实例中是否存在当前 key
     * @param $abstract
     * @return bool
     */
    protected static function hasInstance($abstract): bool
    {
        return array_key_exists($abstract, static::getProviders());
    }

    /**
     * 获取预定义的实例
     * @return array
     */
    protected static function getProviders(): array
    {
        if (is_null(static::$providers)) {
            static::$providers = require __DIR__ . '/Providers.php';
        }

        return static::$providers;
    }
}
