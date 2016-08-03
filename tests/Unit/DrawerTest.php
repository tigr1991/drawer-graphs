<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.08.2016
 * Time: 18:45
 */

namespace DrawerGraphsTests\Unit;

use DrawerGraphsTests\PHPUnitHelper;

/**
 * Class DrawerTest
 */
class DrawerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Тест ради теста, только лишь для метрики покрытия
     */
    public function testSetDriver()
    {
        /** @var \DrawerGraphs\Drawer $drawer */
        $drawer = $this->getMockBuilder(\DrawerGraphs\Drawer::class)
            ->disableOriginalConstructor()
            ->setMethods(['_'])
            ->getMock();
        /** @var \DrawerGraphs\Command\Driver\IDriver $driver */
        $driver = $this->getMockBuilder(\DrawerGraphs\Command\Driver\IDriver::class)
            ->disableOriginalConstructor()
            ->getMock();
        $drawer->setDriver($driver);
        $this->assertEquals($driver, PHPUnitHelper::getProtectedProperty($drawer, 'driver'));
    }

    /**
     * Тест ради теста, только лишь для метрики покрытия
     */
    public function testSetConverter()
    {
        /** @var \DrawerGraphs\Drawer $drawer */
        $drawer = $this->getMockBuilder(\DrawerGraphs\Drawer::class)
            ->disableOriginalConstructor()
            ->setMethods(['_'])
            ->getMock();
        /** @var \DrawerGraphs\Converter\Base $converter */
        $converter = $this->getMockBuilder(\DrawerGraphs\Converter\Base::class)
            ->disableOriginalConstructor()
            ->getMock();
        $drawer->setConverter($converter);
        $this->assertEquals($converter, PHPUnitHelper::getProtectedProperty($drawer, 'converter'));
    }
}
