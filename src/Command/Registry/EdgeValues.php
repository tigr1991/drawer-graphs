<?php

namespace DrawerGraphs\Command\Registry;

/**
 * Class EdgeValues
 * Значения атрибутов ребра
 */
class EdgeValues implements IRegistry
{

    const STYLE_DEFAULT = 201;
    const STYLE_SOLID = 202;
    const STYLE_DASHED = 203;
    const STYLE_DOTTED = 204;
    const STYLE_INVIS = 205;
    const STYLE_BOLD = 206;
    const STYLE_FILLED = 207;

    /**
     * @return string[]
     */
    public static function getNames()
    {
        return [
            static::STYLE_DEFAULT => 'по умолчанию',
            static::STYLE_SOLID => 'сплошной',
            static::STYLE_DASHED => 'пунктирный',
            static::STYLE_DOTTED => 'точечный',
            static::STYLE_INVIS => 'невидимый',
            static::STYLE_BOLD => 'жирный',
            static::STYLE_FILLED => 'залитый',
        ];
    }

    /**
     * @return string[]
     */
    public static function getValuesForDot()
    {
        return [
            static::STYLE_DEFAULT => '',
            static::STYLE_SOLID => 'solid',
            static::STYLE_DASHED => 'dashed',
            static::STYLE_DOTTED => 'dotted',
            static::STYLE_INVIS => 'invis',
            static::STYLE_BOLD => 'bold',
            static::STYLE_FILLED => 'filled',
        ];
    }

    /**
     * @param int $id
     * @return string
     * @throws \DrawerGraphs\Exception
     */
    public static function getValueForDot($id)
    {
        assert(is_int($id));
        if (!isset(static::getValuesForDot()[$id])) {
            throw new \DrawerGraphs\Exception("Нет значения с id = $id");
        }
        return static::getValuesForDot()[$id];
    }


}


