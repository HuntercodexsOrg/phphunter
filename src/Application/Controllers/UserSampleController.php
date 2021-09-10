<?php

namespace PhpHunter\Application\Controllers;

use PhpHunter\Application\Models\UsersSampleModel;
use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Kernel\Abstractions\ParametersAbstract;

class UserSampleController extends ParametersAbstract
{
    private object $response;

    /**
     * @description Constructor Class
    */
    public function __construct()
    {
        $this->initParams(true);
        $this->response = new ResponseController();
    }

    /**
     * @description Find Faker
     * @return void
     */
    public function findFaker(): void
    {
        $userModel = new UsersSampleModel();
        /*Exemplo para query sql: ['u.id', 'u.name', 'u.email']*/
        /*Exemplo comum: ['id', 'name', 'email']*/
        $result = $userModel->readFaker(['id', 'name', 'email']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description New
     * @example [POST] http://local.phphunter.dockerized/api/user
     * @return void
     */
    public function add(): void
    {
        //$result = $this->userModel->new($this->initParams);
        $result = UsersSampleModel::add($this->initParams);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Find
     * @param array $uri_rest_params
     * @example [GET] http://local.phphunter.dockerized/api/user/444444
     * @return void
     */
    public function find(array $uri_rest_params): void
    {
        //$result = $this->userModel->read($uri_rest_params, ["id", "name", "email"]);
        $result = UsersSampleModel::find($uri_rest_params['id']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description All
     * @example [GET] http://local.phphunter.dockerized/api/user
     * @return void
     */
    public function all(): void
    {
        /*Exemplo para query sql: ['u.id', 'u.name', 'u.email']*/
        /*Exemplo comum: ['id', 'name', 'email']*/
        $criteria = [
            "active" => 1
        ];
        //$result = $this->userModel->all(["name", "email", "address"], $criteria);
        $result = UsersSampleModel::all();
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Up
     * @param array $uri_rest_params #Mandatory
     * @example [PUT] http://local.phphunter.dockerized/api/user/333333
     * @return void
     */
    public function up(array $uri_rest_params): void
    {
        //$result = $this->userModel->up($uri_rest_params, $this->initParams);
        $result = UsersSampleModel::up($uri_rest_params['id'], $this->initParams);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Down
     * @param array $uri_rest_params #Mandatory
     * @example [DELETE] http://local.phphunter.dockerized/api/user/222222
     * @return void
     */
    public function down(array $uri_rest_params): void
    {
        //$result = $this->userModel->down($uri_rest_params);
        $result = UsersSampleModel::down($uri_rest_params['id']);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Fix
     * @param array $uri_rest_params #Mandatory
     * @example [PATCH] http://local.phphunter.dockerized/api/user/111111
     * @return void
     */
    public function fix(array $uri_rest_params): void
    {
        //$result = $this->userModel->fix($uri_rest_params, $this->initParams);
        $result = UsersSampleModel::fix($uri_rest_params['id'], $this->initParams);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }
}
