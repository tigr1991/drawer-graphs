<?php

namespace DrawerGraphs\Command\Driver;

/**
 * Interface IDriver
 * Интерфейс создания скриптов из Command
 */
interface IDriver
{
    /**
     * @param \DrawerGraphs\Command\Command $command
     */
    public function createScript(\DrawerGraphs\Command\Command $command);

}