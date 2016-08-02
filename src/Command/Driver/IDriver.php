<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.12.2015
 * Time: 8:30
 */

namespace DrawerGraphs\Command\Driver;

interface IDriver
{
    /**
     * @param \DrawerGraphs\Command\Command $command
     */
    public function createScript(\DrawerGraphs\Command\Command $command);

}