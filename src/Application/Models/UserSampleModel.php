<?php

namespace PhpHunter\Application\Models;

use PhpHunter\Kernel\Models\BasicModel;

class UserSampleModel extends BasicModel
{
    protected array $dataMask = ['password', 'phone', 'password2', 'value'];

    /**
     * @description Select
     * @return array
    */
    public function select(): array
    {
        return parent::select();
    }
}
