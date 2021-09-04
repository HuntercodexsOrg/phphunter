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
     * @description Create #BasicModel
     * @param array $fields #Optional
     * @return bool
     */
    public function create(array $fields): bool
    {
        /*INSERT INTO {{{TABLE_NAME}}} {{{COLUMNS}}} VALUES {{{VALUES}}}*/
        $this->qb
            ->insert(['name', 'email', 'age'])
            ->into('table')
            ->values(['Rafaela Silveira', 'rafaela@email.com', '30']);

        return parent::create($fields);
    }

    /**
     * @description Read #BasicModel
     * @param array $fields #Optional
     * @return array
    */
    public function read(array $fields = []): array
    {
        $this->qb
            ->select($fields, 'users', $this->alias)
            ->join('products', 'p', 'p.user_id = u.id')
            ->innerJoin('categories', 'c', 'c.id = p.category_id')
            ->leftJoin('categories', 'c', 'c.id = p.category_id')
            ->rightJoin('categories', 'c', 'c.id = p.category_id')
            ->outerJoin('categories', 'c', 'c.id = p.category_id')
            ->where("u.id <= '100'")
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
     * @description Up #BasicModel
     * @param array $fields #Optional
     * @return bool
     */
    public function up(array $fields): bool
    {
        /**
         * ATUALIZAR TODOS OS CAMPOS
        */
        /*UPDATE {{{TABLE_NAME}}} SET {{{FIELD}}} = {{{VALUE}}} WHERE {{{PARAM}}} = {{{VALUE}}} LIMIT 1;*/
        $this->qb
            ->update('table')
            ->set('name', 'Marcos dos Santos')
            ->set('idade', '44')
            ->where('id = 123')
            ->limit('1')
            ->builder()
            ->persist();

        return parent::up($fields);
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
            ->delete()
            ->from('table')
            ->where("id = '123'")
            ->limit('1')
            ->builder()
            ->persist();

        return parent::down($id, $params);
    }

    /**
     * @description Fix #BasicModel
     * @param array $fields #Optional
     * @return bool
     */
    public function fix(array $fields): bool
    {
        /**
         * ATUALIZAR APENAS UM CAMPO
         */
        /*UPDATE {{{TABLE_NAME}}} SET {{{FIELD}}} = {{{VALUE}}} WHERE {{{PARAM}}} = {{{VALUE}}} LIMIT 1;*/
        $this->qb
            ->update('table')
            ->set('idade', '44')
            ->where('id = 123')
            ->limit('1')
            ->builder()
            ->persist();

        return parent::fix($fields);
    }

}
