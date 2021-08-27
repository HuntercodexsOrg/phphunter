<?php

namespace PhpHunter\Framework\App\Sources;

use PhpHunter\Kernel\Controllers\ApiRouterController;

class PhpHunterApiPlug extends ApiRouterController
{
    /**
     * @description Constructor Class
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function get(string $route = "", string $callback1 = "", string $callback2 = ""): object
    {
        return parent::get($route, $callback1, $callback2);
    }

    public function post(string $route = "", string $callback1 = "", string $callback2 = ""): object
    {
        return parent::post($route, $callback1, $callback2);
    }

    public function put(string $route = "", string $callback1 = "", string $callback2 = ""): object
    {
        return parent::put($route, $callback1, $callback2);
    }

    public function delete(string $route = "", string $callback1 = "", string $callback2 = ""): object
    {
        return parent::delete($route, $callback1, $callback2);
    }

    public function patch(string $route = "", string $callback1 = "", string $callback2 = ""): object
    {
        return parent::patch($route, $callback1, $callback2);
    }

    public function run(): void
    {
        parent::run();
    }

    public function exception(): void
    {
        parent::exception();
    }
}
