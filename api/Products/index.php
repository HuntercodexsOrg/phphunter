<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

ini_set('memory_limit',-1);
ini_set('max_execution_time', 0);

/*TODO: INCLUDE MIDDLEWARE*/

include './ProductsControl.php';

$productsControl = new ProductsControl();

if(isset($_POST['productsControl']) && $_POST['productsControl'] != '') {
    $productsControl->insertProductsControl();
}

if(isset($_GET['productsControl']) && $_GET['productsControl'] != '') {
    $productsControl->getProductsControl();
}

if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
    $productsControl->updateProductsControl();
}

if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
    $productsControl->deleteProductsControl();
}

echo $productsControl->apiResponse();

?>

