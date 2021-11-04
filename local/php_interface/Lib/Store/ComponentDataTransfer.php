<?php

namespace Its\Lib\Store;

class ComponentDataTransfer implements KeyValueStorable
{
    private static $componentData = [];

    public static function getStoreData(string $name): ?array
    {
        if(!array_key_exists($name, static::$componentData)) {
            return null;
        }

        return static::$componentData[$name];
    }

    public static function setStoreData(string $name, $data = null): void
    {
        static::$componentData[$name] = $data;
    }
}
