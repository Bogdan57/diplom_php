<?php 
$filter_param = isset($_GET['filter']) ? "?filter=" . $_GET['filter'] : "";
$jsonFileAccessModel = new JsonFileAccessModel('tasks');
$tasks = json_decode($jsonFileAccessModel->read(), true);
$needed_key;

foreach ($tasks as $key => $value) {
    if ($value['id'] == $task['id']) $needed_key = $key;
}

unset($tasks[$needed_key]);
$tasks = array_values($tasks);
$json_tasks = json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$jsonFileAccessModel->write($json_tasks);

$filename = Config::FILES_PATH . $task['original_lang'] . '/' . $task['original_text'];

if (file_exists($filename)) {
    unlink($filename);
}


foreach ($task['translation_lang'] as $value) {
    $filename = Config::FILES_PATH . $value . '/translate_' . $task['id'] . '.json';

    if (file_exists($filename)) {
        unlink($filename);
    }
}


