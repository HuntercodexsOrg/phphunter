<?php

namespace PhpHunter\Application\Services;

use PhpHunter\Kernel\Abstractions\ServiceAbstract;
use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Application\Controllers\ApplicationServiceSampleController;

class ApplicationSampleService extends ApplicationServiceSampleController
{
    /**
     * @description Constructor Class
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @description Service Sample
     * @return void
     */
    public function sampleServiceTest(): void
    {
        $response = $this->getDataTest();

        ResponseController::apiResponse([
            "message"=> "Sample Service Test is OK",
            "response" => $response
        ], 200);
    }
}
