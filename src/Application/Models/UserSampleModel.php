<?php

namespace PhpHunter\Application\Models;

use PhpHunter\Kernel\Models\BasicModel;
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
     * os dados referentes ao(s) campo(s) específico(s) da tabela, use argumentos para passar
     * ao método select do model, assim a consulta sera feita apenas com os campos informados e
     * não havera nenhum processo de filtragem
    */
    protected array $dataOnly = [];

    /**
     * @description Insert #BasicModel
     * @param array $fields #Optional
     * @return bool
     */
    public function insert(array $fields): bool
    {
        return parent::insert($fields);
    }

    /**
     * @description Select #BasicModel
     * @param array $fields #Optional
     * @return array
    */
    public function select(array $fields = []): array
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
     * @description Update #BasicModel
     * @param array $fields #Optional
     * @return bool
     */
    public function update(array $fields): bool
    {
        return parent::update($fields);
    }

    /**
     * @description Delete #BasicModel
     * @param int $id #Mandatory
     * @param array $params #Optional
     * @return bool
     */
    public function delete(int $id, array $params = []): bool
    {
        return parent::delete($id, $params);
    }

    /**
     * @description Patcher #BasicModel
     * @param array $fields #Optional
     * @return bool
     */
    public function patcher(array $fields): bool
    {
        return parent::patcher($fields);
    }

}
