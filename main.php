<?php

include 'TaskController.php';

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$taskController = new TaskController('tasks');

$taskController->showMenu(TaskController::$SHOW_TO_CONSOLE);

$taskId = readline();

$taskController->runTask($taskId);