<?php

namespace DrawerGraphs\Command\Registry;

/**
 * Class EdgeFields
 * Атрибуты ребра для отрисовки
 */
class EdgeFields implements IRegistry
{
    const STYLE = 200;

    /**
     * @return string[]
     */
    public static function getNames()
    {
        return [
            static::STYLE => 'стиль',
        ];
    }

    /**
     * @return string[]
     */
    public static function getValues()
    {
        return [
            static::STYLE => '',
        ];
    }

    /**
     * @param int $id
     * @return string
     * @throws \DrawerGraphs\Exception
     */
    public static function getValue($id)
    {
        assert(is_int($id));
        if (!isset(static::getValues()[$id])) {
            throw new \DrawerGraphs\Exception("Нет поля с id = $id");
        }
        return static::getValues()[$id];
    }

}


