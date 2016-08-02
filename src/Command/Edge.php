<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.12.2015
 * Time: 15:48
 */

namespace DrawerGraphs\Command;

/**
 * Class Edge
 * Класс ребро, для отрисовки
 */
class Edge
{
    /** @var  \DrawerGraphs\Command\Node */
    protected $from;
    /** @var  \DrawerGraphs\Command\Node */
    protected $to;

    protected $id = '';
    protected $label = '';
    protected $label_head = '';
    protected $label_tail = '';
    protected $color = '';
    protected $font_color = '';
    protected $font_size = '10';
    protected $style = \DrawerGraphs\Command\Registry\EdgeValues::STYLE_DEFAULT;
    protected $tooltip = '';
    protected $label_distance = '0';
    protected $label_angle = '0';
    protected $arrow_head = '';
    protected $arrow_tail = '';
    protected $penwidth = 1;


    /**
     * @param Node $from
     * @param Node $to
     * @return static
     */
    public static function create(
        \DrawerGraphs\Command\Node $from,
        \DrawerGraphs\Command\Node $to
    ) {
        $obj = new static($from, $to);
        $from->addEdgeOut($obj);
        $to->addEdgeIn($obj);
        return $obj;
    }

    /**
     * Edge constructor.
     * @param Node $from
     * @param Node $to
     */
    protected function __construct(
        \DrawerGraphs\Command\Node $from,
        \DrawerGraphs\Command\Node $to
    ) {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        assert(is_string($id));
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        assert(is_string($label));
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabelHead()
    {
        return $this->label_head;
    }

    /**
     * @param string $label_head
     */
    public function setLabelHead($label_head)
    {
        assert(is_string($label_head));
        $this->label_head = $label_head;
    }

    /**
     * @return string
     */
    public function getLabelTail()
    {
        return $this->label_tail;
    }

    /**
     * @param string $label_tail
     */
    public function setLabelTail($label_tail)
    {
        assert(is_string($label_tail));
        $this->label_tail = $label_tail;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        assert(is_string($color));
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getFontColor()
    {
        return $this->font_color;
    }

    /**
     * @param string $font_color
     */
    public function setFontColor($font_color)
    {
        assert(is_string($font_color));
        $this->font_color = $font_color;
    }

    /**
     * @return string
     */
    public function getFontSize()
    {
        return $this->font_size;
    }

    /**
     * @param string $font_size
     */
    public function setFontSize($font_size)
    {
        assert(is_string($font_size));
        $this->font_size = $font_size;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param int $style
     */
    public function setStyle($style)
    {
        assert(is_int($style));
        $this->style = $style;
    }

    /**
     * @return string
     */
    public function getTooltip()
    {
        return $this->tooltip;
    }

    /**
     * @param string $tooltip
     */
    public function setTooltip($tooltip)
    {
        assert(is_string($tooltip));
        $this->tooltip = $tooltip;
    }

    /**
     * @return string
     */
    public function getLabeldistance()
    {
        return $this->label_distance;
    }

    /**
     * @param string $label_distance
     */
    public function setLabeldistance($label_distance)
    {
        assert(is_string($label_distance));
        $this->label_distance = $label_distance;
    }

    /**
     * @return string
     */
    public function getLabelangle()
    {
        return $this->label_angle;
    }

    /**
     * @param string $label_angle
     */
    public function setLabelAngle($label_angle)
    {

        assert(is_string($label_angle));
        $this->label_angle = $label_angle;
    }


    /**
     * @return Node
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return Node
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param Node $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @param Node $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getArrowTail()
    {
        return $this->arrow_tail;
    }

    /**
     * @param string $arrow_tail
     */
    public function setArrowTail($arrow_tail)
    {
        $this->arrow_tail = $arrow_tail;
    }

    /**
     * @return string
     */
    public function getArrowHead()
    {
        return $this->arrow_head;
    }

    /**
     * @param string $arrow_head
     */
    public function setArrowHead($arrow_head)
    {
        $this->arrow_head = $arrow_head;
    }

    /**
     * @return int
     */
    public function getPenwidth()
    {
        return $this->penwidth;
    }

    /**
     * @param int $penwidth
     */
    public function setPenwidth($penwidth)
    {
        $this->penwidth = $penwidth;
    }


}