<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.08.2016
 * Time: 17:12
 */

namespace DrawerGraphsTests\Unit\Driver;


/**
 * Class DotTest
 */
class DotTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateScriptWithoutGroups()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject | \DrawerGraphs\Command\Driver\Dot $dot_driver */
        $dot_driver = $this->getMockBuilder(\DrawerGraphs\Command\Driver\Dot::class)
            ->disableOriginalConstructor()
            ->setMethods(['createNodeScript', 'createEdgeScript'])
            ->getMock();

        $command = $this->getMockBuilder(\DrawerGraphs\Command\Command::class)
            ->disableOriginalConstructor()
            ->setMethods(['getNodes', 'getEdges'])
            ->getMock();

        $command
            ->expects($this->at(0))
            ->method('getNodes')
            ->willReturn($this->getNodes());

        $command
            ->expects($this->at(1))
            ->method('getEdges')
            ->willReturn($this->getEdges());

        $dot_driver->expects($this->at(0))
            ->method('createNodeScript')
            ->willReturn('node_1');
        $dot_driver->expects($this->at(1))
            ->method('createNodeScript')
            ->willReturn('node_2');
        $dot_driver->expects($this->at(2))
            ->method('createNodeScript')
            ->willReturn('node_3');

        $dot_driver->expects($this->at(3))
            ->method('createEdgeScript')
            ->willReturn('edge_1');
        $dot_driver->expects($this->at(4))
            ->method('createEdgeScript')
            ->willReturn('edge_2');
        $dot_driver->expects($this->at(5))
            ->method('createEdgeScript')
            ->willReturn('edge_3');

        $result = $dot_driver->createScriptWithoutGroups($command);
        $this->assertEquals("digraph MIVAR {\n  node_1\n  node_2\n  node_3\n  edge_1\n  edge_2\n  edge_3\n}", $result);
    }

    /**
     * @return \DrawerGraphs\Command\Node[]
     */
    protected function getNodes()
    {
        return [
            $this
                ->getMockBuilder(\DrawerGraphs\Command\Node::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this
                ->getMockBuilder(\DrawerGraphs\Command\Node::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this
                ->getMockBuilder(\DrawerGraphs\Command\Node::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];
    }

    /**
     * @return \DrawerGraphs\Command\Edge[]
     */
    protected function getEdges()
    {
        return [
            $this
                ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this
                ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this
                ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];
    }

}
