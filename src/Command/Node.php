<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.12.2015
 * Time: 15:48
 */

namespace DrawerGraphs\Command;


class Node
{
    protected $id;
    protected $label;
    protected $background;
    protected $font_size = "14.0";
    protected $font_color;
    protected $border_color;
    protected $shape = \DrawerGraphs\Command\Registry\NodeValues::SHAPE_DEFAULT;
    protected $tooltip;
    protected $style = \DrawerGraphs\Command\Registry\NodeValues::STYLE_DEFAULT;
    protected $group;

    /** @var \DrawerGraphs\Command\Edge[] */
    protected $edges_out = [];
    /** @var \DrawerGraphs\Command\Edge[] */
    protected $edges_in = [];


    public static function create()
    {
        $obj = new static();
        return $obj;
    }

    protected function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @param mixed $background
     */
    public function setBackground($background)
    {
        $this->background = $background;
    }

    /**
     * @return mixed
     */
    public function getFontSize()
    {
        return $this->font_size;
    }

    /**
     * @param mixed $font_size
     */
    public function setFontSize($font_size)
    {
        $this->font_size = $font_size;
    }

    /**
     * @return mixed
     */
    public function getFontColor()
    {
        return $this->font_color;
    }

    /**
     * @param mixed $font_color
     */
    public function setFontColor($font_color)
    {
        $this->font_color = $font_color;
    }

    /**
     * @return mixed
     */
    public function getBorderColor()
    {
        return $this->border_color;
    }

    /**
     * @param mixed $border_color
     */
    public function setBorderColor($border_color)
    {
        $this->border_color = $border_color;
    }

    /**
     * @return mixed
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * @param int $shape
     */
    public function setShape($shape)
    {
        assert(is_int($shape));
        $this->shape = $shape;
    }

    /**
     * @return mixed
     */
    public function getTooltip()
    {
        return $this->tooltip;
    }

    /**
     * @param mixed $tooltip
     */
    public function setTooltip($tooltip)
    {
        $this->tooltip = $tooltip;
    }

    /**
     * @return mixed
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
     * @param Edge $edge
     */
    public function addEdgeOut(\DrawerGraphs\Command\Edge $edge)
    {
        $this->edges_out[] = $edge;
    }

    /**
     * @param Edge $edge
     */
    public function addEdgeIn(\DrawerGraphs\Command\Edge $edge)
    {
        $this->edges_in[] = $edge;
    }

    /**
     * @return Edge[]
     */
    public function getEdgesOut()
    {
        return $this->edges_out;
    }

    /**
     * @return Edge[]
     */
    public function getEdgesIn()
    {
        return $this->edges_in;
    }


    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }


}