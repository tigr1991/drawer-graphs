<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 24.02.2016
 * Time: 16:17
 */

namespace DrawerGraphs\Command;


class Promise
{
    /** @var  string */
    protected $promised_file_with_result;

    /**
     * @param \SemanticLogic\Process\Linux $process
     * @param string $promised_file_with_result
     * @return static
     */
    public static function create(\SemanticLogic\Process\Linux $process, $promised_file_with_result)
    {
        assert(is_string($promised_file_with_result));

        $obj = new static($process, $promised_file_with_result);
        return $obj;
    }

    /**
     * Promise constructor.
     * @param \SemanticLogic\Process\Linux $process
     * @param string $promised_file_with_result
     */
    protected function __construct(\SemanticLogic\Process\Linux $process, $promised_file_with_result)
    {
        assert(is_string($promised_file_with_result));

        $this->promised_file_with_result = $promised_file_with_result;
        $this->process = $process;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getString();
    }

    /**
     * @return string
     */
    public function getString()
    {
        //Ожидаем завершение процесса
        $this->process->waitIfProcessIsCompleted();

        if (!is_file($this->promised_file_with_result)) {
            throw new \SemanticLogic\Exception($this->promised_file_with_result . " не является файлом или не существует.");
        }

        if (!is_readable($this->promised_file_with_result)) {
            throw new \SemanticLogic\Exception("Файл '" . $this->promised_file_with_result . "' не доступен для чтения");
        }

        /** @var string $content */
        $content = file_get_contents($this->promised_file_with_result);
        if ($content === false) {
            throw new \SemanticLogic\Exception("Ошибка получения контента из файла '" . $this->promised_file_with_result . "'");
        }
        return $content;
    }

}