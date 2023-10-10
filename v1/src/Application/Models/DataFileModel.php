<?php

namespace PhpHunter\Application\Models;

abstract class DataFileModel
{
    protected static function getTasksFile($task_file): string
    {
        return (file_get_contents("./datafile/".$task_file.".json"));
    }
}
