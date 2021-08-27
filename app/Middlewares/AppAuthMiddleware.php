<?php

namespace PhpHunter\Framework\App\Middlewares;

use PhpHunter\Kernel\Abstractions\RequestAbstract;
use PhpHunter\Kernel\Controllers\ResponseController;

class AppAuthMiddleware extends RequestAbstract
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
     */
    public function testAuth(): bool
    {
        return true;
    }

    /**
     * @description Check Auth
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
