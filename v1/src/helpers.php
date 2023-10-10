<?php

/**
 * Helpers Functions for PhpHunter Mini Framework
*/

if (!function_exists('dd')) {
    function dd($data)
    {
        var_dump('<pre>', $data, '</pre>');
        die;
    }
}

if (!function_exists('pr')) {
    function pr($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

if (!function_exists('dp')) {
    function dp($data)
    {
        print_r($data);
    }
}

if (!function_exists('prd')) {
    function prd($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }
}

if (!function_exists('dump')) {
    function dump($data)
    {
        var_dump('<pre>', $data, '</pre>');
    }
}

if (!function_exists('localLogger')) {
    /**
     * helper function pra log local: /var/www/html/.log/{$filename}.log
     */
    function localLogger($filename, $data, $append)
    {
        $filepath = '/var/www/html/.log/' . $filename . '.log';
        if(file_exists($filepath)) {
            if($append) {
                file_put_contents($filepath, print_r($data, true).PHP_EOL, FILE_APPEND);
            } else {
                file_put_contents($filepath, print_r($data, true).PHP_EOL);
            }
        }
    }
}