<?php

namespace app\core;


use ReflectionClass;

abstract class enum
{
    /**
     * The value of one of the enum members.
     *
     * @var mixed
     */
    public $value;
    /**
     * The value of one of the enum members.
     *
     * @var mixed
     */
    public $key;

    /**
     * Constants cache.
     *
     * @var array
     */
    protected static $constCacheArray = [];

    /**
     * @param mixed $enumValue
     * @return void
     * @throws \Exception
     */

    public function __construct($enumValue)
    {
        if (! static::hasValue($enumValue)) {
            throw new \Exception('Undefined  enum value');
        }

      $this->value = $enumValue;
      $this->key = static::getKey($enumValue);

    }

    public static function getConstants(): array
    {
        $calledClass = get_called_class();

        if (! array_key_exists($calledClass, static::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            static::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return static::$constCacheArray[$calledClass];
    }

    public static function getKeys(): array
    {
        return array_keys(static::getConstants());
    }
    public static function getValues(): array
    {
        return array_values(static::getConstants());
    }

    /**
     * Get the key for a single enum value.
     *
     * @param  mixed  $key
     * @return string
     */
    public static function getValue($key): string
    {
        return static::getConstants()[$key];
    }

    /**
     * Get the key for a single enum value.
     *
     * @param  mixed  $value
     * @return string
     */
    public static function getKey($value): string
    {
        return array_search($value, static::getConstants(), true);
    }


    /**
     * check that the enum contains a specific value
     * @param mixed $value
     * @return bool
     */

    public static function hasValue($value): bool
    {
        $validValues = static::getValues();
        return in_array($value, $validValues, true);
    }

}