<?php

namespace PhpHunter\Application\Controllers;

use PDO;
use PDOException;
use Exception;
use PhpHunter\Application\Models\UserSampleModelMySql;
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
        $this->initParams(true);
        $this->userModel = new UserSampleModelMySql();
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
        $libDriver = "mysql";
        $ipHost = "192.168.15.13";
        $idPort = 3308;
        $dbname = "dbaname";
        $user = "root";
        $pass = "root";

        try {
            $con = new PDO("{$libDriver}:host={$ipHost}:{$idPort};dbname={$dbname}", "{$user}", "{$pass}");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            prd($con->query("SELECT * FROM users;")->fetchAll());

        } catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }

        $result = $this->userModel->new($this->initParams);
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
        $result = $this->userModel->read($uri_rest_params, ["id", "name", "email"]);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }

    /**
     * @description Find All
     * @example [GET] http://local.phphunter.dockerized/api/user
     * @return void
     */
    public function findAll(): void
    {
        /*Exemplo para query sql: ['u.id', 'u.name', 'u.email']*/
        /*Exemplo comum: ['id', 'name', 'email']*/
        $criteria = [
            "active" => 1
        ];
        $result = $this->userModel->readAll(["id", "name", "email"], $criteria);
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
        $result = $this->userModel->up($uri_rest_params, $this->initParams);
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
        $result = $this->userModel->down($uri_rest_params);
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
        $result = $this->userModel->fix($uri_rest_params, $this->initParams);
        $this->response->jsonResponse([
            "result" => $result,
        ], 200);
    }
}
