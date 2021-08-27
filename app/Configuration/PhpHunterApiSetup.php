<?php

/**
 * PhpHunter Framework Configuration - Api Setup
*/

namespace PhpHunter\Framework\App\Configuration;

class PhpHunterApiSetup
{
    /**
     * @description Get Config
     * @return array
    */
    public static function getConfig(): array
    {
        return [

            "config" => [],

            /*Content-Type vs Request-Method*/
            "accepted_content" => [
                "GET" => [
                    '', /*none*/
                    'multipart/form-data',
                    'application/x-www-form-urlencoded',
                    'application/json'
                ],
                "POST" => [
                    'multipart/form-data',
                    'application/x-www-form-urlencoded',
                    'application/json'
                ],
                "PUT" => [
                    'multipart/form-data',
                    'application/x-www-form-urlencoded',
                    'application/json'
                ],
                "DELETE" => [
                    '', /*none*/
                    'application/x-www-form-urlencoded'
                ],
                "PATCH" => [
                    '', /*none*/
                    'multipart/form-data',
                    'application/x-www-form-urlencoded',
                    'application/json'
                ],
            ],

            "authorization" => [],

            "firewall" => [],

            "debug" => false
        ];
    }
}
