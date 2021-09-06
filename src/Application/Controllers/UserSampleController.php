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
     * @description New
     * @return void
     */
    public function new(): void
    {
        $result = $this->userModel->new(['Rafaela Silveira', 'rafaela@email.com', '30']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Find
     * @param array $param
     * @return void
     */
    public function find(array $param): void
    {
        $id = $param['id'];
        $result = $this->userModel->read($id, ['id', 'name', 'email']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Find All
     * @return void
     */
    public function findAll(): void
    {
        /*Exemplo para query sql: ['u.id', 'u.name', 'u.email']*/
        /*Exemplo comum: ['id', 'name', 'email']*/
        $result = $this->userModel->readAll(['id', 'name', 'email']);
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
        $result = $this->userModel->up('123456', ['Marcos Silva', 'marcos@email.com', '45']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Down
     * @return void
     */
    public function down(): void
    {
        $result = $this->userModel->down('123456');
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Fix
     * @return void
     */
    public function fix(): void
    {
        $result = $this->userModel->fix('123456', ['Marcos Silva', 'marcos@email.com', '45']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }
}
