<?php


namespace DrawerGraphs\Process;

/**
 * Interface IProcess
 * Для создания процесса и для его отслеживания
 */
interface IProcess
{
    /**
     * @return bool
     */
    public function isCompleted();

    /**
     * @return int
     */
    public function getPid();
}