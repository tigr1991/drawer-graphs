<?php

namespace DrawerGraphsTests\Functional\Command;


/**
 * Class NodeTest
 */
class NodeTest extends \PHPUnit_Framework_TestCase
{
    public function testLaunch()
    {
        \DrawerGraphs\Command\Node::create();
    }
}