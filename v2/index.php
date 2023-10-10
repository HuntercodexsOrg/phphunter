<?php

session_start();

require_once "./app/functions.php";
require_once "./app/source/AppHandler.php";

$path = env('CONTENT_PATH');
$public = env('PUBLIC_DIR');
$file = env('DEFAULT_FILE');
$setup = toArray(env('SETUP_DIR'));
$views_file = env("VIEWS_FILE");

$app = new AppHandler($path, $public, $file, $views_file, $setup);
$app->appControl($_SERVER);
$app->run();

?>
