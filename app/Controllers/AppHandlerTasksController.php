<?php

namespace PhpHunter\Framework\App\Controllers;

use PhpHunter\Framework\App\Models\DataFileModel;
use PhpHunter\Kernel\Controllers\ResponseController;

class AppHandlerTasksController extends DataFileModel
{
    public static function getAllTasks(): bool
    {
        $all_tasks = glob("./datafile/*.json", GLOB_BRACE);
        $array_tasks = [];

        if(count($all_tasks) == 0) {
            $code = 204;
            $message = json_encode(["error" => "Nothing here !"]);
        } else {
            for ($k = 0; $k < count($all_tasks); $k++) {
                $array_tasks["task_{$k}"] = $all_tasks[$k];
            }
            $code = 200;
            $message = json_encode($array_tasks);
        }
        $response = new ResponseController();
        $response->jsonResponse([$message], $code);
        return true;
    }

    public static function getTasks($task_file): void
    {
        if(file_exists("./datafile/".$task_file.".json")) {
            $code = 200;
            $message = parent::getTasksFile($task_file);
            if (!$message || $message == "") {
                $message = json_encode(["error" => "The content is empty to file ".$task_file]);
                $code = 500;
            }
        } else {
            $code = 400;
            $message = json_encode(["error" => "Missing file ".$task_file]);
        }
        $response = new ResponseController();
        $response->jsonResponse([$message], $code);
    }

    public static function newTask($params): void
    {
        if(file_exists("./src/".$params['task']."-tasks.php")) {

            $count = AppHandlerTasksController::getCountTasks($params['task']);
            $data = '["id" => ' . ($count+1) . ', ';
            $data .= '"title" => "' . $params['title'] . '", ';
            $data .= '"completed" => ' . $params['completed'] . '],'.PHP_EOL;

            self::persistTask($params['task'], $data);

        } else {
            die("Error: Missing file => ".$params['task']);
        }
    }

    public static function getCountTasks($task_file):int
    {
        if(file_exists("./src/".$task_file."-tasks.php")) {
            require_once $task_file."-tasks.php";
            return count(parent::getTasksFile()['tasks']);
        } else {
            die("Error: Missing file => ".$task_file);
        }
    }

    private static function persistTask($task, $data)
    {
        $file = "./src/".$task."-tasks.php";
        $data = "                ".$data;

        $fo = fopen($file, "r");
        $fw = fopen($file.".new", "w+");

        while(!feof($fo)) {
            $ln = fgets($fo, 4096);
            if(strstr($ln, '/*@TASKS-END*/')) {
                fwrite($fw, $data);
            }
            fwrite($fw, $ln);
        }

        fclose($fw);
        fclose($fo);

        copy($file.".new", $file);
        unlink($file.".new");

    }
}
