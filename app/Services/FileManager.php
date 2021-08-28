<?php

namespace PhpHunter\Framework\App\Services;

use PhpHunter\Kernel\Controllers\FileManagerController;

class FileManager extends FileManagerController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendFile()
    {
        echo "sendFile";
    }
}
