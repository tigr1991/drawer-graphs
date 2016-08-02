<?php

namespace DrawerGraphsTests\Functional\Command;

/**
 * Class CommandTest
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{
    const SCRIPT = "The string is for test";

    const COMMAND = "echo test";
    const RESULT_OF_COMMAND = "test\n";

    public function testLaunch()
    {
        /** @var \DrawerGraphs\Command\Driver\IDriver $driver */
        $driver = $this
            ->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->getMock();
        \DrawerGraphs\Command\Command::create($driver);
    }


    public function testShellExec()
    {
        /** @var \DrawerGraphs\Command\Driver\IDriver $driver */
        $driver = $this
            ->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->getMock();
        $command = \DrawerGraphs\Command\Command::create($driver);
        $result = \DrawerGraphsTests\PHPUnitHelper::callProtectedMethod($command, 'shellExec', [static::COMMAND]);
        $this->assertEquals(static::RESULT_OF_COMMAND, $result);
    }


    public function testAddNodeAndEdge()
    {
        /** @var \DrawerGraphs\Command\Driver\IDriver $driver */
        $driver = $this
            ->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var \DrawerGraphs\Command\Driver\IDriver $driver */
        $command = \DrawerGraphs\Command\Command::create($driver);
        /** @var \DrawerGraphs\Command\Node $node */
        $node = $this
            ->getMockBuilder(\DrawerGraphs\Command\Node::class)
            ->disableOriginalConstructor()
            ->getMock();
        $command->addNode($node);
        /** @var \DrawerGraphs\Command\Edge $edge */
        $edge = $this
            ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
            ->disableOriginalConstructor()
            ->getMock();
        $command->addEdge($edge);
        $this->assertTrue([$node] === $command->getNodes());
        $this->assertTrue([$edge] === $command->getEdges());
    }

}
