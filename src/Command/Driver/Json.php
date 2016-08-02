<?php

namespace DrawerGraphs\Command\Driver;

/**
 * Class Json
 * Представить граф в виде JSON
 */
class Json implements IDriver
{
    /**
     * @param \DrawerGraphs\Command\Command $command
     * @throws \DrawerGraphs\Exception
     */
    public function createScript(\DrawerGraphs\Command\Command $command)
    {
        throw new \DrawerGraphs\Exception("Данный метод ещё не реализован");
    }
}