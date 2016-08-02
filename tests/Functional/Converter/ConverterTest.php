<?php

namespace  DrawerGraphsTests\Functional\Converter;

use Fhaculty\Graph\Edge\Directed;
use Fhaculty\Graph\Vertex;

/**
 * Class ConverterTest
 */
class ConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testLaunch()
    {
        \DrawerGraphs\Converter\Base::create();
    }

    /**
     * Примитивное тестирование конвертера
     */
    public function testConvert()
    {
        $graph = new \Fhaculty\Graph\Graph;

        $vertex_1 = new Vertex($graph, '1');
        $vertex_2 = new Vertex($graph, '2');
        $vertex_3 = new Vertex($graph, '3');

        new Directed($vertex_1, $vertex_2);
        new Directed($vertex_2, $vertex_3);


        /** @var \DrawerGraphs\Command\Driver\IDriver $driver */
        $driver = $this->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->getMock();

        $command = \DrawerGraphs\Command\Command::create($driver);
        $converter = \DrawerGraphs\Converter\Base::create();
        $converter->convert($command, $graph);
        $this->assertEquals(count($graph->getVertices()), count($command->getNodes()));
        $this->assertEquals(count($graph->getEdges()), count($command->getEdges()));
    }

}
