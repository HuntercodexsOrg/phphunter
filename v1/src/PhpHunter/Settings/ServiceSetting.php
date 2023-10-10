<?php

/**
 * PhpHunter Framework Configuration - Services Setup
*/

namespace PhpHunter\Framework\Settings;

class ServiceSetting
{
    /**
     * @description Get Config
     * @return array
     */
    public static function getConfig(): array
    {
        return [

            "config" => [],

            "upload" => [
                "dir" => "resources/file_manager/",
                "accepted" => ["gif", "png", "jpg", "jpeg", "pdf"],
                "maxsize" => 1024 * 1024 * 2, /*2MB*/
                "chmod" => 0777,
                "prefix" => "ph_"
            ],

            "debug" => false
        ];
    }
}
