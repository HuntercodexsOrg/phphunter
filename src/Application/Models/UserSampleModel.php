<?php

namespace PhpHunter\Application\Models;

use PhpHunter\Kernel\Models\BasicModel;
use PhpHunter\Kernel\Builders\QueryBuilder;
use PhpHunter\Framework\Faker\DatabaseFaker;

class UserSampleModel extends BasicModel
{
    protected array $dataMask = ['phone'];
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

    protected string $alias = 'u';

    /**
     * @description Constructor Class
     */
    public function __construct()
    {
        $this->qb = new QueryBuilder();
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
            $this->result = DatabaseFaker::dataFakerOnlyFields('users', $fields);
        } else {
            $this->result = DatabaseFaker::dataFaker('users');
        }

        /**
         * @description First check if needed handler results
         */
        if (count($fields) == 0) {
            $this->firstly();
        }

        return $this->result;

    }

    /**
     * @description New #BasicModel
     * @param array $values #Mandatory
     * @return bool
     */
    public function new(array $values): bool
    {
        /*INSERT INTO table (name, email, age) VALUES ('Rafaela Silveira', 'rafaela@email.com', '30');*/
        $this->qb
            ->insert(['name', 'email', 'age'])
            ->into('table')
            ->values($values)
            ->builder()
            ->persist();

        return true;
    }

    /**
     * @description Read #BasicModel
     * @param int $id #Mandatory
     * @param array $fields #Optional
     * @return array
    */
    public function read(int $id, array $fields): array
    {
        $this->qb
            ->select($fields, 'users', $this->alias)
            ->join('products', 'p', 'p.user_id = u.id')
            ->innerJoin('categories', 'c', 'c.id = p.category_id')
            ->leftJoin('categories', 'c', 'c.id = p.category_id')
            ->rightJoin('categories', 'c', 'c.id = p.category_id')
            ->outerJoin('categories', 'c', 'c.id = p.category_id')
            ->where("u.id = '{$id}'")
            ->builder()
            ->persist();

        /**
         * @description First check if needed handler results
         */
        if (count($fields) == 0) {
            $this->firstly();
        }

        return $this->result;

    }

    /**
     * @description Read #BasicModel
     * @param array $fields #Optional
     * @return array
     */
    public function readAll(array $fields = []): array
    {
        /*SELECT id, name, email FROM users u JOIN products p p.user_id = u.id INNER JOIN categories c c.id = p.category_id LEFT JOIN categories c c.id = p.category_id RIGHT JOIN categories c c.id = p.category_id OUTER JOIN categories c c.id = p.category_id WHERE u.id <= '100' AND p.active = true OR p.active = 1 GROUP BY u.id ORDER BY u.email LIMIT 10;*/
        $this->qb
            ->select($fields, 'users', $this->alias)
            ->join('products', 'p', 'p.user_id = u.id')
            ->innerJoin('categories', 'c', 'c.id = p.category_id')
            ->leftJoin('categories', 'c', 'c.id = p.category_id')
            ->rightJoin('categories', 'c', 'c.id = p.category_id')
            ->outerJoin('categories', 'c', 'c.id = p.category_id')
            ->where("u.id = 'active'")
            ->where("p.active = true", 'AND')
            ->where('p.active = 1', 'OR')
            ->groupBy('u.id')
            ->orderBy('u.email')
            ->limit('10')
            ->builder()
            ->persist();

        /**
         * @description First check if needed handler results
         */
        if (count($fields) == 0) {
            $this->firstly();
        }

        return $this->result;

    }

    /**
     * @description Up #BasicModel
     * @param string $param #Optional
     * @param array $fields #Optional
     * @return bool
     */
    public function up(string $param, array $fields): bool
    {
        /**
         * ATUALIZAR TODOS OS CAMPOS
        */
        /*
         * UPDATE {{{TABLE_NAME}}}
         * SET
         *      {{{FIELD}}} = {{{VALUE}}}
         * SET
         *      {{{FIELD}}} = {{{VALUE}}}
         * WHERE
         *      {{{PARAM}}} = {{{VALUE}}}
         * LIMIT 1;
         *
         */
        $this->qb
            ->update('table')
            ->set('name', "{$fields[0]}")
            ->set('email', "{$fields[1]}")
            ->set('age', "{$fields[2]}")
            ->where("id = '{$param}'")
            ->where('email = marcosantos@gemail.com', 'AND')
            ->limit('1')
            ->builder()
            ->persist();

        return true;
    }

    /**
     * @description Down #BasicModel
     * @param int $id #Mandatory
     * @param array $params #Optional
     * @return bool
     */
    public function down(int $id, array $params = []): bool
    {
        /*DELETE FROM {{{TABLE_NAME}}} WHERE {{{PARAM}}} = {{{VALUE}}} LIMIT 1;*/
        $this->qb
            ->delete("id = '{$id}'")
            ->from('table')
            ->limit('1', "delete")
            ->builder()
            ->persist();

        return true;
    }

    /**
     * @description Fix #BasicModel
     * @param string $param #Optional
     * @param array $fields #Optional
     * @return bool
     */
    public function fix(string $param, array $fields): bool
    {
        /**
         * ATUALIZAR APENAS UM CAMPO
         */
        /*UPDATE {{{TABLE_NAME}}} SET {{{FIELD}}} = {{{VALUE}}} WHERE {{{PARAM}}} = {{{VALUE}}} LIMIT 1;*/
        $this->qb
            ->patcher('table')
            ->set('idade', '44')
            ->where("id = '{$param}'")
            ->limit('1')
            ->builder()
            ->persist();

        return true;
    }

}
