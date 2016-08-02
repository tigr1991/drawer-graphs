<?php

namespace DrawerGraphsTests\Functional\Command\Driver;

/**
 * Class DotTest
 */
class DotTest extends \PHPUnit_Framework_TestCase
{
    /** @var string Для генерации уникальной строки */
    protected static $i = 'a';

    public function testLaunch()
    {
        \DrawerGraphs\Command\Driver\Dot::create();
    }

    public function testCreateScript()
    {
        /** @var \DrawerGraphs\Command\Driver\Dot | \PHPUnit_Framework_MockObject_MockObject $driver */
        $driver = $this
            ->getMockBuilder(\DrawerGraphs\Command\Driver\Dot::class)
            ->disableOriginalConstructor()
            ->setMethods(['_', 'createNodeScript', 'createEdgeScript'])
            ->getMock();

        $node_1 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Node::class)
            ->disableOriginalConstructor()
            ->getMock();
        $node_2 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Node::class)
            ->disableOriginalConstructor()
            ->getMock();
        $node_3 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Node::class)
            ->disableOriginalConstructor()
            ->getMock();

        $driver
            ->expects($this->at(0))
            ->method('createNodeScript')
            ->with($node_1)
            ->will($this->returnValue('node_1'));

        $driver
            ->expects($this->at(1))
            ->method('createNodeScript')
            ->with($node_2)
            ->will($this->returnValue('node_2'));

        $driver
            ->expects($this->at(2))
            ->method('createNodeScript')
            ->with($node_3)
            ->will($this->returnValue('node_3'));

        $edge_1 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
            ->disableOriginalConstructor()
            ->getMock();
        $edge_2 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
            ->disableOriginalConstructor()
            ->getMock();
        $edge_3 = $this
            ->getMockBuilder(\DrawerGraphs\Command\Edge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $driver
            ->expects($this->at(3))
            ->method('createEdgeScript')
            ->with($edge_1)
            ->will($this->returnValue('edge_1'));

        $driver
            ->expects($this->at(4))
            ->method('createEdgeScript')
            ->with($edge_2)
            ->will($this->returnValue('edge_2'));

        $driver
            ->expects($this->at(5))
            ->method('createEdgeScript')
            ->with($edge_3)
            ->will($this->returnValue('edge_3'));

        $command = $this
            ->getMockBuilder(\DrawerGraphs\Command\Command::class)
            ->disableOriginalConstructor()
            ->setConstructorArgs([$driver])
            ->setMethods(['getNodes', 'getEdges'])
            ->getMock();

        $command
            ->expects($this->any())
            ->method('getNodes')
            ->with()
            ->will($this->returnValue([$node_1, $node_2, $node_3]));

        $command
            ->expects($this->any())
            ->method('getEdges')
            ->with()
            ->will($this->returnValue([$edge_1, $edge_2, $edge_3]));


        $result = $driver->createScript($command);

        $this->assertEquals(
            "digraph MIVAR {\n\tsubgraph cluster{\n\t\t  node_1\n\t\t  node_2\n\t\t  node_3\n\t\t  edge_1\n\t\t  edge_2\n\t\t  edge_3\n\t}\n}",
            $result
        );
    }

    public function testCreateNodeScript()
    {
        $driver = \DrawerGraphs\Command\Driver\Dot::create();

        $node = \DrawerGraphs\Command\Node::create();
        $id = $this->getUniqueString();
        $background = $this->getUniqueString();
        $border_color = $this->getUniqueString();
        $font_color = $this->getUniqueString();
        $font_size = $this->getUniqueString();
        $label = $this->getUniqueString();
        $shape = \DrawerGraphs\Command\Registry\NodeValues::SHAPE_ELLIPSE;
        $tooltip = $this->getUniqueString();
        $style = \DrawerGraphs\Command\Registry\NodeValues::STYLE_FILLED;

        $node->setId($id);
        $node->setBackground($background);
        $node->setBorderColor($border_color);
        $node->setFontColor($font_color);
        $node->setFontSize($font_size);
        $node->setLabel($label);
        $node->setShape($shape);
        $node->setTooltip($tooltip);
        $node->setStyle($style);

        $shape = \DrawerGraphs\Command\Registry\NodeValues::getValueForDot($node->getShape());
        $style = \DrawerGraphs\Command\Registry\NodeValues::getValueForDot($node->getStyle());
        $result = \DrawerGraphsTests\PHPUnitHelper::callProtectedMethod($driver, 'createNodeScript', [$node]);
        $this->assertEquals(
            $node_script = "{$id} [tooltip=\"{$tooltip}\" label=\"{$label}\" color=\"{$border_color}\" shape=\"{$shape}\" fillcolor=\"{$background}\" fontcolor=\"{$font_color}\" fontsize={$font_size} style=\"{$style}\"]",
            $result
        );
    }

    public function testCreateEdgeScript()
    {
        $driver = \DrawerGraphs\Command\Driver\Dot::create();
        $node_1 = \DrawerGraphs\Command\Node::create();
        $node_1->setId($this->getUniqueString());
        $node_2 = \DrawerGraphs\Command\Node::create();
        $node_2->setId($this->getUniqueString());
        $edge = \DrawerGraphs\Command\Edge::create($node_1, $node_2);

        $from = $node_1;
        $to = $node_2;
        $id = $this->getUniqueString();
        $label = $this->getUniqueString();
        $label_head = $this->getUniqueString();
        $label_tail = $this->getUniqueString();
        $color = $this->getUniqueString();
        $font_color = $this->getUniqueString();
        $font_size = $this->getUniqueString();
        $style = \DrawerGraphs\Command\Registry\NodeValues::STYLE_DEFAULT;
        $tooltip = $this->getUniqueString();
        $label_distance = $this->getUniqueString();
        $label_angle = $this->getUniqueString();

        $edge->setFrom($from);
        $edge->setTo($to);
        $edge->setId($id);
        $edge->setLabel($label);
        $edge->setLabelHead($label_head);
        $edge->setLabelTail($label_tail);
        $edge->setColor($color);
        $edge->setFontColor($font_color);
        $edge->setFontSize($font_size);
        $edge->setStyle($style);
        $edge->setTooltip($tooltip);
        $edge->setLabeldistance($label_distance);
        $edge->setLabelAngle($label_angle);

        $style = \DrawerGraphs\Command\Registry\EdgeValues::getValueForDot($edge->getStyle());

        $result =\DrawerGraphsTests\PHPUnitHelper::callProtectedMethod($driver, 'createEdgeScript', [$edge]);
        $this->assertEquals(
            $edge_script = "{$from->getId()} -> {$to->getId()} [labeldistance={$label_distance} labelangle={$label_angle} headlabel=\"{$label_head}\" taillabel=\"{$label_tail}\" tooltip=\"{$tooltip}\" label=\"{$label}\" color=\"{$color}\" fontcolor=\"{$font_color}\" fontsize={$font_size} style=\"{$style}\" arrowhead=\"\" arrowtail=\"\" penwidth=\"1\"]",
            $result
        );

    }

    /**
     * @return string
     */
    protected function getUniqueString()
    {
        return static::$i++;
    }

}
