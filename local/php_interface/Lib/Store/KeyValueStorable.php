<?php

namespace Its\Lib\Store;

interface KeyValueStorable
{
    public static function getStoreData(string $key);

    public static function setStoreData(string $key, $value): void;
}