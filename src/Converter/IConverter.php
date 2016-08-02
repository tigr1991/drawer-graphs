<?php

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 07.12.2015
 * Time: 9:20
 */
namespace DrawerGraphs\Converter;

/**
 * Interface IConverter
 * Интерфейс конвертера
 */
interface IConverter
{
    /**
     * @param \DrawerGraphs\Command\Command $command
     * @param \Fhaculty\Graph\Graph $graph
     * @return void
     */
    public function convert(\DrawerGraphs\Command\Command $command, \Fhaculty\Graph\Graph $graph);
}