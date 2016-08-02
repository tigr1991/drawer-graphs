<?php


namespace DrawerGraphs;

/**
 * Class Drawer
 * "Рисовальщик" графа
 */
class Drawer
{
    /** @var  \DrawerGraphs\Command\Driver\IDriver */
    protected $driver;

    /** @var  \DrawerGraphs\Converter\Base */
    protected $converter;

    /** @var  \DrawerGraphs\Command\Command */
    protected $command;
    protected $prepared = false;

    /**
     * Drawer constructor.
     */
    protected function __construct()
    {

    }

    /**
     * @return static
     */
    public static function create()
    {
        $obj = new static();
        $obj->driver = \DrawerGraphs\Command\Driver\Dot::create();
        $obj->converter = \DrawerGraphs\Converter\Base::create();
        $obj->command = $obj->initCommand();
        return $obj;
    }

    /**
     * @return Command\Command
     */
    protected function initCommand()
    {
        return \DrawerGraphs\Command\Command::create($this->driver);
    }

    /**
     * @return Command\Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param \Fhaculty\Graph\Graph $graph
     * @throws Exception
     */
    public function prepare(\Fhaculty\Graph\Graph $graph)
    {
        if ($this->prepared) {
            throw new \DrawerGraphs\Exception("Рисовальщик уже запущен");
        }
        $this->prepared = true;

        $this->converter->convert(
            $this->command,
            $graph
        );
        $this->command->prepare();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function render()
    {
        if(!$this->prepared){
            throw new \DrawerGraphs\Exception("Сперва надо выполнить метод prepare!");
        }

        return $this->command->render();
    }


    /**
     * @param \DrawerGraphs\Command\Driver\IDriver $driver
     */
    public function setDriver(\DrawerGraphs\Command\Driver\IDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param Converter\Base $converter
     */
    public function setConverter(\DrawerGraphs\Converter\Base $converter)
    {
        $this->converter = $converter;
    }
}