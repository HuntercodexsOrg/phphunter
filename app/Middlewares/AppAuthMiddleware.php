<?php

namespace PhpHunter\Framework\App\Middlewares;

use PhpHunter\Kernel\Controllers\ResponseController;
use PhpHunter\Framework\App\Sources\ParametersPlugAbstract;

class AppAuthMiddleware extends ParametersPlugAbstract
{
    protected ResponseController $response;

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->response = new ResponseController();
        $this->initParams();
    }

    /**
     * @description Test Auth
     * @return bool
     */
    public function testAuth(): bool
    {
        return true;
    }

    /**
     * @description Check Auth
     * @return bool
     */
    public function checkAuth(): bool
    {
        if ($this->headerParams()['Token'] != "TOKEN_TEST") {
            $this->response->jsonResponse(['error' => 'Authentication Failed'], 401);
            die;
        }

        if ($this->getParam('testing') == true) {
            $this->response->jsonResponse(['message' => 'Authentication Success'], 200);
        }

        return true;
    }
}
