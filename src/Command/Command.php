<?php


namespace DrawerGraphs\Command;

/**
 * Class Command
 *
 */
class Command
{
    const FORMAT_SVG = 'svg';
    const FORMAT_PNG = 'png';


    /** @var  \DrawerGraphs\Command\Node[] */
    protected $nodes = [];
    /** @var  \DrawerGraphs\Command\Edge[] */
    protected $edges = [];

    /** @var string */
    protected $output_format = \DrawerGraphs\Command\Command::FORMAT_SVG;

    /** @var \DrawerGraphs\Command\Driver\IDriver */
    protected $driver;

    /** @var  \DrawerGraphs\Command\Promise */
    protected $object_promise;

    /** @var string */
    protected $executable = 'dot';


    /**
     * @param Driver\IDriver $driver
     * @return Command
     */
    public static function create(\DrawerGraphs\Command\Driver\IDriver $driver)
    {
        $obj = new static($driver);
        return $obj;
    }

    /**
     * Command constructor.
     * @param Driver\IDriver $driver
     */
    protected function __construct(\DrawerGraphs\Command\Driver\IDriver $driver)
    {
        $this->driver = $driver;
    }


    public function prepare()
    {
        $script = $this->driver->createScript($this);
        $this->buildCommandAndExec($script);
    }

    /**
     * @return string
     */
    public function render()
    {
        if ($this->getOutputFormat() === \DrawerGraphs\Command\Command::FORMAT_SVG) {
            $src = 'data:image/svg+xml;charset=utf8;base64,' . base64_encode($this->object_promise->getString());
            return '<object type="image/svg+xml" data="' . $src . '"></object>';
        } else {
            $src = 'data:image/' . $this->getOutputFormat() . ';charset=utf8;base64,' . base64_encode($this->object_promise->getString());
            return '<img src="' . $src . '" />';
        }
    }

    /**
     * @return Node[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @param \DrawerGraphs\Command\Node $node
     */
    public function addNode(\DrawerGraphs\Command\Node $node)
    {
        $this->nodes[] = $node;
    }

    /**
     * @return \DrawerGraphs\Command\Edge[]
     */
    public function getEdges()
    {
        return $this->edges;
    }

    /**
     * @param \DrawerGraphs\Command\Edge $edge
     */
    public function addEdge(\DrawerGraphs\Command\Edge $edge)
    {
        $this->edges[] = $edge;
    }

    /**
     * @return string
     */
    public function getOutputFormat()
    {
        return $this->output_format;
    }

    /**
     * @param string $output_format
     */
    public function setOutputFormat($output_format)
    {
        if ($output_format !== static::FORMAT_SVG && $output_format !== static::FORMAT_PNG) {
            throw new \DrawerGraphs\Exception("Неизвестный формат: " . $output_format . "\n");
        }
        $this->output_format = $output_format;
    }

    /**
     * @param string $command
     * @return string
     */
    protected function shellExec($command)
    {
        return shell_exec($command);
    }

    protected function buildCommandAndExec($script)
    {
        $tmp = tempnam(sys_get_temp_dir(), 'vizualization');
        if ($tmp === false) {
            throw new \DrawerGraphs\Exception('Unable to get temporary file name for vizualization script');
        }
        $ret = file_put_contents($tmp, $script, LOCK_EX);
        if ($ret === false) {
            throw new \DrawerGraphs\Exception('Unable to write vizualization script to temporary file');
        }

        $format = $this->getOutputFormat();
        $file = $tmp . '.' . $format;
        $parts_of_command = [];
        $parts_of_command[] = escapeshellarg($this->executable);
        $parts_of_command[] = '-T';
        $parts_of_command[] = escapeshellarg($format);
        $parts_of_command[] = escapeshellarg($tmp);
        $parts_of_command[] = '-o';
        $parts_of_command[] = escapeshellarg($file);

        $command = join(' ', $parts_of_command);

        $process = \SemanticLogic\Process\Linux::create($command);

        $this->object_promise = \DrawerGraphs\Command\Promise::create($process, $file);
    }

    /**
     * @return string
     */
    public function getExecutable()
    {
        return $this->executable;
    }

    /**
     * @param string $executable
     */
    public function setExecutable($executable)
    {
        assert(is_string($executable));
        $this->executable = $executable;
    }

    /**
     * @param Node $delete_node
     */
    public function deleteNode(\DrawerGraphs\Command\Node $delete_node)
    {
        foreach ($this->nodes as $index => $node) {
            if ($node === $delete_node) {
                unset($this->nodes[$index]);
                return;
            }
        }
        throw new \SemanticLogic\Exception("Данной вершины нет в графе " . var_export($delete_node, true));
    }

    /**
     * @param Edge $delete_edge
     */
    public function deleteEdge(\DrawerGraphs\Command\Edge $delete_edge)
    {
        foreach ($this->edges as $index => $edge) {
            if ($edge === $delete_edge) {
                unset($this->edges[$index]);
                return;
            }
        }
        throw new \SemanticLogic\Exception("Данного ребра нет в графе " . var_export($delete_edge, true));
    }

    /**
     * @return string[]
     */
    static public function getSupportedFormats()
    {
        return [
            static::FORMAT_PNG,
            static::FORMAT_SVG,
        ];
    }
}