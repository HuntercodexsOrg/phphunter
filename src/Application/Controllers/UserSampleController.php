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
        $this->userModel = new UserSampleModel();
        $this->response = new ResponseController();
    }

    /**
     * @description New
     * @return void
     */
    public function new(): void
    {
        $result = $this->userModel->create();
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Find
     * @return void
     */
    public function find(): void
    {
        /*Exemplo para query sql: ['u.id', 'u.name', 'u.email']*/
        /*Exemplo comum: ['id', 'name', 'email']*/
        $result = $this->userModel->read(['id', 'name', 'email']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Find Faker
     * @return void
     */
    public function findFaker(): void
    {
        /*Exemplo para query sql: ['u.id', 'u.name', 'u.email']*/
        /*Exemplo comum: ['id', 'name', 'email']*/
        $result = $this->userModel->readFaker(['id', 'name', 'email']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Up
     * @return void
     */
    public function up(): void
    {
        $result = $this->userModel->up();
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }
}
