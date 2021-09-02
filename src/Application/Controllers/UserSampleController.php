<?php

namespace PhpHunter\Application\Controllers;

use PhpHunter\Application\Models\UserSampleModel;
use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Kernel\Abstractions\ParametersAbstract;

class UserSampleController extends ParametersAbstract
{
    private object $response;
    private object $userModel;

    /**
     * @description Constructor Class
    */
    public function __construct()
    {
        $this->initParams();
        $this->response = new ResponseController();
        $this->userModel = new UserSampleModel();
    }

    /**
     * @description Find
     * @return void
     */
    public function find(): void
    {
        $result = $this->userModel->select();
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }
}
