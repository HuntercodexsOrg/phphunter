<?php
global $app;

$msg_build_in = "";

switch ($app->getLanguage()) {
    case "pt-br":
        $msg_build_in = "<span>INFO:</span><br />Esta aplicação esta em construção.";
        break;
    case "en":
        $msg_build_in = "<span>INFO:</span><br />This application is under construction.";
        break;
    case "es":
        $msg_build_in = "<span>INFO:</span><br />Esta aplicación está en construcción.";
        break;
    default:
        echo "Error: Build In (Incorrect Language)";
        die;
}

?>

<div id="div-info-build-in" class="div-container-samples div-shared-alert">
    <p id="p-close-shared">X</p>
    <p><?=$msg_build_in;?></p>
</div>
