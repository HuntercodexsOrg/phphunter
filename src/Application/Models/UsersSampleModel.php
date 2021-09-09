<?php

namespace PhpHunter\Application\Models;

use PhpHunter\Kernel\Builders\QueryBuilder;
use PhpHunter\Kernel\Models\BasicModel;
//use PhpHunter\Kernel\Models\MySqlBasicModel;
//use PhpHunter\Kernel\Models\MsSqlBasicModel;
use PhpHunter\Framework\Faker\DatabaseFaker;

class UsersSampleModel extends /*MySqlBasicModel*/ /*MsSqlBasicModel*/ BasicModel
{
    protected array $dataMask = ['password'];
    protected array $dataHidden = [];
    /**
     * @NOTE (Traduzir:Ingles)
     * Ao definir essa propriedade com os campos a serem retornados, sera feita a
     * consulta na base de dados e depois sera filtrado o resultado da consulta
     * para extrair apenas os campos informados, caso seja necessário trazer apenas
     * os dados referentes ao(s) campo(s) específico(s) da tabela, use argumentos para
     * passar ao método select do model, assim a consulta será feita apenas com os campos
     * informados e não haverá nenhum processo de filtragem
    */
    protected array $dataOnly = [];
    protected array $dataFill = [];

    /**
     * @description Constructor Class
     */
    public function __construct()
    {
        //$this->dbType = 'mysql';
//        $this->dataMask = ['password'];
//        $this->dataHidden = [];
//        $this->dataOnly = [];
//        $this->dataFill = [];
        $this->setBasicModel('mysql');
    }

    /**
     * @description Read Faker #BasicModel
     * @param array $fields #Optional
     * @return array
     */
    public function readFaker(array $fields = []): array
    {
        /**
         * @description Query Execute (FAKER)
         */
        if (count($fields) > 0) {
            $this->dataResult = DatabaseFaker::dataFakerOnlyFields('users', $fields);
        } else {
            $this->dataResult = DatabaseFaker::dataFaker('users');
        }

        /**
         * @description First check if needed handler results
         */
        if (count($fields) == 0) {
            $this->firstly();
        }

        return $this->dataResult;

    }

    /**
     * @description New #BasicModel
     * @param array $body_params #Mandatory
     * @example [POST] http://local.phphunter.dockerized/api/user
     * @return bool
     */
    public function new(array $body_params): bool
    {
        $create_at = $updated_at = date("Y-m-d H:i:s");
        $values = [
            null,
            "{$body_params['name']}",
            "{$body_params['email']}",
            "{$body_params['age']}",
            "{$body_params['address']}",
            "{$body_params['password']}",
            "{$create_at}",
            "{$updated_at}",
            1
        ];

        /*$this->qb
            ->insert(['id', 'name', 'email', 'age', 'address', 'password', 'create_at', 'updated_at', 'active'])
            ->into('users')
            ->values($values)
            ->builder()
            ->persist();*/

        /*$this
            ->insert(['id', 'name', 'email', 'age', 'address', 'password', 'create_at', 'updated_at', 'active'])
            ->into('users')
            ->values($values)
            ->builder()
            ->persist();*/

        $this
            ->insert($values)
            ->builder()
            ->save();

        return true;
    }

    /**
     * @description Find [READ:HTTP/GET]
     * @param int|string $id #Mandatory
     * @param array $only_fields #Optional
     * @example [GET] http://local.phphunter.dockerized/api/user/444444
     * @return array
    */
    public function findId(int|string $id, array $only_fields = []): array
    {
        /*$this->qb
            ->select($only_fields, 'users')
            ->join('products', 'p', 'p.user_id = u.id')
            ->innerJoin('categories', 'c', 'c.id = p.category_id')
            ->leftJoin('categories', 'c', 'c.id = p.category_id')
            ->rightJoin('categories', 'c', 'c.id = p.category_id')
            ->outerJoin('categories', 'c', 'c.id = p.category_id')
            ->where("u.id = '{$uri_rest_params['id']}'")
            ->builder()
            ->persist();*/

        $this
            ->select($only_fields)
            ->where("u.id = '{$id}'")
            ->builder()
            ->run();

        /**
         * @description First check if needed handler results
         */
        if (count($only_fields) == 0) {
            $this->firstly();
        }

        return $this->dataResult;

    }

    /**
     * @description Find All #BasicModel
     * @param array $only_fields #Optional
     * @param array $criteria #Optional
     * @example [GET] http://local.phphunter.dockerized/api/user
     * @return array
     */
    public function findAll(array $only_fields = [], array $criteria = []): array
    {
        /*$this->dataResult = $this->qb
            ->select($only_fields, 'users')
            ->join('products', 'p', 'p.user_id = u.id')
            ->innerJoin('categories', 'c', 'c.id = p.category_id')
            ->leftJoin('categories', 'c', 'c.id = p.category_id')
            ->rightJoin('categories', 'c', 'c.id = p.category_id')
            ->outerJoin('categories', 'c', 'c.id = p.category_id')
            ->where("u.active = '{$criteria['active']}'")
            ->where("p.active = '{$criteria['active']}'", 'AND')
            ->where("p.active = '{$criteria['active']}'", 'OR')
            ->groupBy('u.id')
            ->orderBy('u.email')
            ->limit('10')
            ->builder()
            ->run();*/

        /*$this->dataResult = $this->qb
            ->select($only_fields, 'users')
            ->where("u.active = '{$criteria['active']}'")
            ->groupBy('u.id')
            ->orderBy('u.email')
            ->limit('10')
            ->builder()
            ->run();*/

        /**
         * @TIP Edit here the criteria to data handler of the model in this operation
        */
        if (count($criteria) == 0) {
            $criteria['active'] = 1;
        }

        $this
            ->select($only_fields)
            ->where("u.active = '{$criteria['active']}'")
            ->groupBy('u.id')
            ->orderBy('u.email')
            ->limit('10')
            ->builder()
            ->run();

        /**
         * @description First check if needed handler results
         */
        if (count($only_fields) == 0) {
            $this->firstly();
        }

        //sort($this->dataResult);

        return $this->dataResult;

    }

    /**
     * @description Overwrite #BasicModel
     * @param int|string $id #Optional
     * @param array $body_params #Optional
     * @example [PUT] http://local.phphunter.dockerized/api/user/333333
     * @return bool
     */
    public function overwrite(int|string $id, array $body_params): bool
    {
        $updated_at = date("Y-m-d H:i:s");

        /**
         * Update all data from one id
        */
        /*$this->qb
            ->update('users')
            ->set('name', "{$body_params['name']}")
            ->set('email', "{$body_params['email']}")
            ->set('age', "{$body_params['age']}")
            ->where("id = '{$uri_rest_params['id']}'")
            ->where("active = '1'", "AND")
            ->limit('1')
            ->builder()
            ->persist();*/

        /*$this->qb
            ->update('users')
            ->set('name', "{$body_params['name']}")
            ->set('email', "{$body_params['email']}")
            ->set('age', "{$body_params['age']}")
            ->set('address', "{$body_params['address']}")
            ->set('password', "{$body_params['password']}")
            ->set('updated_at', "{$updated_at}")
            ->where("id = '{$uri_rest_params['id']}'")
            ->where("active = '1'", "AND")
            ->limit('1')
            ->builder()
            ->persist();*/

        $this
            ->update()
            ->set('name', "{$body_params['name']}")
            ->set('email', "{$body_params['email']}")
            ->set('age', "{$body_params['age']}")
            ->set('address', "{$body_params['address']}")
            ->set('password', "{$body_params['password']}")
            ->set('updated_at', "{$updated_at}")
            ->where("id = '{$id}'")
            ->where("active = '1'", "AND")
            ->limit('1')
            ->builder()
            ->save();

        return true;
    }

    /**
     * @description Remove #BasicModel
     * @param int|string $id #Mandatory
     * @example [DELETE] http://local.phphunter.dockerized/api/user/222222
     * @return bool
     */
    public function remove(int|string $id): bool
    {
        /**
         * Delete all data from id
        */
        /*$this->qb
            ->delete("id = '{$id}'")
            ->from('users')
            ->limit('1', "delete")
            ->builder()
            ->persist();*/

        $this
            ->delete($id)
            ->builder()
            ->save();

        return true;
    }

    /**
     * @description Fix #BasicModel
     * @param int|string $id #Mandatory
     * @param array $body_params #Mandatory
     * @example [PATCH] http://local.phphunter.dockerized/api/user/111111
     * @return bool
     */
    public function patch(int|string $id, array $body_params): bool
    {
        /**
         * Update/Fix only one field
         */
        /*$this->qb
            ->patcher('users')
            ->set("name", "{$body_params['name']}")
            ->where("id = '{$uri_rest_params['id']}'")
            ->limit('1')
            ->builder()
            ->persist();*/

        $this
            ->patcher()
            ->set("name", "{$body_params['name']}")
            ->where("id = '{$id}'")
            ->limit('1')
            ->builder()
            ->save();

        return true;
    }

}
