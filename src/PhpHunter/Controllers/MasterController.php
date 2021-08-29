<?php

namespace PhpHunter\Framework\Controllers;

use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Kernel\Abstractions\ParametersAbstract;

class MasterController extends ParametersAbstract
{
    /**
     * @description Constructor Class
    */
    public function __construct()
    {
    }

    public function getControllerState()
    {
        ResponseController::apiResponse([
            "state" => "OK"
        ], 200);
    }
}
