<?php

global $app;

$extension = ($app->getDirSetup()[0] === env("EXTENSIONS_DIR")) ? "-".$app->getDirSetup()[1] : "";
$url_current = "/".$app->getDirSetup()[0]."+".$app->getDirSetup()[1];

?>

<ul id="ul-menu-lang">
    <li>
        <a id="a-change-lang-pt_br" href="<?=$url_current?>+pt-br">
            <img src="./resources/images/brasil.png" alt="pt_br" title="pt_br" />
        </a>
    </li>
    <li>
        <a id="a-change-lang-en" href="<?=$url_current?>+en">
            <img src="./resources/images/eua.png" alt="en" title="en" />
        </a>
    </li>
    <li>
        <a id="a-change-lang-es" href="<?=$url_current?>+es">
            <img src="./resources/images/espanha.png" alt="es" title="es" />
        </a>
    </li>
</ul>

<p id="sample-header" class="bigger">
    <?=$app->getAppName().$extension;?>
    <br />
    <small>
        <?=$app->getAppDescription();?>
    </small>
</p>
