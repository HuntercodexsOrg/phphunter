<?php

/**
 * PhpHunter Framework Configuration - App Setup
*/

namespace PhpHunter\Framework\App\Configuration;

class PhpHunterAppSetup
{
    /**
     * @description Get Config
     * @return array
     */
    public static function getConfig(): array
    {
        return [

            //Define here the namespace to work
            "namespace" => [
                "middlewares" => "PhpHunter\\Framework\\App\\Middlewares\\",
                "controllers" => "PhpHunter\\Framework\\App\\Controllers\\",
                "services"    => "PhpHunter\\Framework\\App\\Services\\",
            ],

            //Define here the models to database
            "models" => [],

            //Define here the views to use/render
            "views" => [],

            //Define here the controllers to run
            "controllers" => [],

            //Define here the factories to create
            "factories" => [],

            //Define here the templates to use
            "templates" => [],

            //Define here the databases
            "databases" => [],

            "debug" => true
        ];
    }
}
