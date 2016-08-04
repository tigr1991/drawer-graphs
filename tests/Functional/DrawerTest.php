<?php

namespace DrawerGraphsTests\Functional;

/**
 * Class DrawerTest
 */
class DrawerTest extends \PHPUnit_Framework_TestCase
{
    public function testLaunch()
    {
        \DrawerGraphs\Drawer::create();
    }

    /**
     * Отрисовка пустого графа
     */
    public function testDraw()
    {
        $this->markTestSkipped("Данный тест является примером и требует Dot");
        $graph = new \Fhaculty\Graph\Graph;
        $drawer = \DrawerGraphs\Drawer::create();
        $drawer->prepare($graph);
        $code = $drawer->render();
        $must_code = <<<EOF
<object type="image/svg+xml" data="data:image/svg+xml;charset=utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8IS0tIEdlbmVyYXRlZCBieSBncmFwaHZpeiB2ZXJzaW9uIDIuMzYuMCAoMjAxNDAxMTEuMjMxNSkKIC0tPgo8IS0tIFRpdGxlOiBNSVZBUiBQYWdlczogMSAtLT4KPHN2ZyB3aWR0aD0iOHB0IiBoZWlnaHQ9IjhwdCIKIHZpZXdCb3g9IjAuMDAgMC4wMCA4LjAwIDguMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgo8ZyBpZD0iZ3JhcGgwIiBjbGFzcz0iZ3JhcGgiIHRyYW5zZm9ybT0ic2NhbGUoMSAxKSByb3RhdGUoMCkgdHJhbnNsYXRlKDQgNCkiPgo8dGl0bGU+TUlWQVI8L3RpdGxlPgo8cG9seWdvbiBmaWxsPSJ3aGl0ZSIgc3Ryb2tlPSJub25lIiBwb2ludHM9Ii00LDQgLTQsLTQgNCwtNCA0LDQgLTQsNCIvPgo8L2c+Cjwvc3ZnPgo="></object>
EOF;
        $this->assertEquals(trim($must_code), trim($code));
    }
}
