<?php

namespace Its\Lib\Store;

class UserStore implements KeyValueStorable
{
    private static $userData = [];

    public static function getStoreData(string $name)
    {
        if(!array_key_exists($name, static::$userData)) {
            return null;
        }

        return static::$userData[$name];
    }

    public static function setStoreData(string $name, $data = null): void
    {
        static::$userData[$name] = $data;
    }
}
