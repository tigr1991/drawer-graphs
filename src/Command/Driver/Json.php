<?php

namespace DrawerGraphs\Command\Driver;

/**
 * Class Json
 * Представить граф в виде JSON
 */
class Json implements IDriver
{

    /**
     * @return static
     */
    public static function create()
    {
        $obj = new static();
        return $obj;
    }

    /**
     * Dot constructor.
     */
    protected function __construct()
    {

    }

    /**
     * @param \DrawerGraphs\Command\Command $command
     * @throws \DrawerGraphs\Exception
     */
    public function createScript(\DrawerGraphs\Command\Command $command)
    {
        throw new \DrawerGraphs\Exception("Данный метод ещё не реализован");
    }
}