<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 */

namespace DrawerGraphs\Command\Registry;

class NodeFields implements IRegistry
{
    const SHAPE = 100;
    const STYLE = 200;

    /**
     * @return string[]
     */
    public static function getNames()
    {
        return [
            static::SHAPE => 'форма',
            static::STYLE => 'стиль',
        ];
    }


    /**
     * @return string[]
     */
    public static function getValues()
    {
        return [
            static::SHAPE => '',
            static::STYLE => '',
        ];
    }

    /**
     * @param int $id
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


