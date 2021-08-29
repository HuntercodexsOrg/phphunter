<?php

/**
 * @description HelperHunter is a class for helper functions
 * @see http://www.phphunter.com/helper
*/

namespace PhpHunter\Framework;

class HelperHunter
{
    const ROOT_DIR = __DIR__."/../../";
    const LOG_DIR = __DIR__."/../../log/";

    /**
     * @description Local Logger
     * @param string $filename #Mandatory
     * @param string|array $data #Mandatory
     * @param bool $append #Optional
     * @return void
     */
    public static function localLogger(string $filename, string|array $data, bool $append = true): void
    {
        $date = date('YmdH');
        $log_date = date('Y/m/d H:i:s');
        $filepath = self::LOG_DIR.$filename."-".$date.".log";

        if(!file_exists($filepath)) {
            $fh = fopen($filepath, "w+");
            fwrite($fh, 'Create at: '.$date.PHP_EOL.PHP_EOL);
            fclose($fh);

            chmod($filepath, 0777);
        }

        switch ($append) {
            case true:
                file_put_contents($filepath, $log_date." : ".print_r($data, true).PHP_EOL, FILE_APPEND);
                break;
            default:
                file_put_contents($filepath, $log_date." : ".print_r($data, true).PHP_EOL);
        }
    }

    /**
     * @description Get Env
     * @param string $name #Mandatory
     * @return string
     */
    public static function getEnv(string $name): string
    {
        if (!file_exists(self::ROOT_DIR . ".env")) {
            die("Missing: " . self::ROOT_DIR . ".env");
        }

        $env = "";

        $handler = fopen(self::ROOT_DIR . ".env", "r");

        while (!feof($handler)) {
            $env_line = fgets($handler, 2048);
            if (preg_match("/{$name} ?= ?.*/", $env_line, $env)) {
                $tmp = preg_replace('/["\']/i', '', explode("=", $env[0])[1]);
                $env = trim($tmp);
                break;
            }
        }

        fclose($handler);

        if (is_array($env)) {
            $env = "";
        }

        return $env;
    }

    /**
     * @description toArray
     * @param string $str #Mandatory
     * @return array
     */
    public static function toArray(string $str): array
    {
        $a = array();
        if (strstr($str, ",")) {
            $str = preg_replace('/[\[\]]/i', '', $str);
            $t = explode(",", $str);
            for ($i = 0; $i < count($t); $i++)
            {
                array_push($a, trim($t[$i]));
            }
        }
        return $a;
    }

    /**
     * @description Helper Test
     * @return void
     */
    public static function helperTest()
    {
        echo "HelperHunter it's work...";
    }

}
