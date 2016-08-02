<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 */

namespace DrawerGraphs\Command\Registry;

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
     * @param $id
     * @return string
     */
    public static function getValue($id)
    {
        assert(is_int($id));
        if (!isset(static::getValues()[$id])) {
            throw new \SemanticLogic\Exception("Нет поля с id = $id");
        }
        return static::getValues()[$id];
    }

}


