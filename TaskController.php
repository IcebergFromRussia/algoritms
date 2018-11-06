<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 29.10.2018
 * Time: 17:39
 */

class TaskController
{
    /**
     * @var string
     */
    private $taskDir;

    public static $SHOW_TO_CONSOLE = 1;

    /**
     * TaskController constructor.
     * @param string $taskDir
     */
    public function __construct($taskDir)
    {
        $this->taskDir = $taskDir;
    }


    public function showMenu($displayMethod)
    {
        $taskList = scandir($this->taskDir);

        switch ($displayMethod) {
            case self::$SHOW_TO_CONSOLE :
                {
                    print_r(' __________________ '. PHP_EOL);
                    print_r('|       Menu       |'. PHP_EOL);
                    print_r(' __________________ '. PHP_EOL);
                    print_r( PHP_EOL);

                    foreach ($taskList as $key => $task) {

                        if (strlen($task) > 4 && substr($task, -3) == 'php') {
                            print_r($key . ' : ' . $task . PHP_EOL);
                        }

                    }
                    break;
                }
            default:
                {
                    print_r('не выбран способ вывода меню');
                }
        }
    }

    /**
     * @param int $taskId
     */
    public function runTask($taskId)
    {
        $taskList = scandir($this->taskDir);
        $path = $this->taskDir . '/' . $taskList[$taskId];
        include $path;
    }
}