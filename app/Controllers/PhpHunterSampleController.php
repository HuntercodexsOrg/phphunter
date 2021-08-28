<?php

namespace PhpHunter\Framework\App\Controllers;

use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Kernel\Abstractions\ParametersAbstract;

class PhpHunterSampleController extends ParametersAbstract
{
    /**
     * @description Constructor Class
    */
    public function __construct()
    {
    }

    /**
     * @description Service Sample
     * @return array
     */
    public function getDataTest(): array
    {
        return [
            "id" => 123456,
            "name" => "Username Test Development"
        ];
    }
}
