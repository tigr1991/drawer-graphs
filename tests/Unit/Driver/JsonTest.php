<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 03.08.2016
 * Time: 17:13
 */

namespace DrawerGraphsTests\Unit\Driver;

/**
 * Class JsonTest
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateScript()
    {
        $json_driver = \DrawerGraphs\Command\Driver\Json::create();

        $command = $this->getMockBuilder(\DrawerGraphs\Command\Command::class)
            ->disableOriginalConstructor()
            ->getMock();


        try {
            $json_driver->createScript($command);
        }catch (\DrawerGraphs\Exception $e){
            $this->assertEquals("Данный метод ещё не реализован", $e->getMessage());

        }
    }
}
