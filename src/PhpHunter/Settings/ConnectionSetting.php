<?php

/**
 * PhpHunter Framework Configuration - App Setup
*/

namespace PhpHunter\Framework\Settings;

class ConnectionSetting
{
    /**
     * @description Get Database Connection
     * @return array
     */
    public static function getDatabaseConnection(): array
    {
        return [

            //Define here the database connections of the application
            "mysql" => [
                "driver"   => "mysql",
                "server"   => "192.168.15.13",
                "port"     => "3308",
                "database" => "dbaname",
                "user"     => "root",
                "password" => "root",
            ],
            "mssql" => [
                "driver"   => "",
                "server"   => "",
                "port"     => "",
                "database" => "",
                "user"     => "",
                "password" => "",
            ],
            "postgres" => [
                "driver"   => "",
                "server"   => "",
                "port"     => "",
                "database" => "",
                "user"     => "",
                "password" => "",
            ],
            "mongodb" => [
                "driver"   => "",
                "server"   => "",
                "port"     => "",
                "database" => "",
                "user"     => "",
                "password" => "",
            ],
        ];
    }
}
