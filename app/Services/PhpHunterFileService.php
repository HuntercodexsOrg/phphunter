<?php

namespace PhpHunter\Framework\App\Services;

use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Kernel\Controllers\FileManagerController;
use PhpHunter\Kernel\Controllers\HunterCatcherController;

class PhpHunterFileService extends FileManagerController
{
    /**
     * @description Constructor Class
    */
    public function __construct()
    {
        parent::__construct();
        $this->initParams();
    }

    /**
     * @description Send File
     * @return void
    */
    public function sendFile(): void
    {
        if (!$this->validateFile()) {
            HunterCatcherController::hunterApiCatcher(
                ["api_error" => "Not Acceptable !"],
                406,
                true
            );
        }

        if ($this->send()) {
            ResponseController::apiResponse([
                "message" => "Upload file success",
            ], 200);
        } else {
            ResponseController::apiResponse([
                "message" => "Upload file failed",
            ], 500);
        }
    }
}
