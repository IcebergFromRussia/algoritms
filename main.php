<?php

include 'TaskController.php';

$taskController = new TaskController('tasks');

$taskController->showMenu(TaskController::$SHOW_TO_CONSOLE);

$taskId = readline();

$taskController->runTask($taskId);