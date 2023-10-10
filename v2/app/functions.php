<?php

function env($name){
    if(!file_exists(__DIR__.'/../.env')) {
        die("Missing: ".__DIR__."/../.env");
    }
    $env = "";
    $fh = fopen(__DIR__.'/../.env', "r");
    while(!feof($fh)) {
        $ln = fgets($fh, 4096);
        if(preg_match("/{$name} ?= ?.*/",$ln, $env)) {
            $tmp = preg_replace('/["\']/i', '', explode("=", $env[0])[1]);
            $env = trim($tmp);
            break;
        }
    }
    fclose($fh);
    if(is_array($env)) {
        $env = "";
    }
    return $env;
}

function toArray($str) {
    $a = [];
    if(strstr($str, ",")) {
        $str = preg_replace('/[\[\]]/i', '', $str);
        $t = explode(",", $str);
        for($i = 0; $i < count($t); $i++) {
            array_push($a, trim($t[$i]));
        }
    }
    return $a;
}
