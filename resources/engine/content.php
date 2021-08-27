<?php

global $app;

/*Application parts: ordered by asc*/

require_once "./app/source/ContentHandler.php";
$ignore_files = ['index.php'];

$content = $app->getDirsToShowMainContents();

if($app->getDirSetup()[0] === "site" && (preg_match("/($content)/", $app->getDirSetup()[1]))) {
    $docs = new ContentHandler($app->getContents('main'), $ignore_files);
    $docs->incContents();
}

if($app->getDirSetup()[0] === 'site') {
    $docs = new ContentHandler($app->getContents($app->getDirSetup()[1]), $ignore_files);
} else {
    $docs = new ContentHandler($app->getContents(''), $ignore_files);
}
$docs->incContents();
