<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);

if(isset($_POST['theme']) && $_POST['theme'] != "" && isset($_POST['action']) && $_POST['action'] == 'save') {

    extract($_REQUEST);
    global $theme;

    if($theme == 'light') {
        $_SESSION['theme'] = 'light';
    } else if($theme == 'night') {
        $_SESSION['theme'] = 'night';
    }

    echo json_encode(
        [
            "status" => 200,
            "message" => "Api save session success!",
            "method" => "POST",
            "theme" => $_SESSION['theme'],
            "request" => apache_request_headers()
        ]
    );

    goto api_finished;
}

if(isset($_POST['action']) && $_POST['action'] == 'check') {

    if(isset($_SESSION['theme']) && $_SESSION['theme'] != "") {

        echo json_encode(
            [
                "status" => 200,
                "theme" => $_SESSION['theme'],
            ]
        );

    }

    goto api_finished;
}

echo json_encode([]);

api_finished:
exit;

?>
