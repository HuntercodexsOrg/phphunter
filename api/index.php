<?php

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);

echo json_encode(
    [
        "status" => 200,
        "message" => "Api test with success!",
        "method" => $_SERVER["REQUEST_METHOD"],
        "post" => $_GET['name'],
        "data" => $_REQUEST,
        "request" => apache_request_headers()
    ]
);

?>
