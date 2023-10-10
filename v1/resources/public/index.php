<?php
//var_dump($this);
//echo ">>>TEST: ".$this->getLibPathInstallation();
//global $app;
?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>Sample</title>
    <link rel="shortcut icon" type="image/png" href="./resources/images/phpHunter-logo.png" />

    <!--jsHunter Library CSS-->
    <link rel="stylesheet" href="<?=$this->getLibPathInstallation();?>/css/jsHunter.css" type="text/css" />
    <link rel="stylesheet" href="<?=$this->getLibPathInstallation();?>/css/jsHunter-ui.css" type="text/css" />

    <!--Website CSS-->
	<link id="night-light" rel="stylesheet" href="./resources/css/styles-light.css" type="text/css" />
</head>
<body>

<div id="div-master" style="display: none;">

    <div id="div-index-application">

        <?php include './resources/engine/menu.php'; ?>

    </div>

    <div id="div-header-application">

        <?php include './resources/engine/header.php'; ?>

    </div>

    <div id="div-content-application">

        <?php include './resources/engine/content.php'; ?>

    </div>

</div>

<div id="div-modal-javascript">
    <h2>jsHunter Checking!</h2>
    <p>
        The Javascript is not available or jsHunter is not installed, please enable it and try again.
    </p>
</div>

<!--jsHunter Library-->
<script src="<?=$this->getLibPathInstallation();?>/js/jsHunter.js" type="text/javascript"></script>
<script src="<?=$this->getLibPathInstallation();?>/js/jsHunter-ui.js" type="text/javascript"></script>

<!--Website Scripts-->
<script src="./resources/js/js_app.js" type="text/javascript"></script>
<script src="./resources/js/js_app_shared.js" type="text/javascript"></script>

</body>
</html>
