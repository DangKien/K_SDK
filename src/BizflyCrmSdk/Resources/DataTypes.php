<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

namespace BizflyCrmSdk\Resources;

class DataTypes
{
    const STRING_OBJECT = 'string-object';
    const INTEGER = 'integer';
    const DATE = 'date';
    const OBJECT = 'object';
    const ARRAY_OBJECT = 'array-object';
    const DOUBLE = 'double';
    const STRING = 'string';

    /**
     * Get all Constants form this class
     * @return array
     * @throws \ReflectionException
     */

    public static function getAllConstants() {
        return [
            'string-object', 'integer', 'date', 'object', 'array-object', 'double', 'string'
        ];
        try {
            $reflectionClass = new \ReflectionClass(self::class);
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $exc) {
            return [];
        }

    }


}