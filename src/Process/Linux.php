<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 26.02.2016
 * Time: 10:36
 */

namespace DrawerGraphs\Process;

/**
 * Class Linux
 * Класс для работы в "линуксоидных системах"
 */
class Linux implements IProcess
{
    /** Задержка проверки статуса в микросекундах */
    const DELAY = 100000;

    /** @var  Resource */
    protected $process;
    /** @var  string */
    protected $command;
    /** @var  int */
    protected $pid;
    /** @var  bool */
    protected $running;

    /**
     * @param string $command
     * @return static
     */
    public static function create($command)
    {
        assert(is_string($command));
        return new static($command);
    }

    /**
     * @param string $command
     * @throws \DrawerGraphs\Exception
     */
    protected function __construct($command)
    {
        assert(is_string($command));
        $process = proc_open(
            $command,
            [],
            $not_need
        );
        $status = proc_get_status($process);

        if ($status === false) {
            throw new \DrawerGraphs\Exception("Не удалось получить статус процесса");
        }
        $this->process = $process;
        $this->command = $command;
        $this->pid = $status['pid'];
        $this->running = $status['running'];
        $this->checkExitCode($status['exitcode']);
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @throws \DrawerGraphs\Exception
     */
    protected function updateStatus()
    {
        $status = proc_get_status($this->process);
        if ($status === false) {
            throw new \DrawerGraphs\Exception("Не удалось получить статус процесса");
        }
        $this->running = $status['running'];
        $this->checkExitCode($status['exitcode']);
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        $this->updateStatus();
        return !$this->running;
    }

    /**
     * @return void
     */
    public function waitIfProcessIsCompleted()
    {
        while (!$this->isCompleted()) {
            usleep(static::DELAY);
        }
    }

    /**
     * @return int
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param int $code
     * @throws \DrawerGraphs\Exception
     */
    protected function checkExitCode($code)
    {
        if ($code !== 0 && $code !== -1) {
            throw new \DrawerGraphs\Exception("Аварийное завершение процесса");
        }
    }
}