<?php 

if (isset($task)) {
    $tasksList = new TasksList();
    $tasks = $tasksList->getList();

    foreach ($tasks as &$task_value) {
        if ($task_value['id'] == $task['id']) {
            $task_value['status'] = 'resolved';
        }
    }

    $json_tasks = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    $jsonFileAccessModel = new JsonFileAccessModel('tasks');
    $jsonFileAccessModel->write($json_tasks);
}

header('Location: index.php');