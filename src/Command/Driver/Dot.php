<?php

namespace DrawerGraphs\Command\Driver;

/**
 * Class Dot
 * Формирование скрипта для Dot
 */
class Dot implements IDriver
{

    /**
     * @return static
     */
    public static function create()
    {
        $obj = new static();
        return $obj;
    }

    /**
     * Dot constructor.
     */
    protected function __construct()
    {

    }


    /**
     * Создание скрипта отрисовки без учета групп
     * @param \DrawerGraphs\Command\Command $command
     * @return string
     */
    public function createScriptWithoutGroups(\DrawerGraphs\Command\Command $command)
    {
        //TODO Данный метод нуждается в рефакторинге

        $script = [];
        $script[] = 'digraph MIVAR {';

        foreach ($command->getNodes() as $node) {
            $script[] = '  ' . $this->createNodeScript($node);
        }

        foreach ($command->getEdges() as $edge) {
            $script[] = '  ' . $this->createEdgeScript($edge);
        }

        $script[] = "}";
        return join("\n", $script);
    }

    /**
     * Создание скрипта отрисовки с учетом групп
     * @param \DrawerGraphs\Command\Command $command
     * @return string
     */
    public function createScript(\DrawerGraphs\Command\Command $command)
    {
        //TODO Данный метод нуждается в рефакторинге

        $script_by_groups = [];
        foreach ($command->getNodes() as $node) {
            $script_by_groups[$node->getGroup()][] = '  ' . $this->createNodeScript($node);
        }

        foreach ($command->getEdges() as $edge) {
            $script_by_groups[''][] = '  ' . $this->createEdgeScript($edge);
        }

        $res = 'digraph MIVAR {';

        foreach ($script_by_groups as $id => $item) {
            $res .= "\n\tsubgraph cluster{$id}{\n\t\t";
            $res .= join("\n\t\t", $item);
            $res .= "\n\t}\n";
        }

        $res .= '}';

        return $res;
    }

    /**
     * @param \DrawerGraphs\Command\Node $node
     * @return string
     */
    protected function createNodeScript(\DrawerGraphs\Command\Node $node)
    {
        $id = $node->getId();
        $background = $node->getBackground();
        $border_color = $node->getBorderColor();
        $font_color = $node->getFontColor();
        $font_size = $node->getFontSize();
        $label = $node->getLabel();
        $shape = \DrawerGraphs\Command\Registry\NodeValues::getValueForDot($node->getShape());
        $tooltip = $node->getTooltip();
        $style = \DrawerGraphs\Command\Registry\NodeValues::getValueForDot($node->getStyle());

        $node_script = "{$id} [tooltip=\"{$tooltip}\" label=\"{$label}\" color=\"{$border_color}\" shape=\"{$shape}\" fillcolor=\"{$background}\" fontcolor=\"{$font_color}\" fontsize={$font_size} style=\"{$style}\"]";

        return $node_script;
    }

    /**
     * @param \DrawerGraphs\Command\Edge $edge
     * @return string
     */
    protected function createEdgeScript(\DrawerGraphs\Command\Edge $edge)
    {
        $from = $edge->getFrom()->getId();
        $to = $edge->getTo()->getId();
        $id = $edge->getId();
        $label = $edge->getLabel();
        $label_head = $edge->getLabelHead();
        $label_tail = $edge->getLabelTail();
        $color = $edge->getColor();
        $font_color = $edge->getFontColor();
        $font_size = $edge->getFontSize();
        $style = \DrawerGraphs\Command\Registry\EdgeValues::getValueForDot($edge->getStyle());
        $tooltip = $edge->getTooltip();
        $label_distance = $edge->getLabeldistance();
        $label_angle = $edge->getLabelangle();
        $arrowhead = $edge->getArrowHead();
        $arrowtail = $edge->getArrowTail();
        $penwidth = $edge->getPenwidth();

        $edge_script = "{$from} -> {$to} [labeldistance={$label_distance} labelangle={$label_angle} headlabel=\"{$label_head}\" taillabel=\"{$label_tail}\" tooltip=\"{$tooltip}\" label=\"{$label}\" color=\"{$color}\" fontcolor=\"{$font_color}\" fontsize={$font_size} style=\"{$style}\" arrowhead=\"{$arrowhead}\" arrowtail=\"{$arrowtail}\" penwidth=\"{$penwidth}\"]";

        return $edge_script;
    }


}