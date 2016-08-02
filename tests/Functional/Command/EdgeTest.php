<?php

namespace DrawerGraphsTests\Functional\Command;

/**
 * Class EdgeTest
 */
class EdgeTest extends \PHPUnit_Framework_TestCase
{
    public function testLaunch()
    {
        /** @var \DrawerGraphs\Command\Node $node_1 */
        $node_1 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Node::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var \DrawerGraphs\Command\Node $node_2 */
        $node_2 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Node::class)
            ->disableOriginalConstructor()
            ->getMock();
        $edge = \DrawerGraphs\Command\Edge::create($node_1, $node_2);
    }

}