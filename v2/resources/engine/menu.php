<?php
global $app;
require_once "./app/source/MenuHandler.php";
?>

<!--Views Access Counter-->
<div class="div-views">
    <p><?=$app->getViews();?> Views</p>
</div>

<div class="div-session-sample div-application-menu">
    <h4>
        <?=$app->getAppName();?> Menu
        <br />

        <!--Buttons Theme-->
        <small style="font-size: 11px; margin-top: -10px;">v <?=$app->getLibVersion()?> | Themes:
            <a id="light-theme" type="radio" name="theme-choose-doc">Light</a>
            <a id="dark-theme" type="radio" name="theme-choose-doc">Dark</a>
        </small>
    </h4>
</div>

<div id="div-menu">

    <?php

    /**
     * @Warning: Do not change the codes bellow
    */

    /*Main*/
    $menu = new MenuHandler($app->getMenuContents("site/main"), "php", $app->getDirSetup()[2]);
    $menu->createMainMenu($app->getDirSetup()[1]);

    /*Extension*/
    $menu = new MenuHandler($app->getMenuContents("extensions"), "dir", $app->getDirSetup()[2]);
    $menu->createExtensionsMenu();

    /*Contents*/
    $dirs = $app->getDirsToShowMainContents();
    $current = $app->getDirSetup()[1];
    if($app->getDirSetup()[0] == 'site' && (preg_match("/($dirs)/", $app->getDirSetup()[1]))) {
        $menu = new MenuHandler($app->getMenuContents('site/'.$current), "php", $app->getDirSetup()[2]);
    } else if($app->getDirSetup()[0] == 'extensions') {
        $menu = new MenuHandler($app->getMenuContents(''), "php", $app->getDirSetup()[2]);
    }
    $menu->createMenu();

    ?>

    <div class="padding-fake"></div>

</div>
