<?php

/**
 * @description HelperHunter is a class for helper functions
 * @see http://www.phphunter.com/helper
*/

namespace PhpHunter\Framework\App;

class HelperHunter
{
    const ROOT_DIR = __DIR__."/../";
    const LOG_DIR = self::ROOT_DIR."/app/log/";

    public static function localLogger($filename, $data, $append = true)
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

    public static function getEnv($name)
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

    public static function toArray($str)
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

    public static function helperTest()
    {
        echo "HelperHunter it's work...";
    }

}
